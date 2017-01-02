<?php

// Local
$app['locale'] = 'es';
$app['session.default_locale'] = $app['locale'];
$app['translator.messages'] = array(
	'es' => PATH_LOCALES . '/es.yml',
);

$app['iva'] = 21;

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
    'host'          =>  getenv('OPENSHIFT_MYSQL_DB_HOST'),
    'port'          =>  getenv('OPENSHIFT_MYSQL_DB_PORT'),
    'dbname'          =>  getenv('OPENSHIFT_APP_NAME'),
    'user'          =>  getenv('OPENSHIFT_MYSQL_DB_USERNAME'),
    'password'	=>  getenv('OPENSHIFT_MYSQL_DB_PASSWORD'),
    'charset'   => 'utf8',
    'driverOptions' => array(
        1002=>'SET NAMES utf8'
    )
);

$app->register(new Silex\Provider\SessionServiceProvider());

// User.
//$app['security.users'] = array( 'kailash' => array( 'ROLE_USER', 'password' ) );

$app['debug'] = false;