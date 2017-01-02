<?php
namespace Controller
{
	use Silex\Application;
	use Silex\ControllerProviderInterface;
	use Model\TicketModel;
	use Model\ServiceModel;
	use Model\ShopModel;

	class TicketController implements ControllerProviderInterface
	{
		public function connect( Application $app )
		{
			$ticketController = $app['controllers_factory'];
			$ticketController->get("/", array( $this, 'showAll' ) )->bind( 'tickets_show' );
			$ticketController->get("/add", array( $this, 'add' ) )->bind( 'ticket_add' );
			$ticketController->get("/create", array( $this, 'create' ) )->bind( 'ticket_create' );
			$ticketController->get("/delete/{id_ticket}", array( $this, 'delete' ) )->bind( 'ticket_delete' );
			$ticketController->get("/ticket/{id_ticket}", array( $this, 'show' ) )->bind( 'ticket_show' )->assert( 'id_ticket', '[0-9]+') ;
			$ticketController->get("/report", array( $this, 'getTicketReport' ) )->bind( 'tickets_report' );

			$ticketController->get("/createservice", array( $this, 'createService' ) )->bind( 'service_create' );
			$ticketController->get("/deleteservice", array( $this, 'deleteService' ) )->bind( 'delete_service' );

			return $ticketController;
		}

		public function add( Application $app )
		{	
			$date = date('d-m-Y');
			return $app['twig']->render( 'ticket/add.tpl', array( 'date' => $date ) );
		}

		public function create( Application $app )
		{	
			$ticket_model =  new TicketModel( $app );
			$id_shop = $app['id_shop'];
			$date = $app['request']->get( 'date' );
			$timestamp = strtotime( $date );
			$date = date("Y-m-d", $timestamp);
			$id_ticket = $ticket_model->createTicket( $date, $id_shop );

			return $app->redirect( "ticket/$id_ticket" );
		}

		public function show( Application $app )
		{
			$ticket_model =  new TicketModel( $app );
			$service_model =  new ServiceModel( $app );
			$id = $app['request']->get( 'id_ticket' );
			$ticket = $ticket_model->getTicketById( $id );
			$services_list = $service_model->getServices();
			$services = $ticket_model->getTicketServicesByIdTicket( $id );

			return $app['twig']->render( 'ticket/ticket.tpl', array( 'ticket' => $ticket, 'services' => $services, 'services_list' => $services_list ) );
		}

		public function showAll( Application $app )
		{
			$ticket_model =  new TicketModel( $app );
			$date = $app['request']->get( 'date' );
			$date = $date != null ? $date : date('d-m-Y');
			$timestamp = strtotime( $date );
			$date = date("Y-m-d", $timestamp);
			$tickets = $ticket_model->getTicketsByDate( $date );

			return $app['twig']->render( 'ticket/tickets.tpl', array( 'tickets' => $tickets, 'date' => $date ) );
		}

		public function delete( Application $app )
		{
			$ticket_model =  new TicketModel( $app );
			$id_ticket = $app['request']->get( 'id_ticket' );
			$ticket_model->deleteTicket( $id_ticket );

			return $this->showAll( $app );
		}

		public function deleteService( Application $app )
		{
			$ticket_model =  new TicketModel( $app );
			$id_ticket = $app['request']->get( 'id_ticket' );
			$id_ticket_service = $app['request']->get( 'id_ticket_service' );
			$ticket_model->deleteService( $id_ticket_service );

			return $app->redirect( "ticket/$id_ticket" );
		}

		public function createService( Application $app )
		{
			$ticket_model =  new TicketModel( $app );
			$id_ticket = $app['request']->get( 'id_ticket' );
			$id_service = $app['request']->get( 'id_service' );
			$ticket_model->createTicketService( $id_ticket, $id_service );

			return $app->redirect( "ticket/$id_ticket" );
		}

		public function getTicketReport( Application $app )
		{
			$ticket_model =  new TicketModel( $app );
			$shop_model =  new ShopModel( $app );
			
			$start_date = $app['request']->get( 'start_date' );
			$start_date = $start_date != null ? $start_date : date('d-m-Y');
			$timestamp = strtotime( $start_date );
			$start_date = date("Y-m-d", $timestamp);
			
			$end_date = $app['request']->get( 'end_date' );
			$end_date = $end_date != null ? $end_date : date('d-m-Y');
			$timestamp = strtotime( $end_date );
			$end_date = date("Y-m-d", $timestamp);
			
			$report = $ticket_model->getTicketReport( $start_date, $end_date, $app['id_shop'], $app['iva'] );
			$shop = $shop_model->getShop( $app['id_shop'] );

			$version = $app['request']->get( 'version' );

			if( 'print' == $version )
			{
                $rendered = $this->getPrintVersion($app, $report, $start_date, $end_date, $shop);

                return $rendered;
			}
            else if( 'email' == $version )
            {
                $email = $app['request']->get( 'email' );
                $headers = "From: " . strip_tags($shop['email']) . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $emailSent = mail(
                    $email,
                    sprintf('Tickets desde %s hasta %s ', $start_date, $end_date),
                    $this->getPrintVersion($app, $report, $start_date, $end_date, $shop),
                    $headers
            );
                if($emailSent){
                    $app['session']->getFlashBag()->add('success', "Se ha enviado correctamente el reporte a $email");
                }else{
                    $app['session']->getFlashBag()->add('error', "No se ha podido enviar el reporte a $email");
                }


                $rendered = $this->getHtmlVersion($app, $report, $start_date, $end_date, $shop);

                return $rendered;
            }
			else
			{
                $rendered = $this->getHtmlVersion($app, $report, $start_date, $end_date, $shop);

                return $rendered;
            }
		}

        /**
         * @param Application $app
         * @param $tpl
         * @param $report
         * @param $start_date
         * @param $end_date
         * @param $shop
         * @return mixed
         */
        private function renderTicketReport(Application $app, $tpl, $report, $start_date, $end_date, $shop)
        {
            $rendered = $app['twig']->render($tpl,
                array(
                    'report' => $report,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'iva' => $app['iva'],
                    'shop' => $shop
                )
            );
            return $rendered;
        }

        /**
         * @param Application $app
         * @param $report
         * @param $start_date
         * @param $end_date
         * @param $shop
         * @return mixed
         */
        private function getPrintVersion(Application $app, $report, $start_date, $end_date, $shop)
        {
            $tpl = 'ticket/report_print.tpl';
            $rendered = $this->renderTicketReport($app, $tpl, $report, $start_date, $end_date, $shop);
            return $rendered;
        }

        /**
         * @param Application $app
         * @param $report
         * @param $start_date
         * @param $end_date
         * @param $shop
         * @return mixed
         */
        private function getHtmlVersion(Application $app, $report, $start_date, $end_date, $shop)
        {
            $tpl = 'ticket/report.tpl';
            $rendered = $this->renderTicketReport($app, $tpl, $report, $start_date, $end_date, $shop);
            return $rendered;
        }
    }
}