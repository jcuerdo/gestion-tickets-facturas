<?php
namespace Model
{

	/**
	 * provide users to the security service
	 */
	class ServiceModel extends BaseModel
	{

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
			foreach ( $services as $key => $value) {
                $iva = isset($value['iva']) ? $value['iva'] : $this->app['iva'];
				$services[$key]['price'] = $value['base_price'] * ( ( $iva / 100 ) + 1 );
			}

			return $services;
		}

        public function getService($idService)
        {

            $sql = <<<SQL
SELECT
	*
FROM
	`service`
WHERE id_service = ? 
SQL;

            $stmt = $this->db->executeQuery( $sql, array($idService) );

            if ( !$service = $stmt->fetch() )
            {
                return array();
			}
			
			$iva = isset($service['iva']) ? $service['iva'] : $this->app['iva'];
			$service['price'] = $service['base_price'] * ( ( $iva / 100 ) + 1 );

            return $service;
		}
		
		public function createService( $serviceName, $basePrice )
		{
			$sql = <<<SQL
INSERT INTO
	`service` 
	( `name`, `base_price`,  `iva`)
	VALUES 
	( ?, ?, ? )
SQL;
			$stmt = $this->db->executeQuery( $sql, array( $serviceName, floatval($basePrice), $this->app['iva'] ) );
			if ( !$this->db->lastInsertId() )
			{
				throw new \Exception( sprintf( 'Service not created' ) );
			}

			return $this->db->lastInsertId();
		}

		public function updateService( $serviceId, $basePrice )
{
	$sql = <<<SQL
UPDATE
`service` 
set base_price = ?, iva = ? where id_service = ?
SQL;
	$stmt = $this->db->executeQuery( $sql, array( floatval($basePrice),$this->app['iva'], intVal($serviceId) ) );
	
	return $stmt;
}

public function deleteService( $serviceId )
{
	if($this->serviceHasTickets($serviceId )){
		throw new \Exception( sprintf( 'Service has tickets associated' ) );
	}

	$sql = <<<SQL
DELETE FROM
`service` 
where id_service = ?
SQL;
	$stmt = $this->db->executeQuery( $sql, array( intVal($serviceId) ) );
	
	return $stmt;
}




private function serviceHasTickets( $serviceId )
{
	$sql = <<<SQL
SELECT COUNT(*) as total FROM
`ticket_service` 
where id_service = ?
SQL;
$stmt = $this->db->executeQuery( $sql, array($serviceId) );

if ( !$service = $stmt->fetch() )
{
	return false;
}

return $service['total'] > 0;

}

}
}

