<?php
class KabuKohoService {
	public static function getKabuKohoList($conn) {
		$resultList = array ();

		$sql = "SELECT * FROM kabu_koho";
		$stmt = $conn->prepare ( $sql );
		$stmt->execute ();

		while ( $row = $stmt->fetch () ) {
			$result = array (
					'btn_bunseki' => ComnUtil::getLinkTagBunsekiRuiji($row['shoken_code'], $row['juni'], $row['torihikine'], $row['zenjitsuhi_ritsu'], $row['uehigeritsu'], $row['gyoshu']),
					'juni' => $row ['juni'],
					'shoken_code' => $row ['shoken_code'],
					'kaishamei' => $row ['kaishamei'],
					'shijo' => $row ['shijo'],
					'torihiki_date' => $row ['torihiki_date'],
					'torihikine' => $row ['torihikine'],
					'zenjitsuhi_gaku' => $row ['zenjitsuhi_gaku'],
					'zenjitsuhi_ritsu' => $row ['zenjitsuhi_ritsu'],
					'dekidaka' => $row ['dekidaka'],
					'takane' => $row ['takane'],
					'yasune' => $row ['yasune'],
					'uehigeritsu' => $row ['uehigeritsu'],
					'gyoshu' => $row ['gyoshu'],
					'yoku_eigyobi' => $row ['yoku_eigyobi']
			);
			array_push ( $resultList, $result );
		}

		return $resultList;
	}
}
