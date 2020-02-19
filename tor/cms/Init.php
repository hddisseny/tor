<?php

namespace tor\cms;

class Init {
    protected $database_instance;

    public function __construct()
    {
        $this->database_instance = new \tor\core\Database();
    }
    public function run()
    {
        $this->database_instance->prepare();
    }
}