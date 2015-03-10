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
				$services[$key]['price'] = $value['base_price'] * ( ( $this->app['iva'] / 100 ) + 1 );
			}

			return $services;
		}
}
}
