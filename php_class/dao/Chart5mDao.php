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
	 * SQL実行結果を連装配列にして返します.
	 *
	 * @param unknown $stmt
	 * @return multitype:
	 */
	private function getResultList($stmt) {
		$resultList = array ();
		while ( $row = $stmt->fetch () ) {
			$result = array (
				'shoken_code' => $row ["shoken_code"],
				'torihiki_date' => $row ["torihiki_date"],
				'torihiki_time' => $row ["torihiki_time"],
				'hajimene' => $row ["price_open"],
				'takane' => $row ["price_high"],
				'yasune' => $row ["price_low"],
				'owarine' => $row ["price_close"],
				'volume' => $row ["volume"],
				'ma_short' => $row ["ma_short"],
				'ma_middle' => $row ["ma_middle"],
				'ma_long' => $row ["ma_long"],
				'macd' => $row ["macd"],
				'signal' => $row ["signal"],
				'osci' => $row ["osci"],
				'rsi' => $row ["rsi"]
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
