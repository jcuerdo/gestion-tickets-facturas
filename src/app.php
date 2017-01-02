<?php

use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use SilexAssetic\AsseticServiceProvider;
use Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder;
use Symfony\Component\Translation\Loader\YamlFileLoader;

$app->register(new HttpCacheServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new UrlGeneratorServiceProvider());

// Security definition.
$app->register(new SecurityServiceProvider(), array(
	'security.firewalls' => array(
		// Login URL is open to everybody.
		'login' => array(
			'pattern' => '^/user/login$',
			'anonymous' => true,
		),
		// Any other URL requires auth.
		'site' => array(
			'pattern' => '^/.*$',
			'form'	=> array(
				'login_path'		 => '/user/login',
				'username_parameter' => 'form[username]',
				'password_parameter' => 'form[password]',
			),
			'anonymous' => false,
			'logout'	=> array('logout_path' => '/user/logout'),
			'users' => $app->share( function () use ( $app )
			{
				return new Model\UserProvider( $app );
			} ),
		),
	),
));

// PlainText by default, you can modify the encoder digest as you want.
$app['security.encoder.digest'] = $app->share(function ($app) {
	return new PlaintextPasswordEncoder();
});

// Translation definition.
$app->register(new TranslationServiceProvider());
$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
	$translator->addLoader( 'yaml', new YamlFileLoader() );
	$translator->addResource( 'yaml', PATH_LOCALES . '/es.yml', 'es' );
	return $translator;
}));

// Log definition.
$app->register(new MonologServiceProvider(), array(
	'monolog.logfile' => PATH_LOG . '/app.log',
	'monolog.name'	=> 'app',
	'monolog.level'   => 300 // = Logger::WARNING
));

// Template system definition.
$app->register(new TwigServiceProvider(), array(
	'twig.options'		=> array(
		'cache'			=> isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
		'strict_variables' => true
	),
	'twig.form.templates' => array( 'form_div_layout.html.twig', 'common/form_div_layout.tpl' ),
	'twig.path'		   => array( PATH_VIEWS )
));

// Define assets.
if (isset($app['assetic.enabled']) && $app['assetic.enabled']) {
	$app->register(new AsseticServiceProvider(), array(
		'assetic.options' => array(
			'debug'			=> $app['debug'],
			'auto_dump_assets' => $app['debug'],
		),
		'assetic.filters' => $app->protect(function($fm) use ($app) {
			$fm->set('lessphp', new Assetic\Filter\LessphpFilter());
		}),
		'assetic.assets' => $app->protect(function($am, $fm) use ($app) {
			$am->set('styles', new Assetic\Asset\AssetCache(
				new Assetic\Asset\GlobAsset(
					$app['assetic.input.path_to_css'],
					array($fm->get('lessphp'))
				),
				new Assetic\Cache\FilesystemCache($app['assetic.path_to_cache'])
			));
			$am->get('styles')->setTargetPath($app['assetic.output.path_to_css']);

			$am->set('scripts', new Assetic\Asset\AssetCache(
				new Assetic\Asset\GlobAsset(
					$app['assetic.input.path_to_js']
				),
				new Assetic\Cache\FilesystemCache($app['assetic.path_to_cache'])
			));
			$am->get('scripts')->setTargetPath($app['assetic.output.path_to_js']);
		})
	));
}

//Error pages
$app->error(function (\Exception $e, $code) use($app) {
    switch ($code) {
        case 404:
            $message = $app['twig']->render('error/404.tpl');
            break;
        default:
            $message = $app['twig']->render('error/default.tpl');
    }

    return new Symfony\Component\HttpFoundation\Response($message, $code);
});

$app->register(new Silex\Provider\DoctrineServiceProvider());

$app['id_shop'] = $app['session']->get('id_shop');

require PATH_SRC . '/routes.php';

return $app;
