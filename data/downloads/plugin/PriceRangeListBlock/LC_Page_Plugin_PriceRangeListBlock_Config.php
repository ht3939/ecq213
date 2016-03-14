<?php
/*
 * PriceRangeListBlock
 * Copyright(c) C-Rowl Co., Ltd. All Rights Reserved.
 * http://www.c-rowl.com/
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

// {{{ requires
require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';

class LC_Page_Plugin_PriceRangeListBlock_Config extends LC_Page_Admin_Ex {

    var $arrForm = array();

    /**
     * 初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = PLUGIN_UPLOAD_REALDIR ."PriceRangeListBlock/templates/config.tpl";
        $this->tpl_subtitle = "価格帯一覧ブロックプラグイン 設定画面";
    }

    /**
     * プロセス.
     *
     * @return void
     */
    function process() {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {

        $this->setTemplate($this->tpl_mainpage);
        $objFormParam = new SC_FormParam_Ex();

        // パラメーター情報の初期化
        $this->lfInitParam($objFormParam);

        // POST値をセット
        $objFormParam->setParam($_POST);

        // POST値の入力文字変換
        $objFormParam->convParam();

        // price_range_idを変数にセット
        $price_range_id = $objFormParam->getValue('price_range_id');

        // 変換後のPOST値を取得
        $this->arrForm  = $objFormParam->getHashArray();

        // モードによる処理切り替え
        switch ($this->getMode()) {

            // 編集処理
            case 'edit':
            // 入力文字の変換

                // エラーチェック
                $this->arrErr = $this->lfCheckError($this->arrForm, $objFormParam);
                if (count($this->arrErr) <= 0) {
                    if ($this->arrForm['price_range_id'] == '') {
                        // 情報新規登録
                        $this->lfInsert($this->arrForm);
                    } else {
                        // 情報編集
                        $this->lfUpdate($this->arrForm);
                    }

                    // 再表示
                    $this->objDisplay->reload();
                } else {
                    // POSTデータを引き継ぐ
                    $this->tpl_price_range_id = $this->arrForm['price_range_id'];
                }
                break;

            // 編集前処理
            case 'pre_edit':
                $this->arrForm = $this->lfPreEdit($this->arrForm['price_range_id']);
                $this->tpl_price_range_id = $this->arrForm['price_range_id'];
                break;

            // 順変更
            case 'up':
            case 'down':

                $this->lfRankChange($this->arrForm['price_range_id'], $this->getMode());

                // リロード
                SC_Response_Ex::reload();
                break;

            // 削除
            case 'delete':

                $this->lfDelete($this->arrForm['price_range_id']);

                // リロード
                SC_Response_Ex::reload();
                break;

            default:
                break;
        }

        // 情報読み込み
        $this->arrPriceRage = $this->lfDisp();
        // POSTデータを引き継ぐ
        $this->tpl_price_range_id = $price_range_id;

    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    /**
     * 情報表示.
     *
     * @return array $arrPriceRage 情報
     */
    function lfDisp() {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        $objQuery->setOrder('rank');
        $arrPriceRage = array();

        $arrPriceRage = $objQuery->select('*', 'plg_pricerangelistblock_price_range', $where);
        return $arrPriceRage;
    }

    /**
     * パラメーター情報の初期化を行う.
     *
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    function lfInitParam(&$objFormParam) {

        $objFormParam->addParam('ID', 'price_range_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('名称', 'price_range_name', SMTEXT_LEN, 'KVa', array('EXIST_CHECK','SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('価格条件(下限)', 'price_range_lower', INT_LEN, '', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('価格条件(上限)', 'price_range_upper', INT_LEN, '', array('MAX_LENGTH_CHECK'));

    }

    /**
     * 入力エラーチェック.
     *
     * @param  array $arrForm 情報
     * @return array $objErr->arrErr エラー内容
     */
    function lfCheckError(&$arrForm, &$objFormParam) {

        $arrErr = $objFormParam->checkError();
        if (!empty($arrErr)) {
            return $arrErr;
        }

        // price_range_id の正当性チェック
        if (!empty($arrForm['price_range_id'])) {
            $objDb = new SC_Helper_DB_Ex();
            if (!SC_Utils_Ex::sfIsInt($arrForm['price_range_id'])
                || SC_Utils_Ex::sfIsZeroFilling($arrForm['price_range_id'])
                || !$this->sfIsRecord('plg_pricerangelistblock_price_range', 'price_range_id', array($arrForm['price_range_id']))
            ) {
                // price_range_idが指定されていて、且つその値が不正と思われる場合はエラー
                $arrErr['price_range_id'] = '※ IDが不正です<br />';
            }
        }

        if (!empty($arrForm['price_range_lower']) && !SC_Utils_Ex::sfIsInt($arrForm['price_range_lower'])) {
            $arrErr['price_range_lower'] = '※ 価格条件(下限)は数字で入力してください。<br />';
        }
        if (!empty($arrForm['price_range_upper']) && !SC_Utils_Ex::sfIsInt($arrForm['price_range_upper'])) {
            $arrErr['price_range_upper'] = '※ 価格条件(上限)は数字で入力してください。<br />';
        }

        return $arrErr;
    }

    /**
     * レコードの存在チェックを行う.
     *
     * @param string $table テーブル名
     * @param string $col カラム名
     * @param array $arrVal 要素の配列
     * @param array $addwhere SQL の AND 条件である WHERE 句
     * @return bool レコードが存在する場合 true
     */
    function sfIsRecord($table, $col, $arrVal, $addwhere = '') {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $arrCol = preg_split('/[, ]/', $col);

        //$where = 'del_flg = 0';
        if ($addwhere != '') {
            $where.= " AND $addwhere";
        }

        foreach ($arrCol as $val) {
            if ($val != '') {
                if ($where == '') {
                    $where = "$val = ?";
                } else {
                    $where.= " AND $val = ?";
                }
            }
        }
        $ret = $objQuery->get($col, $table, $where, $arrVal);

        if ($ret != '') {
            return true;
        }
        return false;
    }

    /**
     * 情報新規登録.
     *
     * @param array $arrForm 情報
     * @return void
     */
    function lfInsert(&$arrForm) {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        // INSERTする値を作成する
        $sqlval['price_range_name'] = $arrForm['price_range_name'];
        $sqlval['price_range_lower'] = $arrForm['price_range_lower'];
        $sqlval['price_range_upper'] = $arrForm['price_range_upper'];
        $sqlval['rank'] = $objQuery->max('rank', 'plg_pricerangelistblock_price_range') + 1;
        $sqlval['creator_id'] = $_SESSION['member_id'];
        $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
        $sqlval['create_date'] = 'CURRENT_TIMESTAMP';

        $price_range_id= $objQuery->max('price_range_id', "plg_pricerangelistblock_price_range") + 1;
        $sqlval['price_range_id'] = $price_range_id;

        // INSERTの実行
        $objQuery->insert('plg_pricerangelistblock_price_range', $sqlval);
    }

    /**
     * 情報更新.
     *
     * @param array $arrForm 情報
     * @return void
     */
    function lfUpdate(&$arrForm) {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        // UPDATEする値を作成する
        $sqlval['price_range_name'] = $arrForm['price_range_name'];
        $sqlval['price_range_lower'] = $arrForm['price_range_lower'];
        $sqlval['price_range_upper'] = $arrForm['price_range_upper'];
        $sqlval['creator_id'] = $_SESSION['member_id'];
        $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
        $where = 'price_range_id = ?';

        // UPDATEの実行
        $objQuery->update('plg_pricerangelistblock_price_range', $sqlval, $where, array($arrForm['price_range_id']));
    }

    /**
     * 情報編集前処理.
     *
     * @param integer $price_range_id ID
     * @return array  結果
     */
    function lfPreEdit($price_range_id) {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        // 編集項目を取得する
        $where = 'price_range_id = ?';
        $arrPriceRage = array();
        $arrPriceRage = $objQuery->select('*', 'plg_pricerangelistblock_price_range', $where, array($price_range_id));

        return $arrPriceRage[0];
    }

    /**
     * 情報順番変更.
     *
     * @param  integer $price_range_id ID
     * @param  string  $mode up か down のモードを示す文字列
     * @return void
     */
    function lfRankChange($price_range_id, $mode) {
        $objDb = new SC_Helper_DB_Ex();

        switch ($mode) {
            case 'up':
                $objDb->sfRankUp('plg_pricerangelistblock_price_range', 'price_range_id', $price_range_id);
                break;

            case 'down':
                $objDb->sfRankDown('plg_pricerangelistblock_price_range', 'price_range_id', $price_range_id);
                break;

            default:
                break;
        }
    }

    /**
     * 情報削除.
     *
     * @param integer $price_range_id ID
     * @return void
     */
    function lfDelete($price_range_id) {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        // 物理削除
        $where = 'price_range_id = ?';
        $objQuery->delete('plg_pricerangelistblock_price_range', $where, array($price_range_id));
    }
}
?>
