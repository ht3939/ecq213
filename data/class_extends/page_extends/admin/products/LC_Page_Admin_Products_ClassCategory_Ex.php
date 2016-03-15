<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2014 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

require_once CLASS_REALDIR . 'pages/admin/products/LC_Page_Admin_Products_ClassCategory.php';

/**
 * 規格分類 のページクラス(拡張).
 *
 * LC_Page_Admin_Products_ClassCategory をカスタマイズする場合はこのクラスを編集する.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class LC_Page_Admin_Products_ClassCategory_Ex extends LC_Page_Admin_Products_ClassCategory
{
    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init()
    {
        parent::init();
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process()
    {
        parent::process();
    }


    /**
     * Page のアクション.
     *
     * @return void
     */
    public function action()
    {
        $objFormParam = new SC_FormParam_Ex();

        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_REQUEST);
        $objFormParam->convParam();
        $class_id = $objFormParam->getValue('class_id');
        $classcategory_id = $objFormParam->getValue('classcategory_id');

        switch ($this->getMode()) {
            // 登録ボタン押下
            // 新規作成 or 編集
            case 'edit':
                // パラメーター値の取得
                $this->arrForm = $objFormParam->getHashArray();
                // 入力パラメーターチェック
                $this->arrErr = $this->lfCheckError($objFormParam);
                if (SC_Utils_Ex::isBlank($this->arrErr)) {
                    //新規規格追加かどうかを判定する
                    $is_insert = $this->lfCheckInsert($classcategory_id);
                    if ($is_insert) {
                        //新規追加
                        $this->lfInsertClass($this->arrForm);
                    } else {
                        //更新
                        $this->lfUpdateClass($this->arrForm);
                    }

                    // 再表示
                    SC_Response_Ex::reload();
                }
                break;
                // 削除
            case 'delete':
                // ランク付きレコードの削除
                $this->lfDeleteClassCat($class_id, $classcategory_id);

                SC_Response_Ex::reload();
                break;
                // 編集前処理
            case 'pre_edit':
                // 規格名を取得する。
                $classcategory_name = $this->lfGetClassCatName($classcategory_id);
                $cc = $this->lfGetClassCatArr($classcategory_id);
                $objFormParam->setParam($cc);

                // 入力項目にカテゴリ名を入力する。
                //$this->arrForm['name'] = $classcategory_name;
                break;
            case 'down':
                //並び順を下げる
                $this->lfDownRank($class_id, $classcategory_id);

                SC_Response_Ex::reload();
                break;
            case 'up':
                //並び順を上げる
                $this->lfUpRank($class_id, $classcategory_id);

                SC_Response_Ex::reload();
                break;
            default:
                break;
        }
        $this->arrForm = $objFormParam->getFormParamList();

        //規格分類名の取得
        $this->tpl_class_name = $this->lfGetClassName($class_id);
        //規格分類情報の取得
        $this->arrClassCat = $this->lfGetClassCat($class_id);
        // POSTデータを引き継ぐ
        $this->tpl_classcategory_id = $classcategory_id;
    }

    /**
     * パラメーターの初期化を行う.
     *
     * @param  SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    public function lfInitParam(&$objFormParam)
    {
        parent::lfInitParam($objFormParam);
        $objFormParam->addParam('発売日', 'cc_release_date', STEXT_LEN, 'KVa', array('SPTAB_CHECK' ,'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('画像参照URL1', 'cc_img_url1', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('画像参照URL2', 'cc_img_url2', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('画像参照URL3', 'cc_img_url3', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('画像参照URL4', 'cc_img_url4', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('画像参照URL5', 'cc_img_url5', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('画像参照URL6', 'cc_img_url6', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('画像参照URL7', 'cc_img_url7', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('画像参照URL8', 'cc_img_url8', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('サイトURL', 'cc_site_url', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('画像', 'cc_image', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('発売日', 'cc_release_date', STEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('端末タイプ', 'cc_type', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ブランド', 'cc_brand', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('カラー', 'cc_color', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
    }
    /**
     * 有効な規格分類情報の取得
     *
     * @param  integer $classcategory_id 規格分類ID
     * @return array   規格分類情報
     */
    public function lfGetClassCatArr($classcategory_id)
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        $where = 'del_flg <> 1 AND classcategory_id = ?';
        $objQuery->setOrder('rank DESC'); // XXX 降順
        $arrClassCat = $objQuery->select('*', 'dtb_classcategory', $where, array($classcategory_id));

        return $arrClassCat[0];
    }    
    /**
     * 有効な規格分類情報の取得
     *
     * @param  integer $class_id 規格ID
     * @return array   規格分類情報
     */
    public function lfGetClassCat($class_id)
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        $where = 'del_flg <> 1 AND class_id = ?';
        $objQuery->setOrder('rank DESC'); // XXX 降順
        $arrClassCat = $objQuery->select('*', 'dtb_classcategory', $where, array($class_id));

        return $arrClassCat;
    }
    /**
     * 規格分類情報を新規登録
     *
     * @param  array   $arrForm フォームパラメータークラス
     * @return integer 更新件数
     */
    public function lfInsertClass($arrForm)
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objQuery->begin();
        // 親規格IDの存在チェック
        $where = 'del_flg <> 1 AND class_id = ?';
        $class_id = $objQuery->get('class_id', 'dtb_class', $where, array($arrForm['class_id']));
        if (!SC_Utils_Ex::isBlank($class_id)) {
            // INSERTする値を作成する。
            $sqlval['name'] = $arrForm['name'];

            for ($i=1; $i < 9; $i++) { 
                # code...
                $sqlval['cc_img_url'.$i] = $arrForm['cc_img_url'.$i];
            }
            $sqlval['cc_image'] = $arrForm['cc_image'];
            $sqlval['cc_site_url'] = $arrForm['cc_site_url'];
            $sqlval['cc_release_date'] = $arrForm['cc_release_date'];
            $sqlval['cc_type'] = $arrForm['cc_type'];
            $sqlval['cc_brand'] = $arrForm['cc_brand'];
            $sqlval['cc_color'] = $arrForm['cc_color'];

            $sqlval['class_id'] = $arrForm['class_id'];
            $sqlval['creator_id'] = $_SESSION['member_id'];
            $sqlval['rank'] = $objQuery->max('rank', 'dtb_classcategory', $where, array($arrForm['class_id'])) + 1;
            $sqlval['create_date'] = 'CURRENT_TIMESTAMP';
            $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
            // INSERTの実行
            $sqlval['classcategory_id'] = $objQuery->nextVal('dtb_classcategory_classcategory_id');
            $ret = $objQuery->insert('dtb_classcategory', $sqlval);
        }
        $objQuery->commit();

        return $ret;
    }

    /**
     * 規格分類情報を更新
     *
     * @param  array   $arrForm フォームパラメータークラス
     * @return integer 更新件数
     */
    public function lfUpdateClass($arrForm)
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        // UPDATEする値を作成する。
        $sqlval['name'] = $arrForm['name'];

        for ($i=1; $i < 9; $i++) { 
            # code...
            $sqlval['cc_img_url'.$i] = $arrForm['cc_img_url'.$i];
        }
        $sqlval['cc_image'] = $arrForm['cc_image'];
        $sqlval['cc_site_url'] = $arrForm['cc_site_url'];
        $sqlval['cc_release_date'] = $arrForm['cc_release_date'];
        $sqlval['cc_type'] = $arrForm['cc_type'];
        $sqlval['cc_brand'] = $arrForm['cc_brand'];
        $sqlval['cc_color'] = $arrForm['cc_color'];


        $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
        $where = 'classcategory_id = ?';
        // UPDATEの実行
        $ret = $objQuery->update('dtb_classcategory', $sqlval, $where, array($arrForm['classcategory_id']));

        return $ret;
    }    
}
