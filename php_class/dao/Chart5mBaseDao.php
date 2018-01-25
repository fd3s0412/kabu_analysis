<?php
class Chart5mBaseDao {

	protected $conn;

	function __construct() {
		$this->conn = new PDO ( "sqlite:/home/boc-fd3s/www/chart5m.sqlite" );
	}
}
