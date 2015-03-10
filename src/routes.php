<?php

$app->mount( '/', new Controller\IndexController() );
$app->mount( '/tickets', new Controller\TicketController() );
$app->mount( '/services', new Controller\ServicesController() );
$app->mount( '/user', new Controller\UserController() );