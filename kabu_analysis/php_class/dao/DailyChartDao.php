<?php
require_once (dirname ( __FILE__ ) . '/BaseDao.php');
class DailyChartDao extends BaseDao {
	private $SQL_FIND_BY_SHOKEN_CD = '
  select
    *
  from
    daily_chart dc
    left join daily_chart_analysis dca
      on dc.id = dca.id
  where
    dc.shoken_code = :shoken_code
  order by
    dc.torihiki_date';

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
					//'id' => $row ["id"],
					'torihiki_date' => $row ["torihiki_date"],
					'shoken_code' => $row ["shoken_code"],
					'kaishamei' => $row ["kaishamei"],
					'shijo' => $row ["shijo"],
					'hajimene' => $row ["hajimene"],
					'takane' => $row ["takane"],
					'yasune' => $row ["yasune"],
					'owarine' => $row ["owarine"],
					'dekidaka' => $row ["dekidaka"],
					'baibai_daikin' => $row ["baibai_daikin"],
					'ido_heikinsen_tanki' => $row ["ido_heikinsen_tanki"],
					'ido_heikinsen_chuki' => $row ["ido_heikinsen_chuki"],
					'ido_heikinsen_choki' => $row ["ido_heikinsen_choki"],
					'ido_heikin_kairiritsu_tanki' => $row ["ido_heikin_kairiritsu_tanki"],
					'ido_heikin_kairiritsu_chuki' => $row ["ido_heikin_kairiritsu_chuki"],
					'ido_heikin_kairiritsu_choki' => $row ["ido_heikin_kairiritsu_choki"],
					'hyojun_hensa' => $row ["hyojun_hensa"]
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
		return $this->getResultList ( $stmt );
	}
}
