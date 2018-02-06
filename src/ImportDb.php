<?php

namespace alongal;

class ImportDb
{
    protected $path_to_mysql_engine;
    protected $db_name;
    protected $path_to_file_to_load_folder;
    protected $file_to_load;

    protected $isDebugMode;
    protected $out;
    protected $isDropDb;

    public function __construct(array $params)
    {
        $this->isDebugMode = false;

        foreach ($params as $key => $value) $this->$key = $value;

        return $this;
    }

    public function __toString()
    {
        return $this->createCommand();
    }

    public function loadFile($file_to_load)
    {
        $this->file_to_load = $file_to_load;

        $command = $this->createCommand();

        if ($this->isDebugMode) {
            return $this;
        }

        if ($this->isDropDb) {
            shell_exec($this->createDropCommand());
            shell_exec($this->createDatabaseCommand());
        }

        $this->out = shell_exec($command);
        return $this;
    }

    public function setDebugMode($trueOrFalse)
    {
        $this->isDebugMode = $trueOrFalse;
        return $this;
    }

    public function dropDbIfExists($trueOrFalse)
    {
        $this->isDropDb = $trueOrFalse;
        return $this;
    }

    protected function createCommand()
    {
        return $this->path_to_mysql_engine .
            ' -uroot ' .
            $this->db_name .
            ' < ' .
            $this->path_to_file_to_load_folder .
            $this->file_to_load;
    }

    protected function createDropCommand()
    {
        return $this->path_to_mysql_engine . 'admin' .
            ' -uroot ' .
            'drop -f ' .
            $this->db_name;
    }

    protected function createDatabaseCommand()
    {
        return $this->path_to_mysql_engine . 'admin' .
            ' -uroot ' .
            'create ' .
            $this->db_name;
    }
}