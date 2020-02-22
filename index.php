<?php


include ( dirname( __FILE__ ) . '/tor/tor-init.php' );

$tOR_CMS = new tor\cms\Init();

$tOR_CMS->run();
  