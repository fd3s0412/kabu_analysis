<?php
require_once (dirname ( __FILE__ ) . '/Chart5mBaseDao.php');
class MasterMeigaraDao extends Chart5mBaseDao {
	private $SQL_FIND_BY_SHOKEN_CD = '
  select
    *
  from
    master_meigara
  where
    shoken_code = :shoken_code';

	/**
	 * SQL実行結果を連装配列にして返します.
	 *
	 * @param unknown $stmt
	 * @return multitype:
	 */
	private function getResultList($stmt) {
		$resultList = array ();
		while ( $row = $stmt->fetch () ) {
			$result = array (
					'koukai_date' => $row ["koukai_date"],
					'shoken_code' => $row ["shoken_code"],
					'meigaramei' => $row ["meigaramei"],
					'shijo_shohin_kubun' => $row ["shijo_shohin_kubun"],
					'gyoshu_code_a' => $row ["gyoshu_code_a"],
					'gyoshu_kubun_a' => $row ["gyoshu_kubun_a"],
					'gyoshu_code_b' => $row ["gyoshu_code_b"],
					'gyoshu_kubun_b' => $row ["gyoshu_kubun_b"],
					'kibo_code' => $row ["kibo_code"],
					'kibo_kubun' => $row ["kibo_kubun"]
			);
			array_push ( $resultList, $result );
		}
		return $resultList;
	}

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
		$list = $this->getResultList ( $stmt );
		if (count($list) > 0) {
			return $list[0];
		} else {
			return array();
		}
	}
}
