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
			$servicesController->get("/add", array( $this, 'addService' ) )->bind( 'services_add' );
			$servicesController->get("/edit", array( $this, 'editService' ) )->bind( 'services_edit' );
			$servicesController->get("/update", array( $this, 'updateService' ) )->bind( 'services_update' );
			$servicesController->get("/delete", array( $this, 'deleteService' ) )->bind( 'services_delete' );

			
			return $servicesController;
		}
		public function showAll( Application $app )
		{
			$service_model = new ServiceModel( $app );
			$services = $service_model->getServices();
			return $app['twig']->render( 'services/services.tpl', array( 'services' => $services ) );
		}

		public function addService( Application $app )
		{
			$serviceName = $app['request']->get('service_name');
			$serviceBasePrice = $app['request']->get('service_base_price');
			$servicePrice = $app['request']->get('service_price');

			$service_model = new ServiceModel( $app );
			$created = $service_model->createService($serviceName,$serviceBasePrice);

			if ($created) {
				$app['session']->getFlashBag()->add('success', "Servicio creado correctamente");
			} else{
				$app['session']->getFlashBag()->add('error', "No ha sido posible crear el servicio");

			}

			return $app->redirect('/services');
		}

		public function editService(Application $app) {
			$serviceId = $app['request']->get('id_service');
			$service_model = new ServiceModel( $app );
			$service = $service_model->getService($serviceId);

			return $app['twig']->render( 'services/edit.tpl', array( 'service' => $service ) );

		}

		public function updateService( Application $app )
		{
			$serviceId = $app['request']->get('id_service');
			$serviceBasePrice = $app['request']->get('service_base_price');
			$servicePrice = $app['request']->get('service_price');

			$service_model = new ServiceModel( $app );
			$created = $service_model->updateService($serviceId,$serviceBasePrice);

			if ($created) {
				$app['session']->getFlashBag()->add('success', "Servicio editado correctamente");
			} else{
				$app['session']->getFlashBag()->add('error', "No ha sido posible editar el servicio");

			}

			return $app->redirect('/services');
		}

		public function deleteService( Application $app )
		{
			$serviceId = $app['request']->get('id_service');

			$service_model = new ServiceModel( $app );
			try{
				$created = $service_model->deleteService($serviceId);
			} catch(\Exception $e){
				$app['session']->getFlashBag()->add('error', "El servicio tiene tickets asociados por lo que no es posible borrarlo");
			}

			if ($created) {
				$app['session']->getFlashBag()->add('success', "Servicio borrado correctamente");
			} else{
				$app['session']->getFlashBag()->add('error', "No ha sido posible borrar el servicio");

			}

			return $app->redirect('/services');
		}
	}
}