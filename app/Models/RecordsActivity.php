<?php

namespace App\Models;

trait RecordsActivity
{
    public static function bootRecordsActivity()
    {
        foreach (self::activitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                if (auth()->guest()) {
                    return;
                }

                $model->recordChange($event);
            });
        }
    }

    public static function activitiesToRecord()
    {
        return ['created', 'updating', 'deleted'];
    }

    public function recordChange($event, $diff = null)
    {
        $this->changes()->create([
            'user_id' => auth()->id(),
            'type'    => $this->getEventType($event),
            'before'  => $this->getSubjectBeforeEvent($event),
            'after'   => $this->getSubjectAfterEvent($event)
        ]);
    }

    public function changes()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function getEventType($event)
    {
        $subject = snake_case(str_replace(
            '\\', '_', str_after(get_class($this), 'App\\Models\\')
        ));

        return "{$event}_{$subject}";
    }

    public function getSubjectBeforeEvent($event)
    {
        if ($event == 'created') {
            return null;
        }

        if ($event == 'deleted') {
            return json_encode($this->getAttributes());
        }

        return json_encode(
            array_intersect_key($this->fresh()->getAttributes(), $this->getDirty())
        );
    }

    public function getSubjectAfterEvent($event)
    {
        if ($event == 'updating') {
            return json_encode($this->getDirty());
        }

        if ($event == 'deleted') {
            return null;
        }

        if ($event == 'created') {
            return json_encode($this->getAttributes());
        }

        return;
    }
}
