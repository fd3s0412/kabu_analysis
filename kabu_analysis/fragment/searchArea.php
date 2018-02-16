			<!-- ------------------------------------------------------------ -->
			<!-- 基本情報 -->
			<!-- ------------------------------------------------------------ -->
			<dl>
				<dt>
					証券コード
					<i id="search_field_close" class="fa fa-caret-square-o-up fa-2"
						aria-hidden="true"></i>
					<i id="search_field_open" class="fa fa-caret-square-o-down fa-2"
						aria-hidden="true"></i>
				</dt>
				<dd>
					<div class="table">
						<div class="cell">
							<input type="text" name="shoken_code"
								value="<?php echo $form->shoken_code; ?>" />
						</div>
						<div class="cell align_right">
							<a href="#" class="btn_base btn_mini btn_search ">検 索</a>
						</div>
					</div>
				</dd>
			</dl>
			<div id="search_field">
				<?php if (isset ( $meigara )) { ?>
				<dl>
					<dt>銘柄名</dt>
					<dd><?php echo $meigara['meigaramei']; ?></dd>
				</dl>
				<dl>
					<dt>市場・商品区分</dt>
					<dd><?php echo $meigara['shijo_shohin_kubun']; ?></dd>
				</dl>
				<dl>
					<dt>33業種区分</dt>
					<dd><?php echo $meigara['gyoshu_kubun_a']; ?></dd>
				</dl>
				<dl>
					<dt>17業種区分</dt>
					<dd><?php echo $meigara['gyoshu_kubun_b']; ?></dd>
				</dl>
				<dl>
					<dt>規模区分</dt>
					<dd><?php echo $meigara['kibo_kubun']; ?></dd>
				</dl>
				<?php } ?>
			</div>
			<!-- ------------------------------------------------------------ -->
			<!-- 期間 -->
			<!-- ------------------------------------------------------------ -->
			<h2>
				期間
				<i id="kikan_field_close" class="fa fa-caret-square-o-up fa-2"
					aria-hidden="true"></i>
				<i id="kikan_field_open" class="fa fa-caret-square-o-down fa-2"
					aria-hidden="true"></i>
			</h2>
			<div id="kikan_field">
				<dl>
					<dt>日付</dt>
					<dd>
						<input type="number" name="torihiki_date_from"
							value="<?php echo $form->torihiki_date_from; ?>" />
						～
						<input type="number" name="torihiki_date_to"
							value="<?php echo $form->torihiki_date_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>時刻</dt>
					<dd>
						<input type="number" name="torihiki_time_from"
							value="<?php echo $form->torihiki_time_from; ?>" />
						～
						<input type="number" name="torihiki_time_to"
							value="<?php echo $form->torihiki_time_to; ?>" />
					</dd>
				</dl>
			</div>
			<!-- ------------------------------------------------------------ -->
			<!-- 買い -->
			<!-- ------------------------------------------------------------ -->
			<h2>
				買条件
				<i id="buy_field_close" class="fa fa-caret-square-o-up fa-2"
					aria-hidden="true"></i>
				<i id="buy_field_open" class="fa fa-caret-square-o-down fa-2"
					aria-hidden="true"></i>
			</h2>
			<div id="buy_field">
				<dl>
					<dt>始値</dt>
					<dd>
						<input type="number" name="buy_hajimene_from"
							value="<?php echo $form->buy_hajimene_from; ?>" />
						～
						<input type="number" name="buy_hajimene_to"
							value="<?php echo $form->buy_hajimene_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>高値</dt>
					<dd>
						<input type="number" name="buy_takane_from"
							value="<?php echo $form->buy_takane_from; ?>" />
						～
						<input type="number" name="buy_takane_to"
							value="<?php echo $form->buy_takane_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>安値</dt>
					<dd>
						<input type="number" name="buy_yasune_from"
							value="<?php echo $form->buy_yasune_from; ?>" />
						～
						<input type="number" name="buy_yasune_to"
							value="<?php echo $form->buy_yasune_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>終値</dt>
					<dd>
						<input type="number" name="buy_owarine_from"
							value="<?php echo $form->buy_owarine_from; ?>" />
						～
						<input type="number" name="buy_owarine_to"
							value="<?php echo $form->buy_owarine_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>MACD</dt>
					<dd>
						<input type="number" name="buy_macd_from"
							value="<?php echo $form->buy_macd_from; ?>" />
						～
						<input type="number" name="buy_macd_to"
							value="<?php echo $form->buy_macd_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>シグナル</dt>
					<dd>
						<input type="number" name="buy_signal_from"
							value="<?php echo $form->buy_signal_from; ?>" />
						～
						<input type="number" name="buy_signal_to"
							value="<?php echo $form->buy_signal_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>OSCI</dt>
					<dd>
						<input type="number" name="buy_osci_from"
							value="<?php echo $form->buy_osci_from; ?>" />
						～
						<input type="number" name="buy_osci_to"
							value="<?php echo $form->buy_osci_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>RSI</dt>
					<dd>
						<input type="number" name="buy_rsi_from"
							value="<?php echo $form->buy_rsi_from; ?>" />
						～
						<input type="number" name="buy_rsi_to"
							value="<?php echo $form->buy_rsi_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>EMA期乖離率(12)</dt>
					<dd>
						<input type="number" name="buy_ema_kairiritsu_12_from"
							value="<?php echo $form->buy_ema_kairiritsu_12_from; ?>" />
						～
						<input type="number" name="buy_ema_kairiritsu_12_to"
							value="<?php echo $form->buy_ema_kairiritsu_12_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>ENA乖離率(26)</dt>
					<dd>
						<input type="number" name="buy_ema_kairiritsu_26_from"
							value="<?php echo $form->buy_ema_kairiritsu_26_from; ?>" />
						～
						<input type="number" name="buy_ema_kairiritsu_26_to"
							value="<?php echo $form->buy_ema_kairiritsu_26_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>EMA(12)</dt>
					<dd>
						<input type="number" name="buy_ema_12_from"
							value="<?php echo $form->buy_ema_12_from; ?>" />
						～
						<input type="number" name="buy_ema_12_to"
							value="<?php echo $form->buy_ema_12_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>ENA(26)</dt>
					<dd>
						<input type="number" name="buy_ema_26_from"
							value="<?php echo $form->buy_ema_26_from; ?>" />
						～
						<input type="number" name="buy_ema_26_to"
							value="<?php echo $form->buy_ema_26_to; ?>" />
					</dd>
				</dl>
			</div>
			<!-- ------------------------------------------------------------ -->
			<!-- 売り -->
			<!-- ------------------------------------------------------------ -->
			<h2>
				売条件
				<i id="sell_field_close" class="fa fa-caret-square-o-up fa-2"
					aria-hidden="true"></i>
				<i id="sell_field_open" class="fa fa-caret-square-o-down fa-2"
					aria-hidden="true"></i>
			</h2>
			<div id="sell_field">
				<dl>
					<dt>始値</dt>
					<dd>
						<input type="number" name="sell_hajimene_from"
							value="<?php echo $form->sell_hajimene_from; ?>" />
						～
						<input type="number" name="sell_hajimene_to"
							value="<?php echo $form->sell_hajimene_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>高値</dt>
					<dd>
						<input type="number" name="sell_takane_from"
							value="<?php echo $form->sell_takane_from; ?>" />
						～
						<input type="number" name="sell_takane_to"
							value="<?php echo $form->sell_takane_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>安値</dt>
					<dd>
						<input type="number" name="sell_yasune_from"
							value="<?php echo $form->sell_yasune_from; ?>" />
						～
						<input type="number" name="sell_yasune_to"
							value="<?php echo $form->sell_yasune_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>終値</dt>
					<dd>
						<input type="number" name="sell_owarine_from"
							value="<?php echo $form->sell_owarine_from; ?>" />
						～
						<input type="number" name="sell_owarine_to"
							value="<?php echo $form->sell_owarine_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>MACD</dt>
					<dd>
						<input type="number" name="sell_macd_from"
							value="<?php echo $form->sell_macd_from; ?>" />
						～
						<input type="number" name="sell_macd_to"
							value="<?php echo $form->sell_macd_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>シグナル</dt>
					<dd>
						<input type="number" name="sell_signal_from"
							value="<?php echo $form->sell_signal_from; ?>" />
						～
						<input type="number" name="sell_signal_to"
							value="<?php echo $form->sell_signal_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>OSCI</dt>
					<dd>
						<input type="number" name="sell_osci_from"
							value="<?php echo $form->sell_osci_from; ?>" />
						～
						<input type="number" name="sell_osci_to"
							value="<?php echo $form->sell_osci_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>RSI</dt>
					<dd>
						<input type="number" name="sell_rsi_from"
							value="<?php echo $form->sell_rsi_from; ?>" />
						～
						<input type="number" name="sell_rsi_to"
							value="<?php echo $form->sell_rsi_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>EMA期乖離率(12)</dt>
					<dd>
						<input type="number" name="sell_ema_kairiritsu_12_from"
							value="<?php echo $form->sell_ema_kairiritsu_12_from; ?>" />
						～
						<input type="number" name="sell_ema_kairiritsu_12_to"
							value="<?php echo $form->sell_ema_kairiritsu_12_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>ENA乖離率(26)</dt>
					<dd>
						<input type="number" name="sell_ema_kairiritsu_26_from"
							value="<?php echo $form->sell_ema_kairiritsu_26_from; ?>" />
						～
						<input type="number" name="sell_ema_kairiritsu_26_to"
							value="<?php echo $form->sell_ema_kairiritsu_26_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>EMA(12)</dt>
					<dd>
						<input type="number" name="sell_ema_12_from"
							value="<?php echo $form->sell_ema_12_from; ?>" />
						～
						<input type="number" name="sell_ema_12_to"
							value="<?php echo $form->sell_ema_12_to; ?>" />
					</dd>
				</dl>
				<dl>
					<dt>ENA(26)</dt>
					<dd>
						<input type="number" name="sell_ema_26_from"
							value="<?php echo $form->sell_ema_26_from; ?>" />
						～
						<input type="number" name="sell_ema_26_to"
							value="<?php echo $form->sell_ema_26_to; ?>" />
					</dd>
				</dl>
			</div>
			<!-- ------------------------------------------------------------ -->
			<!-- 損切 -->
			<!-- ------------------------------------------------------------ -->
			<h2>
				損切条件
				<i id="songiri_field_close" class="fa fa-caret-square-o-up fa-2"
					aria-hidden="true"></i>
				<i id="songiri_field_open" class="fa fa-caret-square-o-down fa-2"
					aria-hidden="true"></i>
			</h2>
			<div id="songiri_field">
				<dl>
					<dt>損切率</dt>
					<dd>
						<input type="number" name="songiriritsu"
							value="<?php echo $form->songiriritsu; ?>" />
					</dd>
				</dl>
			</div>
