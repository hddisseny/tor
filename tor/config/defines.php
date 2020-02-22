<?php  

define ( 'TOR_FRONTEND', 0 );

define ( 'TOR_BACKEND', 1 );
 
define ( 'TOR_BASE_PATH', $_SERVER['DOCUMENT_ROOT'] );

define ( 'TOR_CMS_CORE_PATH' , TOR_BASE_PATH . '/tor/cms' );

define ( 'TOR_BASE_URL', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? "https://" : "http://" . $_SERVER["SERVER_NAME"]  );

define ( 'TOR_CMS_CORE_URL', TOR_BASE_URL . '/tor/cms' );
 
// EOF
