<?php
//メール本文

$admin=<<<EOF
WEBサイトより、
下記内容のお問い合わせがございました。

====================================================
姓名：{$this->pram['sei_kan']}{$this->pram['mei_kan']}
E-Mail：{$this->pram['mail']}

【お問い合わせ内容】
{$this->pram['iken']}
====================================================

EOF;
?>