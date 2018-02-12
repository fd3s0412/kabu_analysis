<?php
class BaseDao {

	protected $conn;

	function __construct() {
		$this->conn = new PDO ( "sqlite:" . $_SERVER['DOCUMENT_ROOT'] . "/kabu_analysis/db/kabu.sqlite" );
	}
}
