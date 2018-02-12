<?php
class Chart5mSearchForm {
	public $shoken_code;
	public $torihiki_date_from;
	public $torihiki_date_to;
	public $torihiki_time_from;
	public $torihiki_time_to;
	public $buy_hajimene_from;
	public $buy_hajimene_to;
	public $buy_takane_from;
	public $buy_takane_to;
	public $buy_yasune_from;
	public $buy_yasune_to;
	public $buy_owarine_from;
	public $buy_owarine_to;
	public $buy_macd_from;
	public $buy_macd_to;
	public $buy_signal_from;
	public $buy_signal_to;
	public $buy_osci_from;
	public $buy_osci_to;
	public $buy_rsi_from;
	public $buy_rsi_to;
	public $buy_ema_kairiritsu_12_from;
	public $buy_ema_kairiritsu_12_to;
	public $buy_ema_kairiritsu_26_from;
	public $buy_ema_kairiritsu_26_to;
	public $buy_ema_12_from;
	public $buy_ema_12_to;
	public $buy_ema_26_from;
	public $buy_ema_26_to;
	public $sell_hajimene_from;
	public $sell_hajimene_to;
	public $sell_takane_from;
	public $sell_takane_to;
	public $sell_yasune_from;
	public $sell_yasune_to;
	public $sell_owarine_from;
	public $sell_owarine_to;
	public $sell_macd_from;
	public $sell_macd_to;
	public $sell_signal_from;
	public $sell_signal_to;
	public $sell_osci_from;
	public $sell_osci_to;
	public $sell_rsi_from;
	public $sell_rsi_to;
	public $sell_ema_kairiritsu_12_from;
	public $sell_ema_kairiritsu_12_to;
	public $sell_ema_kairiritsu_26_from;
	public $sell_ema_kairiritsu_26_to;
	public $sell_ema_12_from;
	public $sell_ema_12_to;
	public $sell_ema_26_from;
	public $sell_ema_26_to;
	public $songiriritsu;
	public $execute;
	public function __construct() {
		if (isset ( $_GET ['execute'] )) {
			if (isset ( $_GET ['shoken_code'] ) && strlen ( $_GET ['shoken_code'] ) > 0) {
				$this->shoken_code = $_GET ['shoken_code'];
			}
			if (isset ( $_GET ['torihiki_date_from'] ) && strlen ( $_GET ['torihiki_date_from'] ) > 0) {
				$this->torihiki_date_from = $_GET ['torihiki_date_from'];
			}
			if (isset ( $_GET ['torihiki_date_to'] ) && strlen ( $_GET ['torihiki_date_to'] ) > 0) {
				$this->torihiki_date_to = $_GET ['torihiki_date_to'];
			}
			if (isset ( $_GET ['torihiki_time_from'] ) && strlen ( $_GET ['torihiki_time_from'] ) > 0) {
				$this->torihiki_time_from = $_GET ['torihiki_time_from'];
			}
			if (isset ( $_GET ['torihiki_time_to'] ) && strlen ( $_GET ['torihiki_time_to'] ) > 0) {
				$this->torihiki_time_to = $_GET ['torihiki_time_to'];
			}
			if (isset ( $_GET ['buy_hajimene_from'] ) && strlen ( $_GET ['buy_hajimene_from'] ) > 0) {
				$this->buy_hajimene_from = $_GET ['buy_hajimene_from'];
			}
			if (isset ( $_GET ['buy_hajimene_to'] ) && strlen ( $_GET ['buy_hajimene_to'] ) > 0) {
				$this->buy_hajimene_to = $_GET ['buy_hajimene_to'];
			}
			if (isset ( $_GET ['buy_takane_from'] ) && strlen ( $_GET ['buy_takane_from'] ) > 0) {
				$this->buy_takane_from = $_GET ['buy_takane_from'];
			}
			if (isset ( $_GET ['buy_takane_to'] ) && strlen ( $_GET ['buy_takane_to'] ) > 0) {
				$this->buy_takane_to = $_GET ['buy_takane_to'];
			}
			if (isset ( $_GET ['buy_yasune_from'] ) && strlen ( $_GET ['buy_yasune_from'] ) > 0) {
				$this->buy_yasune_from = $_GET ['buy_yasune_from'];
			}
			if (isset ( $_GET ['buy_yasune_to'] ) && strlen ( $_GET ['buy_yasune_to'] ) > 0) {
				$this->buy_yasune_to = $_GET ['buy_yasune_to'];
			}
			if (isset ( $_GET ['buy_owarine_from'] ) && strlen ( $_GET ['buy_owarine_from'] ) > 0) {
				$this->buy_owarine_from = $_GET ['buy_owarine_from'];
			}
			if (isset ( $_GET ['buy_owarine_to'] ) && strlen ( $_GET ['buy_owarine_to'] ) > 0) {
				$this->buy_owarine_to = $_GET ['buy_owarine_to'];
			}
			if (isset ( $_GET ['buy_macd_from'] ) && strlen ( $_GET ['buy_macd_from'] ) > 0) {
				$this->buy_macd_from = $_GET ['buy_macd_from'];
			}
			if (isset ( $_GET ['buy_macd_to'] ) && strlen ( $_GET ['buy_macd_to'] ) > 0) {
				$this->buy_macd_to = $_GET ['buy_macd_to'];
			}
			if (isset ( $_GET ['buy_signal_from'] ) && strlen ( $_GET ['buy_signal_from'] ) > 0) {
				$this->buy_signal_from = $_GET ['buy_signal_from'];
			}
			if (isset ( $_GET ['buy_signal_to'] ) && strlen ( $_GET ['buy_signal_to'] ) > 0) {
				$this->buy_signal_to = $_GET ['buy_signal_to'];
			}
			if (isset ( $_GET ['buy_osci_from'] ) && strlen ( $_GET ['buy_osci_from'] ) > 0) {
				$this->buy_osci_from = $_GET ['buy_osci_from'];
			}
			if (isset ( $_GET ['buy_osci_to'] ) && strlen ( $_GET ['buy_osci_to'] ) > 0) {
				$this->buy_osci_to = $_GET ['buy_osci_to'];
			}
			if (isset ( $_GET ['buy_rsi_from'] ) && strlen ( $_GET ['buy_rsi_from'] ) > 0) {
				$this->buy_rsi_from = $_GET ['buy_rsi_from'];
			}
			if (isset ( $_GET ['buy_rsi_to'] ) && strlen ( $_GET ['buy_rsi_to'] ) > 0) {
				$this->buy_rsi_to = $_GET ['buy_rsi_to'];
			}
			if (isset ( $_GET ['buy_ema_kairiritsu_12_from'] ) && strlen ( $_GET ['buy_ema_kairiritsu_12_from'] ) > 0) {
				$this->buy_ema_kairiritsu_12_from = $_GET ['buy_ema_kairiritsu_12_from'];
			}
			if (isset ( $_GET ['buy_ema_kairiritsu_12_to'] ) && strlen ( $_GET ['buy_ema_kairiritsu_12_to'] ) > 0) {
				$this->buy_ema_kairiritsu_12_to = $_GET ['buy_ema_kairiritsu_12_to'];
			}
			if (isset ( $_GET ['buy_ema_kairiritsu_26_from'] ) && strlen ( $_GET ['buy_ema_kairiritsu_26_from'] ) > 0) {
				$this->buy_ema_kairiritsu_26_from = $_GET ['buy_ema_kairiritsu_26_from'];
			}
			if (isset ( $_GET ['buy_ema_kairiritsu_26_to'] ) && strlen ( $_GET ['buy_ema_kairiritsu_26_to'] ) > 0) {
				$this->buy_ema_kairiritsu_26_to = $_GET ['buy_ema_kairiritsu_26_to'];
			}
			if (isset ( $_GET ['buy_ema_12_from'] ) && strlen ( $_GET ['buy_ema_12_from'] ) > 0) {
				$this->buy_ema_12_from = $_GET ['buy_ema_12_from'];
			}
			if (isset ( $_GET ['buy_ema_12_to'] ) && strlen ( $_GET ['buy_ema_12_to'] ) > 0) {
				$this->buy_ema_12_to = $_GET ['buy_ema_12_to'];
			}
			if (isset ( $_GET ['buy_ema_26_from'] ) && strlen ( $_GET ['buy_ema_26_from'] ) > 0) {
				$this->buy_ema_26_from = $_GET ['buy_ema_26_from'];
			}
			if (isset ( $_GET ['buy_ema_26_to'] ) && strlen ( $_GET ['buy_ema_26_to'] ) > 0) {
				$this->buy_ema_26_to = $_GET ['buy_ema_26_to'];
			}
			if (isset ( $_GET ['sell_hajimene_from'] ) && strlen ( $_GET ['sell_hajimene_from'] ) > 0) {
				$this->sell_hajimene_from = $_GET ['sell_hajimene_from'];
			}
			if (isset ( $_GET ['sell_hajimene_to'] ) && strlen ( $_GET ['sell_hajimene_to'] ) > 0) {
				$this->sell_hajimene_to = $_GET ['sell_hajimene_to'];
			}
			if (isset ( $_GET ['sell_takane_from'] ) && strlen ( $_GET ['sell_takane_from'] ) > 0) {
				$this->sell_takane_from = $_GET ['sell_takane_from'];
			}
			if (isset ( $_GET ['sell_takane_to'] ) && strlen ( $_GET ['sell_takane_to'] ) > 0) {
				$this->sell_takane_to = $_GET ['sell_takane_to'];
			}
			if (isset ( $_GET ['sell_yasune_from'] ) && strlen ( $_GET ['sell_yasune_from'] ) > 0) {
				$this->sell_yasune_from = $_GET ['sell_yasune_from'];
			}
			if (isset ( $_GET ['sell_yasune_to'] ) && strlen ( $_GET ['sell_yasune_to'] ) > 0) {
				$this->sell_yasune_to = $_GET ['sell_yasune_to'];
			}
			if (isset ( $_GET ['sell_owarine_from'] ) && strlen ( $_GET ['sell_owarine_from'] ) > 0) {
				$this->sell_owarine_from = $_GET ['sell_owarine_from'];
			}
			if (isset ( $_GET ['sell_owarine_to'] ) && strlen ( $_GET ['sell_owarine_to'] ) > 0) {
				$this->sell_owarine_to = $_GET ['sell_owarine_to'];
			}
			if (isset ( $_GET ['sell_macd_from'] ) && strlen ( $_GET ['sell_macd_from'] ) > 0) {
				$this->sell_macd_from = $_GET ['sell_macd_from'];
			}
			if (isset ( $_GET ['sell_macd_to'] ) && strlen ( $_GET ['sell_macd_to'] ) > 0) {
				$this->sell_macd_to = $_GET ['sell_macd_to'];
			}
			if (isset ( $_GET ['sell_signal_from'] ) && strlen ( $_GET ['sell_signal_from'] ) > 0) {
				$this->sell_signal_from = $_GET ['sell_signal_from'];
			}
			if (isset ( $_GET ['sell_signal_to'] ) && strlen ( $_GET ['sell_signal_to'] ) > 0) {
				$this->sell_signal_to = $_GET ['sell_signal_to'];
			}
			if (isset ( $_GET ['sell_osci_from'] ) && strlen ( $_GET ['sell_osci_from'] ) > 0) {
				$this->sell_osci_from = $_GET ['sell_osci_from'];
			}
			if (isset ( $_GET ['sell_osci_to'] ) && strlen ( $_GET ['sell_osci_to'] ) > 0) {
				$this->sell_osci_to = $_GET ['sell_osci_to'];
			}
			if (isset ( $_GET ['sell_rsi_from'] ) && strlen ( $_GET ['sell_rsi_from'] ) > 0) {
				$this->sell_rsi_from = $_GET ['sell_rsi_from'];
			}
			if (isset ( $_GET ['sell_rsi_to'] ) && strlen ( $_GET ['sell_rsi_to'] ) > 0) {
				$this->sell_rsi_to = $_GET ['sell_rsi_to'];
			}
			if (isset ( $_GET ['sell_ema_kairiritsu_12_from'] ) && strlen ( $_GET ['sell_ema_kairiritsu_12_from'] ) > 0) {
				$this->sell_ema_kairiritsu_12_from = $_GET ['sell_ema_kairiritsu_12_from'];
			}
			if (isset ( $_GET ['sell_ema_kairiritsu_12_to'] ) && strlen ( $_GET ['sell_ema_kairiritsu_12_to'] ) > 0) {
				$this->sell_ema_kairiritsu_12_to = $_GET ['sell_ema_kairiritsu_12_to'];
			}
			if (isset ( $_GET ['sell_ema_kairiritsu_26_from'] ) && strlen ( $_GET ['sell_ema_kairiritsu_26_from'] ) > 0) {
				$this->sell_ema_kairiritsu_26_from = $_GET ['sell_ema_kairiritsu_26_from'];
			}
			if (isset ( $_GET ['sell_ema_kairiritsu_26_to'] ) && strlen ( $_GET ['sell_ema_kairiritsu_26_to'] ) > 0) {
				$this->sell_ema_kairiritsu_26_to = $_GET ['sell_ema_kairiritsu_26_to'];
			}
			if (isset ( $_GET ['sell_ema_12_from'] ) && strlen ( $_GET ['sell_ema_12_from'] ) > 0) {
				$this->sell_ema_12_from = $_GET ['sell_ema_12_from'];
			}
			if (isset ( $_GET ['sell_ema_12_to'] ) && strlen ( $_GET ['sell_ema_12_to'] ) > 0) {
				$this->sell_ema_12_to = $_GET ['sell_ema_12_to'];
			}
			if (isset ( $_GET ['sell_ema_26_from'] ) && strlen ( $_GET ['sell_ema_26_from'] ) > 0) {
				$this->sell_ema_26_from = $_GET ['sell_ema_26_from'];
			}
			if (isset ( $_GET ['sell_ema_26_to'] ) && strlen ( $_GET ['sell_ema_26_to'] ) > 0) {
				$this->sell_ema_26_to = $_GET ['sell_ema_26_to'];
			}
			if (isset ( $_GET ['songiriritsu'] ) && strlen ( $_GET ['songiriritsu'] ) > 0) {
				$this->songiriritsu = $_GET ['songiriritsu'];
			}
			if (isset ( $_GET ['execute'] ) && strlen ( $_GET ['execute'] ) > 0) {
				$this->execute = $_GET ['execute'];
			}
		}
	}
	public function createWhereCommon() {
		$sql = "";
		if (isset ( $this->shoken_code )) {
			$sql .= " AND shoken_code = :shoken_code ";
		}
		if (isset ( $this->torihiki_date_from )) {
			$sql .= " AND torihiki_date >= :torihiki_date_from ";
		}
		if (isset ( $this->torihiki_date_to )) {
			$sql .= " AND torihiki_date <= :torihiki_date_to ";
		}
		if (isset ( $this->torihiki_time_from )) {
			$sql .= " AND torihiki_time >= :torihiki_time_from ";
		}
		if (isset ( $this->torihiki_time_to )) {
			$sql .= " AND torihiki_time <= :torihiki_time_to ";
		}
		return $sql;
	}
	public function createWhereBuy() {
		$sql = "";
		if (isset ( $this->buy_hajimene_from )) {
			$sql .= " AND hajimene >= :buy_hajimene_from ";
		}
		if (isset ( $this->buy_hajimene_to )) {
			$sql .= " AND hajimene <= :buy_hajimene_to ";
		}
		if (isset ( $this->buy_takane_from )) {
			$sql .= " AND takane >= :buy_takane_from ";
		}
		if (isset ( $this->buy_takane_to )) {
			$sql .= " AND takane <= :buy_takane_to ";
		}
		if (isset ( $this->buy_yasune_from )) {
			$sql .= " AND yasune >= :buy_yasune_from ";
		}
		if (isset ( $this->buy_yasune_to )) {
			$sql .= " AND yasune <= :buy_yasune_to ";
		}
		if (isset ( $this->buy_owarine_from )) {
			$sql .= " AND owarine >= :buy_owarine_from ";
		}
		if (isset ( $this->buy_owarine_to )) {
			$sql .= " AND owarine <= :buy_owarine_to ";
		}
		if (isset ( $this->buy_macd_from )) {
			$sql .= " AND macd >= :buy_macd_from ";
		}
		if (isset ( $this->buy_macd_to )) {
			$sql .= " AND macd <= :buy_macd_to ";
		}
		if (isset ( $this->buy_signal_from )) {
			$sql .= " AND signal >= :buy_signal_from ";
		}
		if (isset ( $this->buy_signal_to )) {
			$sql .= " AND signal <= :buy_signal_to ";
		}
		if (isset ( $this->buy_osci_from )) {
			$sql .= " AND osci >= :buy_osci_from ";
		}
		if (isset ( $this->buy_osci_to )) {
			$sql .= " AND osci <= :buy_osci_to ";
		}
		if (isset ( $this->buy_rsi_from )) {
			$sql .= " AND rsi >= :buy_rsi_from ";
		}
		if (isset ( $this->buy_rsi_to )) {
			$sql .= " AND rsi <= :buy_rsi_to ";
		}
		if (isset ( $this->buy_ema_kairiritsu_12_from )) {
			$sql .= " AND ema_kairiritsu_12 >= :buy_ema_kairiritsu_12_from ";
		}
		if (isset ( $this->buy_ema_kairiritsu_12_to )) {
			$sql .= " AND ema_kairiritsu_12 <= :buy_ema_kairiritsu_12_to ";
		}
		if (isset ( $this->buy_ema_kairiritsu_26_from )) {
			$sql .= " AND ema_kairiritsu_26 >= :buy_ema_kairiritsu_26_from ";
		}
		if (isset ( $this->buy_ema_kairiritsu_26_to )) {
			$sql .= " AND ema_kairiritsu_26 <= :buy_ema_kairiritsu_26_to ";
		}
		if (isset ( $this->buy_ema_12_from )) {
			$sql .= " AND ema_12 >= :buy_ema_12_from ";
		}
		if (isset ( $this->buy_ema_12_to )) {
			$sql .= " AND ema_12 <= :buy_ema_12_to ";
		}
		if (isset ( $this->buy_ema_26_from )) {
			$sql .= " AND ema_26 >= :buy_ema_26_from ";
		}
		if (isset ( $this->buy_ema_26_to )) {
			$sql .= " AND ema_26 <= :buy_ema_26_to ";
		}
		if (! empty ( $sql )) {
			$sql = " 1=1 " . $sql;
		} else {
			$sql = " 1!=1 ";
		}
		return $sql;
	}
	public function createWhereSell() {
		$sql = "";
		if (isset ( $this->sell_hajimene_from )) {
			$sql .= " AND hajimene >= :sell_hajimene_from ";
		}
		if (isset ( $this->sell_hajimene_to )) {
			$sql .= " AND hajimene <= :sell_hajimene_to ";
		}
		if (isset ( $this->sell_takane_from )) {
			$sql .= " AND takane >= :sell_takane_from ";
		}
		if (isset ( $this->sell_takane_to )) {
			$sql .= " AND takane <= :sell_takane_to ";
		}
		if (isset ( $this->sell_yasune_from )) {
			$sql .= " AND yasune >= :sell_yasune_from ";
		}
		if (isset ( $this->sell_yasune_to )) {
			$sql .= " AND yasune <= :sell_yasune_to ";
		}
		if (isset ( $this->sell_owarine_from )) {
			$sql .= " AND owarine >= :sell_owarine_from ";
		}
		if (isset ( $this->sell_owarine_to )) {
			$sql .= " AND owarine <= :sell_owarine_to ";
		}
		if (isset ( $this->sell_macd_from )) {
			$sql .= " AND macd >= :sell_macd_from ";
		}
		if (isset ( $this->sell_macd_to )) {
			$sql .= " AND macd <= :sell_macd_to ";
		}
		if (isset ( $this->sell_signal_from )) {
			$sql .= " AND signal >= :sell_signal_from ";
		}
		if (isset ( $this->sell_signal_to )) {
			$sql .= " AND signal <= :sell_signal_to ";
		}
		if (isset ( $this->sell_osci_from )) {
			$sql .= " AND osci >= :sell_osci_from ";
		}
		if (isset ( $this->sell_osci_to )) {
			$sql .= " AND osci <= :sell_osci_to ";
		}
		if (isset ( $this->sell_rsi_from )) {
			$sql .= " AND rsi >= :sell_rsi_from ";
		}
		if (isset ( $this->sell_rsi_to )) {
			$sql .= " AND rsi <= :sell_rsi_to ";
		}
		if (isset ( $this->sell_ema_kairiritsu_12_from )) {
			$sql .= " AND ema_kairiritsu_12 >= :sell_ema_kairiritsu_12_from ";
		}
		if (isset ( $this->sell_ema_kairiritsu_12_to )) {
			$sql .= " AND ema_kairiritsu_12 <= :sell_ema_kairiritsu_12_to ";
		}
		if (isset ( $this->sell_ema_kairiritsu_26_from )) {
			$sql .= " AND ema_kairiritsu_26 >= :sell_ema_kairiritsu_26_from ";
		}
		if (isset ( $this->sell_ema_kairiritsu_26_to )) {
			$sql .= " AND ema_kairiritsu_26 <= :sell_ema_kairiritsu_26_to ";
		}
		if (isset ( $this->sell_ema_12_from )) {
			$sql .= " AND ema_12 >= :sell_ema_12_from ";
		}
		if (isset ( $this->sell_ema_12_to )) {
			$sql .= " AND ema_12 <= :sell_ema_12_to ";
		}
		if (isset ( $this->sell_ema_26_from )) {
			$sql .= " AND ema_26 >= :sell_ema_26_from ";
		}
		if (isset ( $this->sell_ema_26_to )) {
			$sql .= " AND ema_26 <= :sell_ema_26_to ";
		}
		if (! empty ( $sql )) {
			$sql = " 1=1 " . $sql;
		} else {
			$sql = " 1!=1 ";
		}
		return $sql;
	}
	public function setBindParam(PDOStatement $stmt) {
		if (isset ( $this->shoken_code )) {
			$stmt->bindParam ( ':shoken_code', $this->shoken_code );
		}
		if (isset ( $this->torihiki_date_from )) {
			$stmt->bindParam ( ':torihiki_date_from', $this->torihiki_date_from );
		}
		if (isset ( $this->torihiki_date_to )) {
			$stmt->bindParam ( ':torihiki_date_to', $this->torihiki_date_to );
		}
		if (isset ( $this->torihiki_time_from )) {
			$stmt->bindParam ( ':torihiki_time_from', $this->torihiki_time_from );
		}
		if (isset ( $this->torihiki_time_to )) {
			$stmt->bindParam ( ':torihiki_time_to', $this->torihiki_time_to );
		}
		if (isset ( $this->buy_hajimene_from )) {
			$stmt->bindParam ( ':buy_hajimene_from', $this->buy_hajimene_from );
		}
		if (isset ( $this->buy_hajimene_to )) {
			$stmt->bindParam ( ':buy_hajimene_to', $this->buy_hajimene_to );
		}
		if (isset ( $this->buy_takane_from )) {
			$stmt->bindParam ( ':buy_takane_from', $this->buy_takane_from );
		}
		if (isset ( $this->buy_takane_to )) {
			$stmt->bindParam ( ':buy_takane_to', $this->buy_takane_to );
		}
		if (isset ( $this->buy_yasune_from )) {
			$stmt->bindParam ( ':buy_yasune_from', $this->buy_yasune_from );
		}
		if (isset ( $this->buy_yasune_to )) {
			$stmt->bindParam ( ':buy_yasune_to', $this->buy_yasune_to );
		}
		if (isset ( $this->buy_owarine_from )) {
			$stmt->bindParam ( ':buy_owarine_from', $this->buy_owarine_from );
		}
		if (isset ( $this->buy_owarine_to )) {
			$stmt->bindParam ( ':buy_owarine_to', $this->buy_owarine_to );
		}
		if (isset ( $this->buy_macd_from )) {
			$stmt->bindParam ( ':buy_macd_from', $this->buy_macd_from );
		}
		if (isset ( $this->buy_macd_to )) {
			$stmt->bindParam ( ':buy_macd_to', $this->buy_macd_to );
		}
		if (isset ( $this->buy_signal_from )) {
			$stmt->bindParam ( ':buy_signal_from', $this->buy_signal_from );
		}
		if (isset ( $this->buy_signal_to )) {
			$stmt->bindParam ( ':buy_signal_to', $this->buy_signal_to );
		}
		if (isset ( $this->buy_osci_from )) {
			$stmt->bindParam ( ':buy_osci_from', $this->buy_osci_from );
		}
		if (isset ( $this->buy_osci_to )) {
			$stmt->bindParam ( ':buy_osci_to', $this->buy_osci_to );
		}
		if (isset ( $this->buy_rsi_from )) {
			$stmt->bindParam ( ':buy_rsi_from', $this->buy_rsi_from );
		}
		if (isset ( $this->buy_rsi_to )) {
			$stmt->bindParam ( ':buy_rsi_to', $this->buy_rsi_to );
		}
		if (isset ( $this->buy_ema_kairiritsu_12_from )) {
			$stmt->bindParam ( ':buy_ema_kairiritsu_12_from', $this->buy_ema_kairiritsu_12_from );
		}
		if (isset ( $this->buy_ema_kairiritsu_12_to )) {
			$stmt->bindParam ( ':buy_ema_kairiritsu_12_to', $this->buy_ema_kairiritsu_12_to );
		}
		if (isset ( $this->buy_ema_kairiritsu_26_from )) {
			$stmt->bindParam ( ':buy_ema_kairiritsu_26_from', $this->buy_ema_kairiritsu_26_from );
		}
		if (isset ( $this->buy_ema_kairiritsu_26_to )) {
			$stmt->bindParam ( ':buy_ema_kairiritsu_26_to', $this->buy_ema_kairiritsu_26_to );
		}
		if (isset ( $this->buy_ema_12_from )) {
			$stmt->bindParam ( ':buy_ema_12_from', $this->buy_ema_12_from );
		}
		if (isset ( $this->buy_ema_12_to )) {
			$stmt->bindParam ( ':buy_ema_12_to', $this->buy_ema_12_to );
		}
		if (isset ( $this->buy_ema_26_from )) {
			$stmt->bindParam ( ':buy_ema_26_from', $this->buy_ema_26_from );
		}
		if (isset ( $this->buy_ema_26_to )) {
			$stmt->bindParam ( ':buy_ema_26_to', $this->buy_ema_26_to );
		}
		if (isset ( $this->sell_hajimene_from )) {
			$stmt->bindParam ( ':sell_hajimene_from', $this->sell_hajimene_from );
		}
		if (isset ( $this->sell_hajimene_to )) {
			$stmt->bindParam ( ':sell_hajimene_to', $this->sell_hajimene_to );
		}
		if (isset ( $this->sell_takane_from )) {
			$stmt->bindParam ( ':sell_takane_from', $this->sell_takane_from );
		}
		if (isset ( $this->sell_takane_to )) {
			$stmt->bindParam ( ':sell_takane_to', $this->sell_takane_to );
		}
		if (isset ( $this->sell_yasune_from )) {
			$stmt->bindParam ( ':sell_yasune_from', $this->sell_yasune_from );
		}
		if (isset ( $this->sell_yasune_to )) {
			$stmt->bindParam ( ':sell_yasune_to', $this->sell_yasune_to );
		}
		if (isset ( $this->sell_owarine_from )) {
			$stmt->bindParam ( ':sell_owarine_from', $this->sell_owarine_from );
		}
		if (isset ( $this->sell_owarine_to )) {
			$stmt->bindParam ( ':sell_owarine_to', $this->sell_owarine_to );
		}
		if (isset ( $this->sell_macd_from )) {
			$stmt->bindParam ( ':sell_macd_from', $this->sell_macd_from );
		}
		if (isset ( $this->sell_macd_to )) {
			$stmt->bindParam ( ':sell_macd_to', $this->sell_macd_to );
		}
		if (isset ( $this->sell_signal_from )) {
			$stmt->bindParam ( ':sell_signal_from', $this->sell_signal_from );
		}
		if (isset ( $this->sell_signal_to )) {
			$stmt->bindParam ( ':sell_signal_to', $this->sell_signal_to );
		}
		if (isset ( $this->sell_osci_from )) {
			$stmt->bindParam ( ':sell_osci_from', $this->sell_osci_from );
		}
		if (isset ( $this->sell_osci_to )) {
			$stmt->bindParam ( ':sell_osci_to', $this->sell_osci_to );
		}
		if (isset ( $this->sell_rsi_from )) {
			$stmt->bindParam ( ':sell_rsi_from', $this->sell_rsi_from );
		}
		if (isset ( $this->sell_rsi_to )) {
			$stmt->bindParam ( ':sell_rsi_to', $this->sell_rsi_to );
		}
		if (isset ( $this->sell_ema_kairiritsu_12_from )) {
			$stmt->bindParam ( ':sell_ema_kairiritsu_12_from', $this->sell_ema_kairiritsu_12_from );
		}
		if (isset ( $this->sell_ema_kairiritsu_12_to )) {
			$stmt->bindParam ( ':sell_ema_kairiritsu_12_to', $this->sell_ema_kairiritsu_12_to );
		}
		if (isset ( $this->sell_ema_kairiritsu_26_from )) {
			$stmt->bindParam ( ':sell_ema_kairiritsu_26_from', $this->sell_ema_kairiritsu_26_from );
		}
		if (isset ( $this->sell_ema_kairiritsu_26_to )) {
			$stmt->bindParam ( ':sell_ema_kairiritsu_26_to', $this->sell_ema_kairiritsu_26_to );
		}
		if (isset ( $this->sell_ema_12_from )) {
			$stmt->bindParam ( ':sell_ema_12_from', $this->sell_ema_12_from );
		}
		if (isset ( $this->sell_ema_12_to )) {
			$stmt->bindParam ( ':sell_ema_12_to', $this->sell_ema_12_to );
		}
		if (isset ( $this->sell_ema_26_from )) {
			$stmt->bindParam ( ':sell_ema_26_from', $this->sell_ema_26_from );
		}
		if (isset ( $this->sell_ema_26_to )) {
			$stmt->bindParam ( ':sell_ema_26_to', $this->sell_ema_26_to );
		}
	}
}