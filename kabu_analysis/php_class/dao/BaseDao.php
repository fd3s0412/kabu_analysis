<?php
class BaseDao {

	protected $conn;

	function __construct() {
		$this->conn = new PDO ( "sqlite:/home/boc-fd3s/www/kabu_analysis/db/kabu.sqlite" );
	}
}
