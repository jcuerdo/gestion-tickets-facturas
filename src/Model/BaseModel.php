<?php
namespace Model;

class BaseModel
{
	protected $db;
	protected $app;

	function __construct( $app )
	{
		$this->db = $app['db'];
		$this->app = $app;
	}
 
}