<?php
require_once (dirname ( __FILE__ ) . '/Chart5mBaseDao.php');
class Chart5mDao extends Chart5mBaseDao {
	private $SQL_FIND_BY_SHOKEN_CD = '
  select
    *
  from
    chart5m c
  where
    c.shoken_code = :shoken_code
  order by
    c.torihiki_date,
    c.torihiki_time';

	/**
	 * 証券コードによって、日足データを検索します.
	 *
	 * @param unknown $shokenCd
	 * @return unknown
	 */
	public function findByShokenCd($shokenCd) {
		$stmt = $this->conn->prepare ( $this->SQL_FIND_BY_SHOKEN_CD );
		$stmt->bindParam ( ':shoken_code', $shokenCd );
		$stmt->execute ();
		return parent::getResultList ( $stmt );
	}
}
