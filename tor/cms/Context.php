<?php

namespace tor\cms;

class Context {
  
    protected $router;
  
    public function __construct()
    {
        $this->router = new \tor\core\Router(); 

    } 
 
    public function getPageContext()
    { 

        $route = $this->router->getRoute();

        return ( !strpos( $route['request_uri']['uri'], 'tor-admin' ) ) ? TOR_FRONTEND : TOR_BACKEND;
 
    }

    public function handlePage( )
    {
  
        $table_query = $this->table;
 
        $result = $this->database_instance->query( "SELECT id,url_slug FROM `$table_query` LIMIT 1" );

        $route = $this->router->getRoute();
 
        if ( $route['request_uri']['uri'] !== $result['url_slug'] )
            return $this->fallback();
 
        return $this->load( $result['id'] ) ;

    }

    public function load( int $id )
    {

        echo 'Load page ID: ' . $id;

    }

    public function fallback()
    {
        
        // Check and return if is frontend context... 
        echo ( $this->getPageContext() == TOR_BACKEND ) ? 'Backend 404' : 'Frontend 404';
  
    }

}