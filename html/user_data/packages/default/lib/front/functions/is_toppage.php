<?php
/*
 * サイトのトップページかどうかを判断する。
 * SITE_ROOT_DIRが正常に設定されている必要があります。
 * @return サイトのトップページであればtrue、そうでなければfalseを返します。
*/
function is_toppage(){
	$server_name = $_SERVER['SERVER_NAME'];
	$request_uri = $_SERVER['REQUEST_URI'];
	//正規表現に使用するためエスケープする
	$site_root_dir = preg_quote(SITE_ROOT_DIR, '/');

	$bool =
	$request_uri === SITE_ROOT_DIR
	|| preg_match('/^'.$server_name.$site_root_dir.'\?.*$/', $server_name.$request_uri)//パラメータで終わる
	|| preg_match('/^'.$server_name.$site_root_dir.'\/+$/', $server_name. $request_uri)//スラッシュの連続で終わる
	|| preg_match('/^'.$server_name.$site_root_dir.'\/+\?.*$/', $server_name. $request_uri)//スラッシュの連続、パラメータで終わる
	? true : false;

	return $bool;
}



?>