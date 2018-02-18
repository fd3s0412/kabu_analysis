<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/entity/Chart5m.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/Chart5mBaseDao.php');
class Chart5mDao extends Chart5mBaseDao {
	private $SQL_INSERT = '
INSERT
INTO chart5m(
  shoken_code
  , torihiki_date
  , torihiki_time
  , hajimene
  , takane
  , yasune
  , owarine
  , dekidaka
  , macd
  , signal
  , osci
  , rsi
  , ema_kairiritsu_12
  , ema_kairiritsu_26
  , ema_12
  , ema_26
)
VALUES (
  :shoken_code
  , :torihiki_date
  , :torihiki_time
  , :hajimene
  , :takane
  , :yasune
  , :owarine
  , :dekidaka
  , :macd
  , :signal
  , :osci
  , :rsi
  , :ema_kairiritsu_12
  , :ema_kairiritsu_26
  , :ema_12
  , :ema_26
)';
	private $SQL_UPDATE = '
UPDATE chart5m
SET
  hajimene = :hajimene
  , takane = :takane
  , yasune = :yasune
  , owarine = :owarine
  , dekidaka = :dekidaka
  , macd = :macd
  , signal = :signal
  , osci = :osci
  , rsi = :rsi
  , ema_kairiritsu_12 = :ema_kairiritsu_12
  , ema_kairiritsu_26 = :ema_kairiritsu_26
  , ema_12 = :ema_12
  , ema_26 = :ema_26
WHERE
  shoken_code = :shoken_code
  AND torihiki_date = :torihiki_date
  AND torihiki_time = :torihiki_time';
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
	 * 登録する.
	 *
	 * @param unknown $entity
	 * @return multitype:
	 */
	public function insert(Chart5m $entity) {
		$stmt = $this->conn->prepare ( $this->SQL_INSERT );
		$stmt->bindParam ( ':shoken_code', $entity->shoken_code );
		$stmt->bindParam ( ':torihiki_date', $entity->torihiki_date );
		$stmt->bindParam ( ':torihiki_time', $entity->torihiki_time );
		$stmt->bindParam ( ':hajimene', $entity->hajimene );
		$stmt->bindParam ( ':takane', $entity->takane );
		$stmt->bindParam ( ':yasune', $entity->yasune );
		$stmt->bindParam ( ':owarine', $entity->owarine );
		$stmt->bindParam ( ':dekidaka', $entity->dekidaka );
		$stmt->bindParam ( ':macd', $entity->macd );
		$stmt->bindParam ( ':signal', $entity->signal );
		$stmt->bindParam ( ':osci', $entity->osci );
		$stmt->bindParam ( ':rsi', $entity->rsi );
		$stmt->bindParam ( ':ema_kairiritsu_12', $entity->ema_kairiritsu_12 );
		$stmt->bindParam ( ':ema_kairiritsu_26', $entity->ema_kairiritsu_26 );
		$stmt->bindParam ( ':ema_12', $entity->ema_12 );
		$stmt->bindParam ( ':ema_26', $entity->ema_26 );
		$stmt->execute ();
	}

	/**
	 * 更新する.
	 *
	 * @param unknown $entity
	 * @return multitype:
	 */
	public function update(Chart5m $entity) {
		$stmt = $this->conn->prepare ( $this->SQL_UPDATE );
		$stmt->bindParam ( ':shoken_code', $entity->shoken_code );
		$stmt->bindParam ( ':torihiki_date', $entity->torihiki_date );
		$stmt->bindParam ( ':torihiki_time', $entity->torihiki_time );
		$stmt->bindParam ( ':hajimene', $entity->hajimene );
		$stmt->bindParam ( ':takane', $entity->takane );
		$stmt->bindParam ( ':yasune', $entity->yasune );
		$stmt->bindParam ( ':owarine', $entity->owarine );
		$stmt->bindParam ( ':dekidaka', $entity->dekidaka );
		$stmt->bindParam ( ':macd', $entity->macd );
		$stmt->bindParam ( ':signal', $entity->signal );
		$stmt->bindParam ( ':osci', $entity->osci );
		$stmt->bindParam ( ':rsi', $entity->rsi );
		$stmt->bindParam ( ':ema_kairiritsu_12', $entity->ema_kairiritsu_12 );
		$stmt->bindParam ( ':ema_kairiritsu_26', $entity->ema_kairiritsu_26 );
		$stmt->bindParam ( ':ema_12', $entity->ema_12 );
		$stmt->bindParam ( ':ema_26', $entity->ema_26 );
		$stmt->execute ();
	}

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
	public function findByConditions(ChartSearchForm $conditions) {
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
