<div id="mainv">
  <div class="base-container">
    <img src="<!--{$TPL_URLPATH}-->img/header/mainv.png" alt="��Ԉ����I������������I">
  </div>
</div>
<div class="top-data">
  <div class="inner">
    <div class="update-date"><p>�����L���O�ŏI�X�V���F2016�N03��01��</p></div>
    <div class="sns-list">
      <ul class="">

        <li>
          <!-- Twitter -->
          <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja">�c�C�[�g</a>
          <script>
              !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        </li>

        <li>
          <!-- Facebook -->
          <div class="fb-like" data-href="" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
          <div id="fb-root"></div>
          <script>
          (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
          fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
          </script>
        </li>

        <li>
          <!-- Google plus -->
          <div class="g-plusone" data-size="medium"></div>
          <script type="text/javascript">
              window.___gcfg = {lang: 'ja'};
              (function() {
                  var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                  po.src = 'https://apis.google.com/js/plusone.js';
                  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
              })();
          </script>
        </li>
      </ul>
    </div>
  </div>
</div>

<!--{include file=frontparts/bloc/yh-top-bestproduct-bloc.tpl}-->

<!--���y�[�W�i�r(�{��)-->
<!--{capture name=search_navi_body}-->
    <!--{include file=products/yh-search-bloc.tpl}-->
<!--{/capture}-->
<!--���y�[�W�i�r(�{��)-->

<div class="row-container is-reverse">
	<div class="main-column">
	    <form name="form_search" id="form_search" method="get" action="?">
	        <!--{* ���������� *}-->
	        <input type="hidden" name="category_id" value="<!--{$arrSearchData.category_id|h}-->" />
	        <input type="hidden" name="name" value="<!--{$arrSearchData.name|h}-->" />

	        <!--{if is_array($arrSearchData.maker_id)}-->
	            <!--{foreach from=$arrSearchData.maker_id item=mkid name=arrProducts_makerid}-->
		            <input type="hidden" name="maker_id[]" value="<!--{$mkid|h}-->" />
	            <!--{/foreach}-->
	        <!--{else}-->
		            <input type="hidden" name="maker_id" value="<!--{$arrSearchData.maker_id|h}-->" />
	        <!--{/if}-->

	        <input type="hidden" name="product_status_id" value="<!--{$arrSearchData.product_status_id|h}-->" />
	        <input type="hidden" name="y1_price_min" value="<!--{$arrSearchData.y1_price_min|h}-->" />
	        <input type="hidden" name="y1_price_max" value="<!--{$arrSearchData.y1_price_max|h}-->" />
	        <input type="hidden" name="total_price_min" value="<!--{$arrSearchData.total_price_min|h}-->" />
	        <input type="hidden" name="total_price_max" value="<!--{$arrSearchData.total_price_max|h}-->" />
	        <input type="hidden" name="cp_price_min" value="<!--{$arrSearchData.cp_price_min|h}-->" />
	        <input type="hidden" name="cp_price_max" value="<!--{$arrSearchData.cp_price_max|h}-->" />
	        <input type="hidden" name="datasize_min" value="<!--{$arrSearchData.datasize_min|h}-->" />
	        <input type="hidden" name="datasize_max" value="<!--{$arrSearchData.datasize_max|h}-->" />
	        <input type="hidden" name="data_speed_down_min" value="<!--{$arrSearchData.data_speed_down_min|h}-->" />
	        <input type="hidden" name="data_speed_down_max" value="<!--{$arrSearchData.data_speed_down_max|h}-->" />
	        <input type="hidden" name="classcategory_id1" value="<!--{$arrSearchData.classcategory_id1|h}-->" />
	        <input type="hidden" name="classcategory_id2" value="<!--{$arrSearchData.classcategory_id2|h}-->" />
	        <input type="hidden" name="product_code" value="<!--{$arrSearchData.product_code|h}-->" />
          <input type="hidden" name="lntype" value="<!--{$arrSearchData.lntype|h}-->" />
	        <!--{* ���������� *}-->
	        <!--{* ���y�[�W�i�r�֘A *}-->
	        <input type="hidden" name="orderby" value="<!--{$orderby|h}-->" />
	        <input type="hidden" name="disp_number" value="<!--{$disp_number|h}-->" />
	        <!--{* ���y�[�W�i�r�֘A *}-->
	        <input type="hidden" name="rnd" value="<!--{$tpl_rnd|h}-->" />
	    </form>

      <form name="form_filter" id="form_filter" method="get" action="?">
          <!--{* ���������� *}-->
          <input type="hidden" name="mode" value="<!--{$mode|h}-->" />

          <!--{if is_array($arrSearchFilterData.filter_maker_id)}-->
              <!--{foreach from=$arrSearchFilterData.filter_maker_id item=mkid name=arrProducts_makerid}-->
                <input type="hidden" name="filter_maker_id[]" value="<!--{$mkid|h}-->" />
              <!--{/foreach}-->
          <!--{/if}-->
          <!--{if is_array($arrSearchFilterData.filter_device_id)}-->
              <!--{foreach from=$arrSearchFilterData.filter_device_id item=dvid name=arrProducts_deviceid}-->
                <input type="hidden" name="filter_device_id[]" value="<!--{$dvid|h}-->" />
              <!--{/foreach}-->
          <!--{/if}-->
          <!--{if $arrSearchFilterData.filter_lntype > 0}-->
              <input type="hidden" name="filter_lntype" value="<!--{$arrSearchFilterData.filter_lntype|h}-->" />
          <!--{/if}-->
          <!--{if $arrSearchFilterData.filter_cptype > 0}-->
              <input type="hidden" name="filter_cptype" value="<!--{$arrSearchFilterData.filter_cptype|h}-->" />
          <!--{/if}-->
          <!--{if $arrSearchFilterData.filter_datasize > 0}-->
              <input type="hidden" name="filter_datasize" value="<!--{$arrSearchFilterData.filter_datasize|h}-->" />
          <!--{/if}-->
          <!--{if $arrSearchFilterData.filter_data_speed_down > 0}-->
              <input type="hidden" name="filter_data_speed_down" value="<!--{$arrSearchFilterData.filter_data_speed_down|h}-->" />
          <!--{/if}-->



      </form>
		<main>


	        <!--{include file=products/yh-list-bloc.tpl}-->




	        <!--{include file=frontparts/bloc/yh-top-rank-abouts.tpl}-->
		</main>
	</div>
<!--	<div class="side-column">
			</div>-->
</div>


<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>window.jQuery || document.write('<script src="<!--{$TPL_URLPATH}-->/js/jquery-1.11.3.min.js"><\/script>');</script>
<script src="<!--{$TPL_URLPATH}-->/js/front/common.js"></script>

<!--[if lt IE 9]>
<script src="/js/front/html5shiv.js"></script>
<![endif]-->
<script src="<!--{$TPL_URLPATH}-->/js/front/jquery.multiple-select.js"></script>


<script src="<!--{$TPL_URLPATH}-->/js/front/index.js"></script>
<!--{*  <?php echo $body_end; ?>*}-->
<script src="<!--{$TPL_URLPATH}-->/js/front/Chart.min.js"></script>
<script src="<!--{$TPL_URLPATH}-->/js/front/jquery.bxslider.min.js"></script>
<script>
//�Ή��[���X���C�_�[
if($('.bxslider').length > 1){
  (function BXSLIDER(){
    $('.bxslider').bxSlider({
      pager: false,
      prevText: '',
      nextText: '',
      slideWidth:233,
      auto: true,
      onSliderLoad:function(currentIndex){
        $('.bx-wrapper,.bx-prev,.bx-next').click(function(e){
          e.stopPropagation();
        });
      }
    });
  })();
}

//���T�̑���TOP�X���C�_�[
(function TOPBXSLIDER(){
  $('.topbxslider').bxSlider({
    pager: false,
    prevText: '',
    nextText: '',
    slideWidth:233,
    auto: true
  });
})();

//�{�b�N�X�̍�������
$('.js-height').each(function(){
  var maxHeight;
  var dtHeight = $(this).find('dt').height();
  var ddHeight = $(this).find('dd').height();
  if(dtHeight >= ddHeight){
    maxHeight = dtHeight;
  }else{
    maxHeight = ddHeight;
  }
  $(this).find('dt,dd').height(maxHeight);
});
//�`���[�g
$(function() {
// �`���[�g�̘g�g��
var radarChartData = {
// ����
  labels: ["", "", "", "", ""],
  datasets: [
  {
   // �������g�������̂�RGBA�ŐF���Č���rgba(xxx,xxx,xxx,0.5):���ߓx50%
   fillColor: "rgba(173,192,225,0.7)",  // �`���[�g���̐F
   strokeColor: "#7f9fd5",  // �`���[�g���͂ސ��̐F
   pointColor: "#5f87cb",   // �`���[�g�̓_�̐F
   pointStrokeColor: "#5f87cb",    // �_���͂ސ��̐F
   // �e���ڂ̒l
   <!--{$tpl_bestproduct_graph}-->
   }
             ]
   };
   // ���[�_�[�`���[�g�̖ڐ��Ƃ��̐ݒ�
   var canvas = document.getElementById("canvas");
   var context = canvas.getContext("2d");
   var chart = new Chart(context);
   var rader = chart.Radar(radarChartData, {
   scaleShowLabels: false,  // �ڐ���\���itrue/false�j
   pointLabelFontStyle : "bold",
   pointLabelFontColor : "#333",
   showTooltips: false,//�c�[���`�b�voff
   pointLabelFontSize : 12, // ���x���̃t�H���g�T�C�Y
   scaleOverride : true, // �ڐ��̍ő�l���蓮�ݒ�itrue/false�j
   showScale: true,
   scaleSteps : 5, // �ڐ��̐�
   scaleStartValue : 0, // �ڐ��̍ŏ��̐�
   scaleStepWidth : 1, // �ڐ��̊Ԋu
   // �ڐ��̍ő�l�̌v�Z�FscaleSteps�i�ڐ��̐��j��5�@scaleStepWidth�i�ڐ��̊Ԋu�j��2 ����5�~2�ōő�l��10
   });
});
//�^�u
$('.js-device-tab').children().click(function(){
  $(this).parent().children().removeClass('active');
  $(this).addClass('active');
  $('.js-device-content').children().removeClass('active');
  $('.js-device-content').children().eq($(this).index()).addClass('active');
});
//a�^�O �S�̃����N
$('.site-link a').click(function(e){
  //console.log(e.target().attr('href'););
  // location.href = $(this).attr('href');
  e.preventDefault();
  // return false;
  // console.log(e.target);
    // alert('done');
  // console.log(e.target);
  e.stopPropagation();
$(".js-all-link").click(function(e){
  location.href = $(this).find('.js-link-btn').attr("href");
});
//�\�[�g�\��
$('.sort-filter-btn .btn').click(function(){
  $('.sort-filter-btn').hide();
  $('.sort-filter').fadeIn();
});
//�Z���N�g�{�b�N�X �����I���uSumoSelect�v�v���O�C���g�p
//$('.js-select').SumoSelect({placeholder: '�I�����Ă�������'});
$('#filter_datasize').multipleSelect({single:true,theme:'bubble'});
$('#filter_cptype').multipleSelect({single:true,theme:'bubble'});
$('#filter_lntype').multipleSelect({single:true,theme:'bubble'});
$('#filter_data_speed_down').multipleSelect({single:true,theme:'bubble'});
$('#filter_device_id').multipleSelect(
  {selectAllText:'���ׂ�'
  ,allSelected  :'���ׂ�'
  ,placeholder  :'�I�����Ă�������'
  ,theme:'bubble'
});
$('#filter_maker_id').multipleSelect(
  {selectAllText:'���ׂ�'
  ,allSelected  :'���ׂ�'
  ,placeholder  :'�I�����Ă�������'
  ,theme:'bubble'
});


//IE8 �O���t��\��---------------------------------------
if(window.navigator.userAgent.toLowerCase().indexOf("msie") > -1 && window.navigator.appVersion.toLowerCase().indexOf("msie 8")>-1){
$('.graph').hide();
$('.detail .rank-list').css({width:620});
}

</script>