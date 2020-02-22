<?php

namespace tor\cms;

class Frontend extends \tor\cms\Context {

    protected $database_instance;
  
    protected $router;

    protected $table = 'tor_public_pages';

    public function __construct()
    {

        $this->database_instance = new \tor\core\Database(); 

        $this->router = new \tor\core\Router(); 

        $this->handlePage();

        return true;

    }

}