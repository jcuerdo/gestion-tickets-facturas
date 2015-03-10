<?php

namespace Controller
{
	use Silex\Application;
	use Silex\ControllerProviderInterface;

	class UserController implements ControllerProviderInterface
	{
		public function connect( Application $app )
		{
			$userController = $app['controllers_factory'];
			$userController->get("/login", array( $this, 'login' ) )->bind( 'login' );
			$userController->get("/logout", array( $this, 'logout' ) )->bind( 'logout' );
			return $userController;
		}

		/**
		 * Login action.
		 *
		 * @param \Silex\Application $app
		 * @return mixed
		 */
		function login( Application $app )
		{
			return $app['twig']->render( 'user/login.tpl', array(
				'form'  => array(),
				'error' => $app['security.last_error']( $app['request'] ),
			) );
		}

		/**
		 * Logout action.
		 *
		 * @param \Silex\Application $app
		 * @return type
		 */
		function logout( Application $app )
		{
			$app['session']->clear();
			return $app->redirect( $app['url_generator']->generate( 'login' ) );
		}
	}
}