<?php

namespace Sty;

use Exception;
use SplFileInfo;
use SplFileObject;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\OutputInterface;

/**
* CSV Seeder
*/
class CsvSeeder
{
    protected $batch          = 200;
    protected $beforeEach     = [];
    protected $chunk          = [];
    protected $cmdOutput;
    protected $columns;
    protected $delimiter      = ',';
    protected $line;
    protected $nullvalues     = ['NULL', '', '0000-00-00'];
    protected $progressBar;
    protected $queryLog       = false;
    protected $selection      = [];
    protected $table;
    protected $takeOnly;
    protected $connection;
    protected $tasks          = [];
    protected $withHeader     = false;
    protected $withSoftDelete = false;
    protected $withTimestamps = true;

    public function __construct($table, $filepath, $connection = null)
    {
        $this->table = $table;
        $this->file  = $this->readFile($filepath);

        $this->file->setFlags(
            SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE
        );

        $this->connection = $connection ?: config('database.default');
    }

    public static function make($table, $filepath)
    {
        return new static(...func_get_args());
    }

    protected function readFile($path)
    {
        $file = new SplFileInfo($path);

        if ($file->getExtension() != 'csv') {
            throw new Exception('File not a csv file');
        }

        if (!$file->isReadable()) {
            throw new Exception('File not readable');
        }

        return $file->openFile('r');
    }

    public function seed()
    {
        $this->prepareColumnKey();

        $this->registerDefaultTask();

        $this->registerExtraTask();

        $this->runSeeder();

        $this->progressFinish();
    }

    protected function prepareColumnKey()
    {
        if (!empty($this->columns)) {
            return $this;
        }

        if ($this->withHeader) {
            return $this->setColumns($this->file->fgetcsv($this->delimiter));
        }

        return $this->setColumns(
            $this->normalizeColumn($this->getColumnsFromDB($this->table))
        );
    }

    public function setColumns($value)
    {
        $this->columns = $value;

        return $this;
    }

    protected function getColumnsFromDB($table)
    {
        return DB::connection($this->connection)
            ->getSchemaBuilder()
            ->getColumnListing($table);
    }

    public function normalizeColumn($columns)
    {
        $columns = array_flip($columns);

        if (array_key_exists('created_at', $columns)) {
            unset($columns['created_at']);
        }

        if (array_key_exists('updated_at', $columns)) {
            unset($columns['updated_at']);
        }

        if (array_key_exists('deleted_at', $columns)) {
            unset($columns['deleted_at']);
        }

        return array_flip($columns);
    }

    protected function registerDefaultTask()
    {
        $this->registerTask([$this, 'takeOnlySelection']);
        $this->registerTask([$this, 'cleanNullData']);
        $this->registerTask([$this, 'mergeWithColumns']);
        $this->registerTask([$this, 'addTimestamps']);
    }

    public function registerTask(callable $task)
    {
        array_push($this->tasks, $task);

        return $this;
    }

    protected function takeOnlySelection($data)
    {
        if (empty($this->selection)) {
            return $data;
        }

        $newdata = [];

        foreach ($this->selection as $key) {
            $newdata[] = array_key_exists($key, $data) ? $data[$key] : null;
        }

        return $newdata;
    }

    protected function cleanNullData($data)
    {
        $nullvalues = $this->nullvalues;

        return array_map(function ($item) use ($nullvalues) {
            return in_array($item, $nullvalues) ? null : $item;
        }, $data);
    }

    protected function mergeWithColumns($data)
    {
        try {
            return array_combine($this->columns, $data);
        } catch (\Exception $e) {
            dump($this->columns, $data);

            throw $e;
        }
    }

    protected function addTimestamps($data)
    {
        if (!$this->withTimestamps) {
            return $data;
        }

        $data['created_at'] = \Carbon\Carbon::now();
        $data['updated_at'] = \Carbon\Carbon::now();

        return $data;
    }

    public function withTimestamps($value = true)
    {
        $this->withTimestamps = $value;

        return $this;
    }

    protected function registerExtraTask()
    {
        foreach ($this->beforeEach as $extraTask) {
            $this->registerTask($extraTask);
        }

        return $this;
    }

    public function beforeEach(callable $function)
    {
        array_push($this->beforeEach, $function);

        return $this;
    }

    protected function runTask($data)
    {
        if (empty($data) || !$data) {
            return $data;
        }

        foreach ($this->tasks as $task) {
            $data = call_user_func($task, $data);
        }

        return $data;
    }

    protected function runSeeder()
    {
        $increment = 0;

        while (!$this->file->eof()) {
            if (!empty($this->takeOnly) && $this->takeOnly == $increment) {
                break;
            }

            $data = $this->runTask($this->file->fgetcsv($this->delimiter));

            $increment++;

            if (!$data) {
                continue;
            }

            array_push($this->chunk, $data);

            $this->progressAdvance();

            if (sizeof($this->chunk) == $this->batch) {
                $this->insert($this->chunk);
                $this->chunk = [];
            }
        }

        if (!empty($this->chunk)) {
            $this->insert($this->chunk);
        }
    }

    public function progressAdvance()
    {
        $step = $this->batch    > $this->takeOnly
              ? $this->takeOnly : $this->batch;

        $step = $step ?: 1;

        if ($this->getProgressBar()) {
            $this->getProgressBar()->advance($step);
        }

        return $this;
    }

    public function getProgressBar()
    {
        return $this->progressBar;
    }

    public function progressFinish()
    {
        if ($this->getProgressBar()) {
            $this->getProgressBar()->finish();
            $this->cmdOutput->newLine(2);
        }

        return $this;
    }

    public function setProgressOutput(OutputInterface $output, $steps)
    {
        $this->cmdOutput   = $output;
        $this->line        = $steps;

        $this->progressBar = $this->cmdOutput->createProgressBar($this->takeOnly ?: $steps);

        $this->startProgressBar();

        return $this;
    }

    public function startProgressBar()
    {
        $this->progressBar->start();

        return $this;
    }

    public function select($keys)
    {
        $this->selection = is_array($keys) ? $keys : func_get_args();

        return $this;
    }

    protected function insert($data)
    {
        if (!$this->queryLog) {
            DB::disableQueryLog();
        }

        return DB::connection($this->connection)
            ->table($this->table)
            ->insert($data);
    }

    public function enableQueryLog($value = true)
    {
        $this->queryLog = $value;

        return $this;
    }

    public function setDelimiter($value)
    {
        $this->delimiter = $value;

        return $this;
    }

    public function setBatch($value)
    {
        $this->batch = $value;

        return $this;
    }

    public function withHeader($value = true)
    {
        $this->withHeader = $value;

        return $this;
    }

    public function withSoftDelete($value = true)
    {
        $this->withSoftDelete = $value;

        return $this;
    }

    public function setNullValues(array $data)
    {
        $this->nullvalues = $data;

        return $this;
    }

    public function takeOnly($value)
    {
        $this->takeOnly = $value;

        return $this;
    }

    public function setParameters(array $parameters)
    {
        foreach ($parameters as $parameter => $value) {
            if (property_exists($this, $parameter)) {
                $this->{$parameter} = $value;
            }
        }

        return $this;
    }
}
