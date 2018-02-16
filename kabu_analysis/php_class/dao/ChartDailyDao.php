<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/ChartDailyBaseDao.php');
class ChartDailyDao extends ChartDailyBaseDao {

	private $SQL_ORDER_BY_BASE = '
  order by
    c.shoken_code,
    c.torihiki_date';

	/**
	 * ChartDailyを検索する.
	 *
	 * @param unknown $conditions
	 */
	public function findByConditions(ChartSearchForm $conditions) {
		$sql = "SELECT * ";
		$sql .= " , CASE WHEN ";
		$sql .= $conditions->createWhereBuy ();
		$sql .= " THEN 1 ELSE 0 END AS buy_flg ";
		$sql .= " , CASE WHEN ";
		$sql .= $conditions->createWhereSell ();
		$sql .= " THEN 1 ELSE 0 END AS sell_flg ";
		$sql .= " FROM chart_daily c ";
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
