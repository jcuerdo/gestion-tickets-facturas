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
	`date` = ?
SQL;

			$stmt = $this->db->executeQuery( $sql, array( $date ) );

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

			return $services;
		}

		public function createTicketService( $id_ticket, $id_service )
		{
			$sql = <<<SQL
INSERT INTO
	`ticket_service` 
	( `id_ticket`, `id_service` )
	VALUES 
	( ?, ? )
SQL;
			$stmt = $this->db->executeQuery( $sql, array( $id_ticket, $id_service ) );
			if ( !$this->db->lastInsertId() )
			{
				throw new Exception( sprintf( 'Service not created' ) );
			}

			return $this->db->lastInsertId();
		}

		public function getServices()
		{

			$sql = <<<SQL
SELECT
	*
FROM
	`service`
LIMIT 100;
SQL;

			$stmt = $this->db->executeQuery( $sql, array() );

			if ( !$services = $stmt->fetchAll() )
			{
				return array();
			}
			return $services;
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
}
}
