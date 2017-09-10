<?php
//内部コード
define('INTER_CHARSET', 'UTF-8');
//出力文字コード
define('OUTPUT_CHARSET', 'UTF-8');
//変換文字コード
define('ENCODE_CHARSET', 'UTF-8');

//検出順
//mb_detect_order("SJIS-win,SJIS,JIS,EUC-JP,UTF-8,ASCII");

//ini_set('default_charset', OUTPUT_CHARSET);
ini_set('short_open_tag', 'on');

session_start();

//管理者アドレス
//define('ADMIN_MAIL', 'takashi@nakamichi-adm.com');
define('ADMIN_MAIL', 'namioka@exnetcom.com');
?>
