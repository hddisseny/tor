<?php

namespace tor\core;

class Router {
 
    public function getRoute()
    { 

        $query_string = parse_str ( $_SERVER['QUERY_STRING'], $output_query_string );

        $clean_request_uri = strtok( $_SERVER['REQUEST_URI'] ,'?' );

        $clean_request_uri_array = explode ( '/', $clean_request_uri );

        return [
            'host'          => $_SERVER['HTTP_HOST'],
            'protocol'      => $_SERVER['REQUEST_SCHEME'],
            'query_string'  => $output_query_string,
            'request_uri'   => [ 
                'uri'   => $clean_request_uri,
                'nodes' => array_filter ( $clean_request_uri_array ) 
            ]            
        ];
  
    }
    
}
    