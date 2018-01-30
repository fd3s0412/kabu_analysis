<?php

class KabukaService
{

    public static function getKabukaList($conn)
    {
        $resultList = array();

        $sql = "SELECT * FROM kabuka ORDER BY yoku_eigyobi DESC, juni";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            $result = array(
                'btn_bunseki' => ComnUtil::getLinkTagBunsekiRuiji($row['shoken_code'], $row['juni'], $row['torihikine'], $row['zenjitsuhi_ritsu'], $row['uehigeritsu'], $row['gyoshu']),
                'juni' => $row['juni'],
                'shoken_code' => $row['shoken_code'],
                'kaishamei' => $row['kaishamei'],
                'shijo' => $row['shijo'],
                'torihiki_date' => $row['torihiki_date'],
                'torihikine' => $row['torihikine'],
                'zenjitsuhi_gaku' => $row['zenjitsuhi_gaku'],
                'zenjitsuhi_ritsu' => $row['zenjitsuhi_ritsu'],
                'dekidaka' => $row['dekidaka'],
                'takane' => $row['takane'],
                'yasune' => $row['yasune'],
                'uehigeritsu' => $row['uehigeritsu'],
                'gyoshu' => $row['gyoshu'],
                'yoku_eigyobi' => $row['yoku_eigyobi'],
                'yoku_yoritsuki' => $row['yoku_yoritsuki'],
                'yoku_takane' => $row['yoku_takane'],
                'yoku_yasune' => $row['yoku_yasune'],
                'kanosei_win' => $row['kanosei_win'],
                'kanosei_lose' => $row['kanosei_lose'],
                'yoritsuki_kairiritsu' => $row['yoritsuki_kairiritsu'],
                'judge' => $row['judge'],
                'pips' => $row['pips'],
                'p_k' => $row['p_k']
            );
            array_push($resultList, $result);
        }

        return $resultList;
    }
}
