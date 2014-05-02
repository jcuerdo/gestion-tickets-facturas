<?php

$app->mount( '/', new Controller\IndexController() );
$app->mount( '/tickets', new Controller\TicketController() );
