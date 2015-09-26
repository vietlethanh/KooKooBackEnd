<?php

set_time_limit(10);

require('config/globalconfig.php');


$Cache = new Socket_Cache_Client('localhost', 9803);

$Cache->set('test', 'This is a test');

var_dump($Cache->dump());
