<?php
/*
 * SearchProductsAddCondition
 * @Copyright (C) 2014 aratana Inc. All Rights Reserved.
 * @link http://aratana.jp/
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

/**
 * プラグインのメインクラス
 *
 * @package SearchProductsAddCondition
 * @author aratana Inc.
 * @version $Id: $
 */
class SearchProductsAddCondition extends SC_Plugin_Base {

    // 定数宣言
    const CLASS_NAME = 'SearchProductsAddCondition';

    /**
     * コンストラクタ
     */
    public function __construct(array $arrSelfInfo) {
        parent::__construct($arrSelfInfo);
    }

    /**
     * インストール
     * installはプラグインのインストール時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin plugin_infoを元にDBに登録されたプラグイン情報(dtb_plugin)
     * @return void
     */
    function install($arrPlugin) {
        $arrData = array();
        $arrData['disp_SearchProductsAddCondition_status'] = 'on';
        $arrData['disp_SearchProductsAddCondition_price'] = 'on';
        $arrData['disp_SearchProductsAddCondition_comment'] = 'on';

        $objQuery =& SC_Query_Ex::getSingletonInstance();

        // UPDATEする値を作成する。
        $sqlval = array();
        $sqlval['free_field1'] = serialize($arrData);
        $where = "plugin_code = ?";
        $arrWhereVal[] = self::CLASS_NAME;
        // UPDATEの実行
        $objQuery->update('dtb_plugin', $sqlval, $where, $arrWhereVal);

        unset($arrData);
        unset($sqlval);

        // プラグインのロゴ画像をアップ
        if (copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/logo.png", PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/logo.png") === false);
    }

    /**
     * アンインストール
     * uninstallはアンインストール時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function uninstall($arrPlugin) {
        // ロゴ画像削除
        if (file_exists(PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code']) . '/logo.png') {
            if (SC_Helper_FileManager_Ex::deleteFile(PLUGIN_HTML_REALDIR . '/' . array($arrPlugin['plugin_code']) . '/logo.png') === false);
        }
    }

    /**
     * 稼働
     * enableはプラグインを有効にした際に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function enable($arrPlugin) {
        // Nothing
    }

    /**
     * 停止
     * disableはプラグインを無効にした際に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function disable($arrPlugin) {
        // Nothing
    }

    /**
     * 処理の介入箇所とコールバック関数を設定
     * registerはプラグインインスタンス生成時に実行されます
     *
     * @param SC_Helper_Plugin $objHelperPlugin
     */
    function register(SC_Helper_Plugin $objHelperPlugin) {
        return parent::register($objHelperPlugin, $this->arrSelfInfo['priority']);
    }

    /**
     * プレプロセスコールバック関数
     * スーパーフックポイント
     *
     * @param LC_Page_Ex $objPage ページオブジェクト
     * @return void
     */
    function preProcess($objPage) {
        // たぶん使わない
    }

    /**
     * プロセスコールバック関数
     * スーパーフックポイント
     *
     * @param LC_Page_Ex $objPage ページオブジェクト
     * @return void
     */
    function prosess() {
        // たぶん使わない
    }

    //--------------------------------------------------------------------------
    // Orig
    //--------------------------------------------------------------------------

    /**
     * テンプレートのフック
     *
     * @param string テンプレートソース
     * @param LC_Page_Ex $objPage ページオブジェクト
     * @param string テンプレートファイル名
     * @return void
     */
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {
        $objTransform = new SC_Helper_Transform($source);
        $template_dir = PLUGIN_UPLOAD_REALDIR . self::CLASS_NAME .'/templates/';

        // ページのトランスフォーム
        switch($objPage->arrPageLayout['device_type_id']) {
            case DEVICE_TYPE_MOBILE:
            case DEVICE_TYPE_SMARTPHONE:
            case DEVICE_TYPE_ADMIN:
                break;
            case DEVICE_TYPE_PC:
                // フックするページ
                if (strpos($filename, 'products/list.tpl') !== false) {
                    // 有効の場合のみトランスフォーム
                    $objTransform->select('div#undercolumn ul.pagecond_area')->appendChild(file_get_contents($template_dir . 'default/SearchProductsAddConditionResults.tpl'));
                }
                break;
            default:
                break;
        }

        // ブロックのトランスフォーム
        switch($objPage->blocItems['device_type_id']){
            case DEVICE_TYPE_MOBILE:
            case DEVICE_TYPE_SMARTPHONE:
            case DEVICE_TYPE_ADMIN:
                break;
            case DEVICE_TYPE_PC:
                // フックするページ
                if (strpos($filename, 'frontparts/bloc/search_products.tpl') !== false) {
                    // 有効の場合のみトランスフォーム
                    $objTransform->select('div.block_outer div#search_area div.block_body p.btn')->insertBefore(file_get_contents($template_dir . 'default/SearchProductsAddCondition.tpl'));
                }
                break;
            default:
                break;
        }

        //トランスフォームされた値で書き換え
        $source = $objTransform->getHTML();
    }

    /**
     * 絞り込み条件を商品検索ブロックに追加するフック (LC_Page_FrontParts_Bloc_SearchProducts_action_after)
     *
     * @param SC_Helper_Plugin $objHelperPlugin
     */
    function lfAddSearchProductsAddCondition($objPage) {
        // 前画面からの選択済みチェックボックスを渡す
        if ( empty($_GET['SearchProductsAddConditionStatusCheckboxes']) == false ) {
            $key = self::CLASS_NAME . '_arrStatusSelected';
            $objPage->$key = $_GET['SearchProductsAddConditionStatusCheckboxes'];
        }

        // 商品ステータス取得
        $arrStatus = $this->lfGetStatus();
        // パラメータ渡し用のキー
        $key = self::CLASS_NAME . '_arrStatus';
        //パラメータセット
        $objPage->$key = $arrStatus;

        // プラグイン設定値取得
        $arrPluginConf = $this->loadData($objPage);
        // パラメータ渡し用のキー
        $key = self::CLASS_NAME . '_arrPluginConf';
        //パラメータセット
        $objPage->$key = $arrPluginConf;
    }

    /**
     * 商品ステータスを取得する
     *
     * @return array $ 選択中の商品ステータスID
     */
    function lfGetStatus() {
        // 商品ステータスを取得する
        $masterData = new SC_DB_MasterData_Ex();
        $arrStatus = $masterData->getMasterData('mtb_status');
        return $arrStatus;
    }

    // プラグイン設定の情報を取得
    function loadData($objPage) {
        $arrRet = array();
        $arrData = SC_Plugin_Util_Ex::getPluginByPluginCode(self::CLASS_NAME);
        
        // ページ用
        switch($objPage->arrPageLayout['device_type_id']) {
            case DEVICE_TYPE_MOBILE:
            case DEVICE_TYPE_SMARTPHONE:
            case DEVICE_TYPE_ADMIN:
                break;
            case DEVICE_TYPE_PC:
                if (!SC_Utils_Ex::isBlank($arrData['free_field1'])) {
                    $arrRet = unserialize($arrData['free_field1']);
                }
                break;
            default:
                break;
        }

        // ブロック用
        switch($objPage->blocItems['device_type_id']){
            case DEVICE_TYPE_MOBILE:
            case DEVICE_TYPE_SMARTPHONE:
            case DEVICE_TYPE_ADMIN:
                break;
            case DEVICE_TYPE_PC:
                if (!SC_Utils_Ex::isBlank($arrData['free_field1'])) {
                    $arrRet = unserialize($arrData['free_field1']);
                }
                break;
            default:
                break;
        }

        return $arrRet;
    }

    /**
     * 商品検索の絞り込みフック (LC_Page_Products_List_action_after)
     *
     * @param LC_Page_Ex $objPage ページオブジェクト
     * @return void
     */
    function lfProcSearchProductsAddCondition($objPage) {
        // 画面で指定した絞り込みの条件取得
        $arrSearchProductsAddConditionStatus = $_GET['SearchProductsAddConditionStatusCheckboxes'];
        $SearchProductsAddConditionPriceFrom = $_GET['SearchProductsAddConditionPriceFrom'];
        $SearchProductsAddConditionPriceTo = $_GET['SearchProductsAddConditionPriceTo'];
        $SearchProductsAddConditionComment = $_GET['SearchProductsAddConditionComment'];

        // 何も絞り込み条件を指定していなければ何もしない
        if ( !empty($arrSearchProductsAddConditionStatus) || !empty($SearchProductsAddConditionPriceFrom) || !empty($SearchProductsAddConditionPriceTo) || !empty($SearchProductsAddConditionComment) ) {
            //--- 絞り込みメインここから >>>

            // 絞り込み前の標準の検索結果
            $arrDefSearchProducts = $objPage->arrProducts;
            $arrDefSearchProductStatus = $objPage->productStatus;

            // 絞り込んだ結果を入れる用
            $arrSearchProductsAddConditionProducts = array();

            // ================================================
            // 絞り込みメイン (1商品毎)
            // ================================================
            foreach ($arrDefSearchProducts as $key => $val) {
                // フラグ
                $dispFlag = true;

                // ----------------------------------------
                // 商品ステータスで絞り込み(指定があれば)
                // ----------------------------------------
                if ( empty($arrSearchProductsAddConditionStatus) == false ) {
                    // そもそも商品ステータスが設定されている商品か
                    if (empty($arrDefSearchProductStatus[$key])) {
                        // 商品ステータスが設定されていない商品は検索結果に表示しない
                        $dispFlag = false;
                    } else {
                        $statusFindFlag = false;
                        // 絞り込み条件で指定された商品ステータスか(複数ステータスを考慮するためループ)
                        foreach($arrDefSearchProductStatus[$key] as $prodStatus) {
                            if (in_array($prodStatus, $arrSearchProductsAddConditionStatus)) {
                                // 指定されていた
                                $statusFindFlag = true;
                                break;
                            }
                        }
                        // 指定されてたか
                        if ($statusFindFlag == false){
                            // 指定されていなかった
                            $dispFlag = false;
                        }
                    }
                }
                // 商品ステータスの絞り込み条件に合致しない商品だったら他の調査はしない(かつ、検索結果へためない)
                if ($dispFlag == false) {
                    // 検索結果へためない
                    continue;
                }

                // ----------------------------------------
                // 価格帯(下限)で絞り込み(指定があれば)
                // ----------------------------------------
                try {
                    if ( empty($SearchProductsAddConditionPriceFrom) == false ) {
                        if (intval($val['price02_max_inctax']) < intval($SearchProductsAddConditionPriceFrom)) {
                            // 検索結果へためない
                            $dispFlag = false;
                        }
                    }
                } catch (Exception $e) {
                }
                // 価格帯(下限)の絞り込み条件に合致しない商品だったら他の調査はしない(かつ、検索結果へためない)
                if ($dispFlag == false) {
                    // 検索結果へためない
                    continue;
                }
                // ----------------------------------------
                // 価格帯(上限)で絞り込み(指定があれば)
                // ----------------------------------------
                try {
                    if ( empty($SearchProductsAddConditionPriceTo) == false ) {
                        if (intval($val['price02_min_inctax']) > intval($SearchProductsAddConditionPriceTo)) {
                            // 検索結果へためない
                            $dispFlag = false;
                        }
                    }
                } catch (Exception $e) {
                }
                // 価格帯(上限)の絞り込み条件に合致しない商品だったら他の調査はしない(かつ、検索結果へためない)
                if ($dispFlag == false) {
                    // 検索結果へためない
                    continue;
                }

                // ----------------------------------------
                // キーワードで絞り込み(指定があれば)
                // ----------------------------------------
                try {
                    if ( empty($SearchProductsAddConditionComment) == false ) {
                        // 一覧メインコメント、検索ワードでどこかが一致しているか(大小文字区別なし)
                        if ( !stristr($val['main_list_comment'], $SearchProductsAddConditionComment) && !stristr($val['comment3'], $SearchProductsAddConditionComment) ) {
                            // 一致しなかったので検索結果へためない
                            $dispFlag = false;
                        }
                    }
                } catch (Exception $e) {
                }
                // キーワードの絞り込み条件に合致しない商品だったら検索結果へためない
                if ($dispFlag == false) {
                    // 検索結果へためない
                    continue;
                }

                // ----------------------------------------
                // 絞り込みの条件に合致した商品を検索結果表示用にためる
                // ----------------------------------------
                array_push($arrSearchProductsAddConditionProducts, $val);
            }

            // 絞り込み結果で標準の絞り込み結果を上書き
            $objPage->arrProducts = $arrSearchProductsAddConditionProducts;

            // 検索件数に絞り込み分を考慮する
            $objPage->tpl_linemax = count($arrSearchProductsAddConditionProducts);

            //<<< 絞り込みメインここまで ---
        }

        // ================================================
        // 検索結果ページの検索条件表示用
        // ================================================
        // 商品ステータス
        if ( empty($arrSearchProductsAddConditionStatus) == false ) {
            $dispStatusJyouken = null;
            foreach ($arrSearchProductsAddConditionStatus as $key => $val) {
                if ( empty($dispStatusJyouken) == false ) { $dispStatusJyouken .= " / "; }
                $dispStatusJyouken .= $objPage->arrSTATUS[$val];
            }
        } else {
            $dispStatusJyouken = '指定なし';
        }
        // 価格(下限)
        if ( empty($SearchProductsAddConditionPriceFrom) == false ) {
            $SearchProductsAddConditionPriceFrom .= '円';
        } else {
            $SearchProductsAddConditionPriceFrom = '下限なし';
        }
        // 価格(上限)
        if ( empty($SearchProductsAddConditionPriceTo) == false ) {
            $SearchProductsAddConditionPriceTo .= '円';
        } else {
            $SearchProductsAddConditionPriceTo = '上限なし';
        }
        // キーワード
        if ( empty($SearchProductsAddConditionComment) == false ) {
            $SearchProductsAddConditionPriceTo = '指定なし';
        }

        // 検索条件(表示用)
        $objPage->arrSearchProductsAddCondition = array('status' => $dispStatusJyouken, 'priceFrom' => $SearchProductsAddConditionPriceFrom, 'priceTo' => $SearchProductsAddConditionPriceTo, 'comment' => $SearchProductsAddConditionComment);

        // プラグイン設定値渡し(表示用)
        $arrPluginConf = $this->loadData($objPage);
        $key = self::CLASS_NAME . '_arrPluginConf';
        $objPage->$key = $arrPluginConf;
    }

}
