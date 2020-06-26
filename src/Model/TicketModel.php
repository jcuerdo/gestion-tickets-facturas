<?php
namespace Model
{

	/**
	 * provide users to the security service
	 */
	class TicketModel extends BaseModel
	{
		public function createTicket( $date, $id_shop )
		{
			$sql = <<<SQL
INSERT INTO
	`ticket` 
	( `date`, `id_shop` )
	VALUES 
	( ?, ? )
SQL;
			$stmt = $this->db->executeQuery( $sql, array( $date, $id_shop ) );
			if ( !$this->db->lastInsertId() )
			{
				throw new Exception( sprintf( 'Ticket not created' ) );
			}

			return $this->db->lastInsertId();
		}

		public function getTicketById( $id )
		{

			$sql = <<<SQL
SELECT
	*
FROM
	`ticket`
WHERE
	id_ticket = ?
SQL;

			$stmt = $this->db->executeQuery( $sql, array( $id ) );

			if ( !$ticket = $stmt->fetch() )
			{
				return array();
			}

			return $ticket;
		}

		public function getTicketsByDate( $date )
		{
			$sql = <<<SQL
SELECT
	*
FROM
	`ticket`
WHERE
	date(`date`) = ?
SQL;


			$stmt = $this->db->executeQuery( $sql, array( date('Y-m-d', strtotime($date)) ) );

			if ( !$tickets = $stmt->fetchAll() )
			{
				return array();
			}

			return $tickets;
		}

		public function getTicketServicesByIdTicket( $id )
		{

			$sql = <<<SQL
SELECT
	*
FROM
	`service` s
	INNER JOIN
	`ticket_service` ts
	USING( id_service ) 
WHERE
	ts.id_ticket = ?
SQL;

			$stmt = $this->db->executeQuery( $sql, array( $id ) );

			if ( !$services = $stmt->fetchAll() )
			{
				return array();
			}

			foreach ( $services as $key => $value) {
			    $iva = isset($value['iva_applied']) ? $value['iva_applied'] : $this->app['iva'];
			    $price = isset($value['base_price_applied']) ? $value['base_price_applied'] : $value['base_price'];
				$services[$key]['price'] = $price * ( ( $iva / 100 ) + 1 );
			}

			return $services;
		}

		public function createTicketService( $id_ticket, $id_service )
		{
		    $serviceModel = new ServiceModel($this->app);

		    $service = $serviceModel->getService($id_service);

            $basePrice = $service['base_price'];
            $iva = isset($service['iva']) ? $service['iva'] : $this->app['iva'];

			$sql = <<<SQL
INSERT INTO
	`ticket_service` 
	( `id_ticket`, `id_service`,`base_price_applied`,`iva_applied`)
	VALUES 
	( ?, ? ,? ,?)
SQL;
			$stmt = $this->db->executeQuery( $sql, array( $id_ticket, $id_service, $basePrice, $iva) );
			if ( !$this->db->lastInsertId() )
			{
				throw new Exception( sprintf( 'Service not created' ) );
			}

			return $this->db->lastInsertId();
		}

		public function deleteService( $id_ticket_service )
		{
			$sql = <<<SQL
DELETE FROM
	`ticket_service` 
	WHERE
	id_ticket_service = ?
SQL;
			$stmt = $this->db->executeQuery( $sql, array( $id_ticket_service ) );
		}

		public function deleteTicket( $id_ticket )
		{
			$sql_deleteTicket = <<<SQL
DELETE FROM
	`ticket` 
	WHERE
	id_ticket = ?
SQL;
			$sql_deleteRelatedServices = <<<SQL
DELETE FROM
	`ticket_service` 
	WHERE
	id_ticket = ?
SQL;
			$this->db->beginTransaction();
			$stmt = $this->db->executeQuery( $sql_deleteTicket, array( $id_ticket ) );
			$stmt = $this->db->executeQuery( $sql_deleteRelatedServices, array( $id_ticket ) );
			$this->db->commit();
		}

		public function getTicketReport( $start_date, $end_date, $id_shop, $iva )
		{

			$sql = <<<SQL
SELECT
	t.date,
	t.id_ticket,
	s.name,
	s.base_price,
	ts.base_price_applied,
	ts.iva_applied
FROM
	`service` s
	INNER JOIN `ticket_service` ts
	USING( id_service ) 
	INNER JOIN  `ticket` t
	USING( id_ticket )
WHERE
	t.date >= ? AND 
	t.date <= ? AND
	t.id_shop = ?
ORDER BY 
	t.date ASC,
	t.id_ticket ASC
SQL;

			$stmt = $this->db->executeQuery( $sql, array( $start_date, $end_date, $id_shop ) );

			if ( !$services = $stmt->fetchAll() )
			{
				return array();
			}

			$base_total = 0;
			$price_total = 0;
			foreach( $services as $service )
			{
                $iva = isset($service['iva_applied']) ? $service['iva_applied'] : $iva;
                $basePrice = isset($service['base_price_applied']) ? $service['base_price_applied'] : $service['base_price'];
                $price = $basePrice * ( ( $iva / 100 ) + 1);

                $base_total += $basePrice;
                $price_total += $price;

				$service['price'] = $price;
				$service['base_price'] = $basePrice;
				$service['iva'] = $iva;

				$report['tickets'][$service['id_ticket']]['services'][] = $service;
			    $report['tickets'][$service['id_ticket']]['date'] = $service['date'];
			}
				$report['base_total'] = $base_total;
				$report['total'] = $base_total * ( ( $iva / 100 ) + 1 );

			return $report;
		}
}
}
