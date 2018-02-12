<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/Chart5mBaseDao.php');
class Chart5mDao extends Chart5mBaseDao {
	private $SQL_SELECT_BASE = '
  select
    *
  from
    chart5m c';
	private $SQL_FIND_BY_SHOKEN_CD = '
  where
    c.shoken_code = :shoken_code';
	private $SQL_ORDER_BY_BASE = '
  order by
    c.shoken_code,
    c.torihiki_date,
    c.torihiki_time';

	/**
	 * 証券コードによって、日足データを検索します.
	 *
	 * @param unknown $shokenCd
	 * @return unknown
	 */
	public function findByShokenCd($shokenCd) {
		$sql = $this->SQL_SELECT_BASE . $this->SQL_FIND_BY_SHOKEN_CD . $this->SQL_ORDER_BY_BASE;
		$stmt = $this->conn->prepare ( $sql );
		$stmt->bindParam ( ':shoken_code', $shokenCd );
		$stmt->execute ();
		return parent::getResultList ( $stmt );
	}

	/**
	 * Chart5mを検索する.
	 *
	 * @param unknown $conditions
	 */
	public function findByConditions(Chart5mSearchForm $conditions) {
		$sql = "SELECT * ";
		$sql .= " , CASE WHEN ";
		$sql .= $conditions->createWhereBuy ();
		$sql .= " THEN 1 ELSE 0 END AS buy_flg ";
		$sql .= " , CASE WHEN ";
		$sql .= $conditions->createWhereSell ();
		$sql .= " THEN 1 ELSE 0 END AS sell_flg ";
		$sql .= " FROM chart5m c ";
		$sql .= " WHERE 1=1 ";
		$sql .= $conditions->createWhereCommon ();
		$sql .= $this->SQL_ORDER_BY_BASE;
		ChromePhp::log ( $sql );
		$stmt = $this->conn->prepare ( $sql );
		$conditions->setBindParam ( $stmt );
		$stmt->execute ();
		return parent::getResultList ( $stmt );
	}
}
