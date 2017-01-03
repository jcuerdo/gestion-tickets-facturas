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

            return $service;
        }
}
}
