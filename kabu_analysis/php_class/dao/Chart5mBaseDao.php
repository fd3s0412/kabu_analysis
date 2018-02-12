<?php
class Chart5mBaseDao {

	protected $conn;

	function __construct() {
		$this->conn = new PDO ( "sqlite:" . $_SERVER['DOCUMENT_ROOT'] . "/kabu_analysis/db/chart5m.sqlite" );
	}

	/**
	 * SQL実行結果を連装配列にして返します.
	 *
	 * @param unknown $stmt
	 * @return multitype:
	 */
	public function getResultList($stmt) {
		$resultList = array ();
		while ( $row = $stmt->fetch () ) {
			$result = array ();
			foreach ( $row as $key => $value ) {
				if (!is_numeric ( $key )) {
					$result [$key] = $value;
				}
			}
			array_push ( $resultList, $result );
		}
		return $resultList;
	}
}
