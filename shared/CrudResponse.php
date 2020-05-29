<?php

namespace Sty;

use Illuminate\Http\Resources\Json\JsonResource;

class CrudResponse
{
    protected $data;
    protected $headers = [];
    protected $resource;
    protected $model;
    protected $message;
    protected $state;
    protected $status;

    const CREATED        = 'crud.store.success';
    const UPDATED        = 'crud.update.success';
    const DESTROYED      = 'crud.destroy.success';

    public function __construct($data, $state = null)
    {
        if (!$data instanceof JsonResource && !$data instanceof ResourceModel) {
            throw new \Exception('Data must be instanceof JsonResource or ResourceModel');
        }

        $this->resource = $data instanceof JsonResource ? $data : null;

        $this->setModel($this->resource ? $data->resource : $data);

        $this->setState($state ?: $this->getModelState());

        $this->makeHeaders();
    }

    public function setModel(ResourceModel $model)
    {
        $this->model = $model;

        return $this;
    }

    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    protected function getModelState($model = null)
    {
        $model = $model ?: $this->model;

        switch (true) {
            case $this->isDeleted($model):
                return self::DESTROYED;
            case $this->isCreated($model):
                return self::CREATED;
            case $this->isUpdated($model):
                return self::UPDATED;
        }
    }

    public function isDeleted($model)
    {
        $isSoftDelete = method_exists($model, 'trashed');

        return $model->exists == false || ($isSoftDelete && $model->trashed());
    }

    public function isCreated($model)
    {
        return $model->exists && $model->wasRecentlyCreated;
    }

    public function isUpdated($model)
    {
        return $model->exists && !$model->wasRecentlyCreated;
    }

    public function makeHeaders()
    {
        if ($this->state == self::CREATED) {
            $this->addHeader('Location', $this->model->path);
        }

        return $this;
    }

    public function addHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    public function response()
    {
        if (!$this->resource) {
            return $this->makeResponse();
        }

        return $this->resource->additional([
            'status'  => $this->getStatus(),
            'message' => $this->getMessage()
        ])->response()->withHeaders($this->getHeaders());
    }

    protected function makeResponse()
    {
        return response()
            ->json(array_filter([
                'status'  => $this->getStatus(),
                'data'    => $this->getData(),
                'message' => $this->getMessage()
            ]), $this->getHttpCode())
            ->withHeaders($this->getHeaders());
    }

    public function getStatus()
    {
        return 'success';
    }

    public function getData()
    {
        return $this->model->toArray();
    }

    public function getMessage()
    {
        return $this->message ?: __($this->state);
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getHttpCode()
    {
        switch ($this->state) {
            case self::CREATED:
                return 201;
            case self::UPDATED:
            case self::DESTROYED:
                return 200;
        }

        return 500;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}
