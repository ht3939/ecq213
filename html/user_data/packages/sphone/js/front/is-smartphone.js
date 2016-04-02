/*
# スマートフォンで閲覧しているかどうかを判断するJavaScript
スマートフォンの定義は、iPhone、および、Androidスマートフォンです。
*/
'use strict';
function isSmartphone(){
	var ua = navigator.userAgent;
	var bool = (ua.indexOf('iPhone') > -1 && (ua.indexOf('Android') > -1 && ua.indexOf('Mobile') > -1)) ? true : false;
	return bool;
}


