<?php

// Local
$app['locale'] = 'es';
$app['session.default_locale'] = $app['locale'];
$app['translator.messages'] = array(
	'es' => PATH_LOCALES . '/es.yml',
);
$app['id_shop'] = 1;

// Cache
$app['cache.path'] = PATH_CACHE;

// Http cache
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';

// Twig cache
$app['twig.options.cache'] = $app['cache.path'] . '/twig';

// Assetic
$app['assetic.enabled']					= true;
$app['assetic.path_to_cache']			= $app['cache.path'] . '/assetic' ;
$app['assetic.path_to_web']				= PATH_PUBLIC . '/assets';
$app['assetic.input.path_to_assets']	= PATH_SRC . '/assets';
$app['assetic.input.path_to_css']		= $app['assetic.input.path_to_assets'] . '/less/style.less';
$app['assetic.output.path_to_css']		= 'css/styles.css';
$app['assetic.input.path_to_js']		= array(
	PATH_VENDOR . '/twitter/bootstrap/js/*.js',
	$app['assetic.input.path_to_assets'] . '/js/script.js',
);
$app['assetic.output.path_to_js']		= 'js/scripts.js';

// Doctrine (db).
$app['db.options'] = array(
	'driver'	=> 'pdo_mysql',
	'host'		=> 'localhost',
	'dbname'	=> 'peluqueria',
	'user'		=> 'root',
	'password'	=> 'Soypr098.',
    'charset'   => 'utf8',
    'driverOptions' => array(
        1002=>'SET NAMES utf8'
    )
);

// User.
//$app['security.users'] = array( 'kailash' => array( 'ROLE_USER', 'password' ) );

$app['debug'] = true;