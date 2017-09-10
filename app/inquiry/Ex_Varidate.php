<?php



class Ex_Varidate {


	//存在チェック
	function empty_check($str, $chk='') {
		$str = mb_convert_kana($str, 's', ENCODE_CHARSET);
		$str = str_replace(' ', '', $str );
		$str = preg_replace("/(\r)+/", '', $str );
		$str = preg_replace("/(\n)+/", '', $str );
		if( mb_strlen($str, ENCODE_CHARSET) == 0 ) {
			return false;
		}
		return true;
	}


	//固定値チェック value
	function Vpaturn_check($str, $chk) {
		$str = mb_convert_kana($str, 's', ENCODE_CHARSET);
		if( in_array($str, $chk) ) {
			return true;
		}
		return false;
	}
	

	//固定値チェック key
	function Kpaturn_check($str, $chk) {
		$str = mb_convert_kana($str, 's', ENCODE_CHARSET);
		if( isset($chk[$str]) ) {
			return true;
		}
		return false;
	}


	//最大文字数
	function maxlen_check($str, $len=0) {
//		$str = preg_replace("/(\r)+/", '', $str );
//		$str = preg_replace("/(\n)+/", '', $str );
		if( $len < mb_strlen($str, ENCODE_CHARSET) ) {
			return false;
		}
		return true;
	}


	//数値チェック
	function num_check($str, $chk='') {
		if( $this->empty_check($str) ) {
			return is_numeric($str);
		}
		return true;
	}


	//カタカナチェック
	//全て全角、カタカナ、数字、「’」（アポストロフィー）「，」（コンマ）「－」（ハイフン）「．」（ピリオド）「・」（中点）
	function kana_check($str, $chk='') {

		$str = mb_convert_encoding($str, 'SJIS-win', INTER_CHARSET );

		$rst = true;
		for ($i = 0; $i < mb_strlen($str, 'SJIS-win'); $i++) {
			//echo mb_substr($str, $i, 1, 'SJIS-win');
			$c = hexdec(bin2hex(mb_substr($str, $i, 1, 'SJIS-win')));
			if (($c >= hexdec('8340') and $c <= hexdec('837e') )
			||  ($c >= hexdec('8380') and $c <= hexdec('8396') )
			||  ($c == hexdec('815b') )
			||  ($c == hexdec('8195') )
			||  ($c == hexdec('8166') )
			||  ($c == hexdec('8143') )
			||  ($c == hexdec('817c') )
			||  ($c == hexdec('8144') )
			||  ($c == hexdec('8145') )
			||  ($c >= hexdec('824f') and $c <= hexdec('8258') )) {
				continue;
			}else{
				$rst = false;
			}
		}

		return $rst;

	}


	//メール型チェック
	function mail_check($str, $chk='') {
		return preg_match("/^[\.a-z0-9!#$%&\'*+\/=?^_`{|}~-]+@(?:[a-z0-9][-a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,4})$/i", $str);
	}


	//比較チェック(同じ)
	function equal_check($str, $chk) {
		if ( $str == $chk ) {
			return true;
		}else{
			return false;
		}
	}


	//機種依存文字
	function hex_check($str, $chk='') {

		$str = mb_convert_encoding($str, 'SJIS-win', INTER_CHARSET );

		//実体文字チェック
		if( preg_match("/(&#)([0-9]+)(;)/",$str) ) {
			return false;
		}

		for ($i = 0; $i < mb_strlen($str, 'SJIS-win'); $i++) {
			//echo mb_substr($str, $i, 1, 'SJIS-win');
			$c = hexdec(bin2hex(mb_substr($str, $i, 1, 'SJIS-win')));
			//echo $c;
			if ($c >= hexdec("8540") and $c <= hexdec("86fc") ) {
				//echo '/* MAC1 */';
				//echo $c.':'.mb_substr($str, $i, 1, 'SJIS-win');
				return false;
			} else if ($c >= hexdec("87a0") and $c <= hexdec("889e") ) {
				//echo '/* MAC 2*/';
				//echo $c.':'.mb_substr($str, $i, 1, 'SJIS-win');
				return false;
			} else if ($c >= hexdec("8740") and $c <= hexdec("879f") ) {
				//echo '/* 13区 */';
				//echo $c.':'.mb_substr($str, $i, 1, 'SJIS-win');
				return false;
			} else if ($c >= hexdec("ed40") and $c <= hexdec("eefc") ) {
				//echo '/* NEC選定IBM拡張文字 */';
				//echo $c.':'.mb_substr($str, $i, 1, 'SJIS-win');
				return false;
			} else if ($c >= hexdec("fa40") and $c <= hexdec("fc4b") ) {
				//echo '/* IBM拡張文字 */';
				//echo $c.':'.mb_substr($str, $i, 1, 'SJIS-win');
				return false;
			} else if ($c >= hexdec("f040") and $c <= hexdec("f9fc") ) {
				//echo '/* 外字 */';
				//echo $c.':'.mb_substr($str, $i, 1, 'SJIS-win');
				return false;
			} else if ($c >= hexdec("a0") and $c <= hexdec("df") ){
				//echo '/* 半角カナ */';
				//echo $c.':'.mb_substr($str, $i, 1, 'SJIS-win');
				return false;
			}
		}
		return true;
	}

}

?>
