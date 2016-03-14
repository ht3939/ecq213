<?php
/*
# 全ページ共通のインクルードファイル
*/
session_start();
$this_dir = dirname(__FILE__);



// include_once($this_dir.'/system/fd-setting.php');
include_once($this_dir.'/front/init.php');
include_once($this_dir.'/front/functions/is_toppage.php');



?>