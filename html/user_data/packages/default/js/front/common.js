/*
# 共通のjsファイルです
例外: フォームやLPなどの独立したデザインのページ
*/

/*
## 任意の位置へスクロールする

### 使い方

	1. href属性にスクロール先のハッシュを設定する （<a href="#header">）
	2. 1で設定した要素にscrollクラスを設定する （<a href="#header" class="js-scroll">）
*/
function setScroll(_target, _offsetTop){
	var target = _target.find('.js-scroll');
	if(!target.length){
		return false;
	}

	target.click(function(event){
		var scrollPoint = $('#' + this.href.split('#')[1]).offset().top - _offsetTop;
		$('html, body').animate({scrollTop:scrollPoint}, 500);
		event.preventDefault();
	});
};

(function($){
	'use strict';
	$(function(){
		var win = $(window);
		var doc = $(document);

		setScroll(doc, 0);

	});
})(jQuery);