<?php

// include the prod configuration
require PATH_SRC . '/config/prod.php';


$app['db.options'] = array(
    'driver'	=> 'pdo_mysql',
    'host'          =>  '172.17.0.2',
    'dbname'          =>  'database',
    'user'          =>  'root',
    'password'	=>  '123456',
    'charset'   => 'utf8',
    'driverOptions' => array(
        1002=>'SET NAMES utf8'
    )
);

// enable the debug mode
$app['debug'] = true;
