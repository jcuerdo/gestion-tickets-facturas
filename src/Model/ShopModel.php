<?php
namespace Model
{

	/**
	 * provide users to the security service
	 */
	class ShopModel extends BaseModel
	{
		public function getShop( $id_shop )
		{
			$sql = <<<SQL
SELECT 
	*
FROM
	`shop` 
WHERE
	id_shop = ?
SQL;
			$stmt = $this->db->executeQuery( $sql, array( $id_shop ) );
			if ( !$shop = $stmt->fetch() )
			{
				return array();
			}

			return $shop;
		}
	}
}
