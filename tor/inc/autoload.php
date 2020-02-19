<?php
 
 $__ak_autoload_register_class = spl_autoload_register( function( $class_name ) {

   $class_name = ltrim ( $class_name, '\\');

   $file_name  = '';

   $namespace = '';

   if ( $last_pos = strrpos ( $class_name, '\\' ) ) {

       $namespace = substr ($class_name, 0, $last_pos);

       $class_name = substr ($class_name, $last_pos + 1);

       $file_name  = str_replace ( '\\', DIRECTORY_SEPARATOR, $namespace ) . DIRECTORY_SEPARATOR;

   }

   $file_name .= str_replace ( '_', DIRECTORY_SEPARATOR, $class_name ) . '.php'; 
 
   include( TOR_BASE_PATH . '/' . $file_name );

});