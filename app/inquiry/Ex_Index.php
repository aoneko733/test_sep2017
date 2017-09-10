<?php

if( HTML_TYPE == 'en' ) {
	define("DEFN_CLASS", CLASS_DIR.'/Ex_EgDefine.php');
}else{
	define("DEFN_CLASS", CLASS_DIR.'/Ex_Define.php');
}
define("VALD_CLASS", CLASS_DIR.'/Ex_Varidate.php');
require_once DEFN_CLASS;
require_once VALD_CLASS;


class Ex_Index {

	var $func;
	var $defn;
	var $vald;

	var $pram;
	var $err_flg;
	var $err_pram;
	var $error;
	var $tmpl;
	var $layout;
	var $english;

	/* コンストラクタ */
	function Ex_Index() {
		$this->defn = new Ex_Define();
		$this->vald = new Ex_Varidate();

		$this->pram = $this->defn->get_postpram();
		if( !empty($_POST) ) {
			$this->pram = array_merge($this->defn->get_postpram(), $_POST);
		}
		
		//強制変換処理
		$this->must_change();
		
		$this->layout = 'index.tpl';
		$this->tmpl   = 'index.tpl';
		
		//レイアウトリスト
		if( $this->layout == '' || !file_exists(LAYOUT_PATH.$this->layout) ) {
		    //$this->layout = 'error.tpl';
                    exit;
		}

	}


	function process() {
		$cmd = (isset($this->pram['cmd']))? $this->pram['cmd']: '';
		switch ( $cmd ) {
			case 'inpt':
				//バリデート
				if( $this->varidate() ) {
					$this->tmpl = 'confirm.tpl';
				}else{
					//エラーの時
					//カタカナフィールドは元(入力状態)に戻す
				}
				if (isset($_SESSION['input'])) {
					unset($_SESSION['input']);
				}
				$_SESSION['input'] = 1;
				break;
			case 'comp':
				if( isset($this->pram['comp']) ) {

					if (!isset($_SESSION['input'])) {
						//リダイレクト
						header("Location: ./index.php");
						exit;
					}else{
						//バリデート
						if( $this->varidate() ) {
							$this->tmpl = 'thanks.tpl';
							//メール送信処理
							if( HTML_TYPE == 'en' ) {
								//$this->e_send_mail();
							}else{
								$this->send_mail();
							}
							unset($_SESSION['input']);
						}else{
							//エラーの時
							//カタカナフィールドは元(入力状態)に戻す
						}
					}
				}
				break;
			default;
				break;
		}
		require_once LAYOUT_PATH.$this->layout;
	}


	function varidate() {
		//チェック項目の取得
		$valid = $this->defn->get_valid($this->pram);
		//エラーメッセージの取得
		$errmsg = $this->defn->get_errmsg();

		//複合チェック文字列作成
//		$this->pram['name'] = $this->pram['name1'] . $this->pram['name2'];

		foreach( $valid as $key => $val) {
			foreach( $val as $fckey ) {
				if( is_array($fckey) ) {
					list($fnc) = array_keys($fckey);
					$fcpram = $fckey[$fnc];
				} else {
					$fnc = $fckey;
					$fcpram = '';
				}
				$fncname = $fnc . '_check';
				$post = (isset($this->pram[$key])) ? $this->pram[$key]: '';

				if( !$this->vald->$fncname($post, $fcpram) ) {
					$this->err_pram[$key][$fnc] = $errmsg[$key][$fnc];
				}
			}
		}

		if( !empty($this->err_pram) ) {
			foreach( $this->err_pram as $value ) {
				if( $value ) return false;
			}
		}

		return true;
	}


	function send_mail() {
		//メールタイトル
		$admin_mail = ADMIN_MAIL;
		$mailstr['admin']['subject'] = "【サイトからのお問合せ】";
		$mailstr['custm']['subject'] = "【中道行政書士事務所】お問合せの確認";

		//メール本文読込み
		require_once TMP_PATH.'/'.'admin_mail.tpl';
		require_once TMP_PATH.'/'.'custm_mail.tpl';

		$admin = $this->body_create($admin);

		$mailstr['admin']['body']=$admin;
		$mailstr['custm']['body']=$custm;
		
		mb_language("ja");
		mb_internal_encoding("UTF-8");
		
		//return-path
		$parameter = '-f ' . $admin_mail;
		
		//送信元アドレス
		$mailstr['admin']['from'] = $admin_mail;
		$mailstr['custm']['from'] = $admin_mail;

		//送信先アドレス
		$mailstr['admin']['to'] = $admin_mail;
		$mailstr['custm']['to'] = $this->pram['mail'];


		//とりあえずmb_send_mail
		//送信１admin
		$rst=mb_send_mail($mailstr['admin']['to'] , $mailstr['admin']['subject'], $mailstr['admin']['body'], "From: ".$mailstr['admin']['from'], $parameter );

		//送信２customer
		$rst=mb_send_mail($mailstr['custm']['to'] , $mailstr['custm']['subject'], $mailstr['custm']['body'], "From: ".mb_encode_mimeheader("中道行政書士事務所")."<".$mailstr['custm']['from'].">", $parameter );


	}

	function body_create($body) {
		// 改行(一行)ごとにデータを取得する
		$line = mb_split("\n", $body);
		$body_tmp = NULL;
		$line_length = 0;

		// 1行あたりの制限文字数（日本語を取り扱う前提） 39*2 = 78 Byte
		$part_length = 39;

		for ($i = 0; $i < count($line); $i++) {
		    $line_length = strlen($line[$i]);
		    $one_line = NULL;

		// ASCII文字のみであれば、最大制限文字数の2倍の文字数までを許可する
		    if ($line_length > ($part_length * 2)) {
		        $mb_length = mb_strlen($line[$i]);

		// メール全体の行数を求める
		        if (($mb_length % $part_length) == 0) {
		            $loop_cnt = $mb_length / $part_length;
		        } else {
		            $loop_cnt = ceil(mb_strlen($line[$i]) / $part_length);
		        }

		        $start_num = 0;

		// 1行ごとに制限文字数内で分解して改行コードを挿入する
		        for ($j = 1; $j <= $loop_cnt; $j++) {
		// 制限文字数単位で改行コード挿入
		            $one_line .= mb_substr($line[$i], $start_num, $part_length) . "\r\n";
		           $start_num = $part_length * $j;
		        }
		    } else {
		        $one_line = $line[$i] . "\r\n";
		    }
		    $body_tmp .= $one_line;
		}
		return $body_tmp;
	}


	function must_change() {

		foreach( $this->pram as $key => $val ) {
			//改行コード除去
			if( $key != 'iken') {
				$val = preg_replace("/(\r)+/", '', $val );
				$val = preg_replace("/(\n)+/", '', $val );
			}

			//カナ全角変換
			$val = mb_convert_kana($val, 'KV', ENCODE_CHARSET);

			//英数字全角変換
			if( $key == 'sei_kana' || $key == 'mei_kana' || $key == 'com_kana' ) {
				$val = str_replace("'", "’", $val);
				$val = mb_convert_kana($val, 'A', ENCODE_CHARSET);
			}

			//数字半角変換
			if( $key == 'zip01' || $key == 'zip02' || $key == 'tel1' || $key == 'tel2' || $key == 'tel3') {
				$val = mb_convert_kana($val, 'n', ENCODE_CHARSET);
			}

			if( $key == 'mail' || $key == 'mail2') {
				$val = preg_replace("/(\r)+/", '', $val );
				$val = preg_replace("/(\n)+/", '', $val );
			}

			$this->pram[$key] = $val;
		}

	}

}

?>
