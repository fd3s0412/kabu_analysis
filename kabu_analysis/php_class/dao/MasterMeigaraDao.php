<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/Chart5mBaseDao.php');
class MasterMeigaraDao extends Chart5mBaseDao {
	private $SQL_FIND_BY_SHOKEN_CD = '
  select
    *
  from
    master_meigara
  where
    shoken_code = :shoken_code';

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
		$list = parent::getResultList ( $stmt );
		if (count($list) > 0) {
			return $list[0];
		} else {
			return null;
		}
	}
}
