/*
# タブレットで閲覧しているかどうかを判断するJavaScript
タブレットの定義は、iPhone、および、Androidタブレットです。
*/
'use strict';
function isTablet(){
	var ua = navigator.userAgent;
	var bool = (ua.indexOf('iPad') > -1 && (ua.indexOf('Android') > -1 && ua.indexOf('Mobile') === -1)) ? true : false;
	return bool;
}