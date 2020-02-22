<?php

namespace tor\cms;

class Backend extends \tor\cms\Context {

    protected $database_instance;
  
    protected $router;

    protected $table = 'tor_admin_pages';

    public function __construct()
    {
   
        $this->database_instance = new \tor\core\Database(); 

        $this->router = new \tor\core\Router(); 

        $this->handlePage();

    }
    
}