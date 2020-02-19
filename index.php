<?php


include ( dirname( __FILE__ ) . '/tor/tor-init.php' );

$torCMS = new tor\cms\Init();

$torCMS->run();
 