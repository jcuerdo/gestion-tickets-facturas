<?php
namespace Controller
{
	use Silex\Application;
	use Silex\ControllerProviderInterface;
	use Model\TicketModel;

	class TicketController implements ControllerProviderInterface
	{
		public function connect( Application $app )
		{
			$indexController = $app['controllers_factory'];
			$indexController->get("/", array( $this, 'showAll' ) )->bind( 'tickets_show' );
			$indexController->get("/add", array( $this, 'add' ) )->bind( 'ticket_add' );
			$indexController->get("/create", array( $this, 'create' ) )->bind( 'ticket_create' );
			$indexController->get("/delete/{id_ticket}", array( $this, 'delete' ) )->bind( 'ticket_delete' );
			$indexController->get("/ticket/{id_ticket}", array( $this, 'show' ) )->bind( 'ticket_show' )->assert( 'id_ticket', '[0-9]+') ;

			$indexController->get("/createservice", array( $this, 'createService' ) )->bind( 'service_create' );
			$indexController->get("/deleteservice", array( $this, 'deleteService' ) )->bind( 'delete_service' );

			return $indexController;
		}

		public function add( Application $app )
		{	
			$date = date('d-m-Y');
			return $app['twig']->render( 'ticket/add.tpl', array( 'date' => $date ) );
		}

		public function create( Application $app )
		{	
			$ticket_model =  new TicketModel( $app['db'] );
			$id_shop = $app['id_shop'];
			$date = $app['request']->get( 'date' );
			$timestamp = strtotime( $date );
			$date = date("Y-m-d", $timestamp);
			$id_ticket = $ticket_model->createTicket( $date, $id_shop );

			return $app->redirect( "ticket/$id_ticket" );
		}

		public function show( Application $app )
		{
			$ticket_model =  new TicketModel( $app['db'] );
			$id = $app['request']->get( 'id_ticket' );
			$ticket = $ticket_model->getTicketById( $id );
			$services_list = $ticket_model->getServices();
			$services = $ticket_model->getTicketServicesByIdTicket( $id );

			return $app['twig']->render( 'ticket/ticket.tpl', array( 'ticket' => $ticket, 'services' => $services, 'services_list' => $services_list ) );
		}

		public function showAll( Application $app )
		{
			$ticket_model =  new TicketModel( $app['db'] );
			$date = $app['request']->get( 'date' );
			$date = $date != null ? $date : date('d-m-Y');
			$timestamp = strtotime( $date );
			$date = date("Y-m-d", $timestamp);
			$tickets = $ticket_model->getTicketsByDate( $date );

			return $app['twig']->render( 'ticket/tickets.tpl', array( 'tickets' => $tickets, 'date' => $date ) );
		}

		public function delete( Application $app )
		{
			$ticket_model =  new TicketModel( $app['db'] );
			$id_ticket = $app['request']->get( 'id_ticket' );
			$ticket_model->deleteTicket( $id_ticket );

			return $this->showAll( $app );
		}

		public function deleteService( Application $app )
		{
			$ticket_model =  new TicketModel( $app['db'] );
			$id_ticket = $app['request']->get( 'id_ticket' );
			$id_ticket_service = $app['request']->get( 'id_ticket_service' );
			$ticket_model->deleteService( $id_ticket_service );

			return $app->redirect( "ticket/$id_ticket" );
		}

		public function createService( Application $app )
		{
			$ticket_model =  new TicketModel( $app['db'] );
			$id_ticket = $app['request']->get( 'id_ticket' );
			$id_service = $app['request']->get( 'id_service' );
			$ticket_model->createTicketService( $id_ticket, $id_service );

			return $app->redirect( "ticket/$id_ticket" );
		}
	}
}