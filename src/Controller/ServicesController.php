<?php
namespace Controller
{
	use Silex\Application;
	use Silex\ControllerProviderInterface;
	use Model\ServiceModel;

	class ServicesController implements ControllerProviderInterface
	{
		public function connect( Application $app )
		{
			$servicesController = $app['controllers_factory'];
			$servicesController->get("/", array( $this, 'showAll' ) )->bind( 'services_show' );
			return $servicesController;
		}
		public function showAll( Application $app )
		{
			$service_model = new ServiceModel( $app );
			$services = $service_model->getServices();
			return $app['twig']->render( 'services/services.tpl', array( 'services' => $services ) );
		}
	}
}