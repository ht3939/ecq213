$(function () {

	var sort_tab = $('.sort-tabs');
	var sort_contents = '.sort-contents';
	var filter_tab = $('.filter-tabs');
	var filter_contents = '.filter-contents';

	var find_item = $(".filter-tabs-contents:visible .js-ranking-item:hidden");
	var rank_more = $(".js-ranking-more");

	//タブ切り替えの処理
	function tabs (selecter,contents) {
		selecter.each(function(){
	    var target = $(this);
	    target.parent().siblings(contents).children('div').hide();
	    target.parent().siblings(contents).children('div:first').show();


	    target.find('a').on("click", function(){
		    var has_selected = $(this).hasClass('selected')
		    // タブが有効でない場合に処理する
		    if(has_selected === false) {
			    target.find('a').removeClass('selected');
			    $(this).addClass('selected');
			    var href = $(this).attr('href');
			    target.parent().siblings(contents).children('div').hide();
			    target.parent().siblings(contents).children($(this).attr('href')).fadeIn();
			  	init();
			    // 件数表示
					rank_more.text("さらに"+find_item.length+"件を表示する");
					// アンカーリンク
					if($(this).parents('.sort-tabs').hasClass('tabs-bottom')){
						$('html,body').animate({scrollTop: $('#ranking').offset().top},400,"linear");
					}

					// ソートタブの同機処理
					if(target.hasClass('sort-tabs')){
						var syncTab = target.parent().siblings('.sort');
			    	syncTab.find('a[href!='+href+']').removeClass('selected');
						syncTab.find('a[href='+href+']').addClass('selected');
					}
			  }
			  return false;
	    });
	  });
	}

	tabs(sort_tab,sort_contents);
	tabs(filter_tab,filter_contents);


	function init() {
		$(".js-ranking-item").hide();
		$(".filter-tabs-contents:visible").find(".js-ranking-item:lt(5)").show();
		find_item = $(".filter-tabs-contents:visible .js-ranking-item:hidden");
		rank_more.text("さらに"+find_item.length+"件を表示する");

		// 商品数が5件以内だったらさらに表示ボタンを非表示に
		if(find_item.length === 0){
			rank_more.hide();
		} else {
			rank_more.show();
		}
	}
	init();



	var more_text = rank_more.text();
	rank_more.click(function() {
		var target = $(this);
		find_item.toggle('linear', function() {
				if(find_item.is(':visible')){
					target.text("閉じる");
				} else {
					target.text("さらに"+find_item.length+"件を表示する");
				}
			})
	});


	//テーブルの列全体をクリック
	$(".ranking_table tr td").click(function(){
			// window.location = $(this).parent("tr").children(".rank-company").find(".site_btn a").attr("href");
			window.open($(this).parent("tr").children(".rank-company").find(".site_btn a").attr("href"));
	});
	$(".ranking_table tr td").hover(function(){
					$(this).parent("tr").children('.rank-company').find(".site_btn a").css(
						"background-color" , "#ff0033"
					)
				},
					function(){
					$(this).parent("tr").children('.rank-company').find(".site_btn a").css(
						"background-color" , "#e25757"
					)
				});

});


