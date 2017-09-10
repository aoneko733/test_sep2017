<?php



class Ex_Define {

	var $pref;
	var $kbn;
	var $wait;

	/* コンストラクタ */
	function Ex_Define() {
		$this->kbn = $this->get_kbn();
//		$this->pref = $this->get_pref();
		$this->wait = $this->get_wait();
	}

	function get_kbn() {
		$kbn = array('english' => 'English Inquiry',
					);
		return $kbn;
	}


	function get_wait() {
		$wait = array(	'1' => 'Catalog Request',
						'2' => 'Material Request',
						'3' => 'Description of products and services',
					);
		return $wait;
	}

	function get_pref() {
		return $pref;
	}


	function get_postpram() {

		$postpram['tp'] = '';
		$postpram['4_name1'] = '';
		$postpram['8_mail'] = '';
		$postpram['8_mail2'] = '';
		$postpram['6_tel'] = '';
		$postpram['7_fax'] = '';
		$postpram['5_address_1'] = '';
//		$postpram['5_address_2'] = '';
//		$postpram['5_city'] = '';
//		$postpram['5_state'] = '';
		$postpram['1_free'] = '';
		$postpram['2_free'] = '';
		$postpram['4_country'] = '';
		$postpram['5_zip'] = '';
		$postpram['2_section'] = '';
		$postpram['1_company'] = '';
		$postpram['want1'] = '';
		$postpram['want2'] = '';
		$postpram['want3'] = '';
		$postpram['9_question'] = '';
		$postpram['3_free'] = '';
//		$postpram['agreement'] = '';

		return $postpram;

	}


	function get_valid($pram) {


		$valid['4_name1']     = array('empty', array('maxlen' => '100'));
		$valid['6_tel']       = array('empty', array('maxlen' => '100'));
		$valid['5_address_1'] = array('empty', array('maxlen' => '200'));
//		$valid['5_address_2'] = array('empty', array('maxlen' => '100'));
//		$valid['5_city']      = array('empty', array('maxlen' => '100'));
//		$valid['5_state']     = array('empty', array('maxlen' => '100'));
		$valid['4_country']   = array('empty', array('maxlen' => '100'));
		$valid['5_zip']       = array('empty', array('maxlen' => '100'));

		$valid['7_fax']     = array(array('maxlen' => '100'));
		$valid['2_section'] = array(array('maxlen' => '100'));
		$valid['1_company'] = array(array('maxlen' => '100'));

		$valid['8_mail']  = array('mail', array('maxlen' => '256'));
		$valid['8_mail2'] = array(array('equal' => $pram['8_mail']));

		$valid['9_question'] = array(array('maxlen' => '1000'));

		return $valid;

	}


	function get_errmsg() {

		$errmsg['4_name1']      = array('empty' => 'Please input "Name"', 'maxlen' => '"Name" should input within 100 characters');
		$errmsg['6_tel']        = array('empty' => 'Please input "Telephone"', 'maxlen' => '"Phone number" should input within 100 characters');
		$errmsg['5_address_1']  = array('empty' => 'Please input "Address"', 'maxlen' => '"Address" should input within 200 characters');
//		$errmsg['5_address_2']  = array('empty' => 'Please input "Line 2"', 'maxlen' => '"Line 2" should input within 100 characters');
//		$errmsg['5_city']       = array('empty' => 'Please input "City"', 'maxlen' => '"City" should input within 100 characters');
//		$errmsg['5_state']      = array('empty' => 'Please input "State Province Prefecture"', 'maxlen' => '"State Province Prefecture" should input within 100 characters');
		$errmsg['4_country']    = array('empty' => 'Please input "Country"', 'maxlen' => '"Country" should input within 100 characters');
		$errmsg['5_zip']        = array('empty' => 'Please input "Zip Postal code"', 'maxlen' => '"Zip Postal code" should input within 100 characters');

		$errmsg['7_fax']      = array('maxlen' => '"FAX number" should input within 100 characters');
		$errmsg['2_section']  = array('maxlen' => '"Department" should input within 100 characters');
		$errmsg['1_company']  = array('maxlen' => '"Company" should input within 100 characters');

		$errmsg['8_mail']  = array('empty' => 'Please input "E-mail address"', 'mail' => 'Please input "E-mail address" in mail form', 'maxlen' => '"E-mail address" should input within 256 characters');
		$errmsg['8_mail2'] = array('equal' => '"E-mail address" differs from the contents');

		$errmsg['9_question'] = array('maxlen' => '"Question" should input within 1000 characters');

		return $errmsg;

	}


}

?>
