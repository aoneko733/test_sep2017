<?php



class Ex_Define {

	/* コンストラクタ */
	function Ex_Define() {
		
	}

	function get_postpram() {

		$postpram['sei_kan'] = '';
		$postpram['mei_kan'] = '';
		$postpram['mail'] = '';
		$postpram['iken'] = '';

		return $postpram;
	}


	function get_valid($pram) {

		$valid['sei_kan'] = array('empty', 'hex', array('maxlen' => '100'));
		$valid['mei_kan'] = array('empty', 'hex', array('maxlen' => '100'));

		$valid['mail']  = array('mail', array('maxlen' => '256'));

		$valid['iken'] = array('empty', 'hex', array('maxlen' => '1000'));

		return $valid;
	}


	function get_errmsg() {
		$errmsg['sei_kan'] = array('empty' => '「姓」をご入力ください。', 'hex' => '機種依存文字は使用できません。', 'maxlen' => '「姓」は100文字以下でご入力ください。');
		$errmsg['mei_kan'] = array('empty' => '「名」をご入力ください。', 'hex' => '機種依存文字は使用できません。', 'maxlen' => '「名」は100文字以下でご入力ください。');
		
		$errmsg['mail']  = array('mail' => '「メールアドレス」はアドレス形式でご入力ください。', 'maxlen' => '「メールアドレス」は256文字以下でご入力ください。');
		
		$errmsg['iken'] = array('empty' => '「要件（ご相談内容）」をご入力ください。', 'hex' => '機種依存文字は使用できません。', 'maxlen' => '「要件（ご相談内容）」は1000文字以下でご入力ください。');

		return $errmsg;

	}


}

?>
