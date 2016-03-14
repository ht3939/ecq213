<?php
/*
 * NakwebProductsClassImageUpload
 * Copyright (C) 2015 NAKWEB CO.,LTD. All Rights Reserved.
 * http://www.nakweb.com/
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

require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';

/**
 * プラグインのメインクラス
 *
 * @package NakwebProductsClassImageUpload
 * @author NAKWEB CO.,LTD.
 * @version $1.0 Id: $ProductsClassImageUpload01
 */
class LC_Page_Admin_Products_ProductsClassImage extends LC_Page_Admin_Ex
{
    /**
     * Page を初期化する.
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        $this->skip_load_page_layout = true;
        $this->tpl_mainpage = 'products/plg_nakwebproductsclassimageupload_upload.tpl';
        $this->tpl_subtitle = '商品規格画像アップローダー';

    }


    /**
     * Page のプロセス.
     *
     * @return void
     */
    public function process()
    {
        $this->action();
        $this->sendResponse();
    }


    /**
     * Page のアクション.
     *
     * @return void
     */
    public function action()
    {
        $objFormParam = new SC_FormParam_Ex();

        // アップロードファイル情報の初期化
        $objUpFile = new SC_UploadFile_Ex(IMAGE_TEMP_REALDIR, IMAGE_SAVE_REALDIR);
        $this->lfInitFile($objUpFile);
        $objUpFile->setHiddenFileList($_POST);

        // ダウンロード販売ファイル情報の初期化
        $objDownFile = new SC_UploadFile_Ex(DOWN_TEMP_REALDIR, DOWN_SAVE_REALDIR);
        $this->lfInitDownFile($objDownFile);
        $objDownFile->setHiddenFileList($_POST);

        switch ($this->getMode()) {
            //画像アップロード完了
            case 'comp':
                // パラメーター初期化, 取得
                $this->lfInitFormParam($objFormParam, $_POST, "");
                $arrForm = $objFormParam->getHashArray();
                // 表示用処理
                $this->arrForm = $this->lfSetViewParam_InputPage_Imagemanegement($objUpFile, $objDownFile, $arrForm, "", "");
                // 値の受け渡し用に$_SESSISONに値を入れる
                $this->lfInsertForSession($this->arrForm);
                $anchor_hash = $this->getAnchorHash($arrForm['image_key']);
                // 親ウィンドウの画像表示処理兼子ウィンドウ閉じ処理
                $this->lfReloadParentWindow($this->arrForm, $anchor_hash);
                break;

            // 画像のアップロード
            case 'upload_image':
            case 'delete_image':
                // パラメーター初期化
                $this->lfInitFormParam_UploadImage($objFormParam);
                $this->lfInitFormParam($objFormParam, $_POST, "");
                $arrForm = $objFormParam->getHashArray();

                switch ($this->getMode()) {
                    case 'upload_image':
                        // ファイルを一時ディレクトリにアップロード
                        $this->arrErr[$arrForm['image_key']] = $objUpFile->makeTempFile($arrForm['image_key'], IMAGE_RENAME);
                        if ($this->arrErr[$arrForm['image_key']] == '') {
                            // 縮小画像作成兼アップロードフラグ処理
                            $arrForm = $this->lfSetScaleImage($objUpFile, $arrForm);
                        }
                        break;

                    case 'delete_image':
                        // ファイル削除
                        $this->lfDeleteTempFile($objUpFile, $arrForm['image_key']);
                        break;
                    default:
                        break;
                }
                // 表示用処理
                $this->arrForm = $this->lfSetViewParam_InputPage_Imagemanegement($objUpFile, $objDownFile, $arrForm, $this->getMode(), $arrForm['image_key']);
                // ページonload時のJavaScript設定
                $anchor_hash = $this->getAnchorHash($arrForm['image_key']);
                $this->tpl_onload = $this->lfSetOnloadJavaScript_InputPage($anchor_hash);
                break;

            default:
                // パラメーター初期化, 取得
                $arrForm = array();
                $this->lfInitFormParam($objFormParam, $_POST, $_GET);
                $arrForm = $objFormParam->getHashArray();
                // 必要分を$_SESSIONから取得
                $arrForm = $this->lfGetSessionData($arrForm, $objUpFile);

                // 入力画面表示設定
                $this->arrForm = $this->lfSetViewParam_InputPage_Imagemanegement($objUpFile, $objDownFile, $arrForm, "", "");
                if($this->arrForm['productsclass-state'] != "") {    //GETメソッドで値を取得した時のみ
                    $productsclassStateBase = "";
                    $arrProductsclassState  = array();
                    $productsclassStateget  = array();

                    $productsclassStateBase = $this->arrForm['productsclass-state'];
                    $arrProductsclassState  = explode("-", $productsclassStateBase);
                    $this->arrForm['product_name']        = $this->getProductName($arrProductsclassState[0]);
                    $this->arrForm['product_id']          = $arrProductsclassState[0];
                    $this->arrForm['productsclass_name1'] = $this->getClasscategoryName($arrProductsclassState[1]);
                    $this->arrForm['productsclass_id1']   = $arrProductsclassState[1];
                    $this->arrForm['productsclass_name2'] = $this->getClasscategoryName($arrProductsclassState[2]);
                    $this->arrForm['productsclass_id2']   = $arrProductsclassState[2];
                }

               // 画像削除フラグの初期設定兼フラグ管理(1以外の数字が入っていたら全て0にする。)
               if(!(array_key_exists("main_list_image_flg", $this->arrForm))) {
                   $this->arrForm["main_list_image_flg"] = 0;
               }

               if(!(array_key_exists("main_image_flg", $this->arrForm))) {
                   $this->arrForm["main_image_flg"] = 0;
               }

               if(!(array_key_exists("main_large_image_flg", $this->arrForm))) {
                   $this->arrForm["main_large_image_flg"] = 0;
               }

                // ページonload時のJavaScript設定
                $this->tpl_onload = $this->lfSetOnloadJavaScript_InputPage();
                break;
        }
        $this->setTemplate($this->tpl_mainpage);
    }


    /**
     * パラメーター情報の初期化を行う.
     *
     * @param  SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    public function lfInitFormParam(&$objFormParam, $arrPost, $Get)
    {
        $objFormParam->addParam('商品規格情報', 'productsclass-state', INT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('商品名', 'product_name', MTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('商品ID', 'product_id', MTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('規格名１', 'productsclass_name1', MTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('規格ID１', 'productsclass_id1', MTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('規格名２', 'productsclass_name2', MTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('規格ID２', 'productsclass_id2', MTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('一覧メインアップロードフラグ', 'main_list_image_flg', STEXT_LEN, 'n', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('詳細メインアップロードフラグ', 'main_image_flg', STEXT_LEN, 'n', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('詳細拡大アップロードフラグ', 'main_large_image_flg', STEXT_LEN, 'n', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('temp_main_image', 'temp_main_image', '', '', array());
        $objFormParam->addParam('temp_main_large_image', 'temp_main_large_image', '', '', array());
        $objFormParam->addParam('save_main_list_image', 'save_main_list_image', '', '', array());
        $objFormParam->addParam('save_main_image', 'save_main_image', '', '', array());
        $objFormParam->addParam('save_main_large_image', 'save_main_large_image', '', '', array());
        $objFormParam->addParam('temp_main_list_image', 'temp_main_list_image', '', '', array());
        $objFormParam->addParam('temp_main_image', 'temp_main_image', '', '', array());
        $objFormParam->addParam('temp_main_large_image', 'temp_main_large_image', '', '', array());

        $objFormParam->setParam($arrPost);
        $objFormParam->setParam($Get);
        $objFormParam->convParam();
    }


    /**
     * パラメーター情報の初期化
     * - 画像ファイルアップロードモード
     *
     * @param  SC_FormParam_Ex $objFormParam SC_FormParamインスタンス
     * @return void
     */
    public function lfInitFormParam_UploadImage(&$objFormParam)
    {
        $objFormParam->addParam('image_key', 'image_key', '', '', array());
    }


    /**
     * アップロードファイルパラメーター情報の初期化
     * - 画像ファイル用
     *
     * @param  SC_UploadFile_Ex $objUpFile SC_UploadFileインスタンス
     * @return void
     */
    public function lfInitFile(&$objUpFile)
    {
        $objUpFile->addFile('一覧-メイン画像', 'main_list_image', array('jpg', 'gif', 'png'), IMAGE_SIZE, false, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
        $objUpFile->addFile('詳細-メイン画像', 'main_image', array('jpg', 'gif', 'png'), IMAGE_SIZE, false, NORMAL_IMAGE_WIDTH, NORMAL_IMAGE_HEIGHT);
        $objUpFile->addFile('詳細-メイン拡大画像', 'main_large_image', array('jpg', 'gif', 'png'), IMAGE_SIZE, false, LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT);
    }


    /**
     * アップロードファイルパラメーター情報の初期化
     * - ダウンロード商品ファイル用
     *
     * @param  SC_UploadFile_Ex $objDownFile SC_UploadFileインスタンス
     * @return void
     */
    public function lfInitDownFile(&$objDownFile)
    {
        $objDownFile->addFile('ダウンロード販売用ファイル', 'down_file', explode(',', DOWNLOAD_EXTENSION), DOWN_SIZE, true, 0, 0);
    }


    /**
     * 商品名を取得する.
     *
     * @access private
     * @param  integer $product_id 商品ID
     * @return string  商品名の文字列
     */
    public function getProductName($product_id)
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        return $objQuery->get('name', 'dtb_products', 'product_id = ?', array($product_id));
    }


    /**
     * 規格名を取得する.
     *
     * @access private
     * @param  integer $classcategory_id 商品ID
     * @return array   規格名の配列
     */
    public function getClasscategoryName($classcategory_id)
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        return $objQuery->get('name', 'dtb_classcategory', 'classcategory_id = ?', array($classcategory_id));
    }


    /**
     * 縮小した画像をセットする
     * 画像のアップロードフラグをセットする。
     *
     * @param  SC_UploadFile_Ex $objUpFile SC_UploadFileインスタンス
     * @param  string $arrForm フォーム入力パラメーター配列
     * @return array  $arrForm フォーム入力パラメーター配列
     */
    public function lfSetScaleImage(&$objUpFile, &$arrForm)
    {
        // 詳細-メイン画像のみ処理が被るため、フラグにて管理
        $main_image_uploaded = false;

        switch ($arrForm['image_key']) {
            case 'main_large_image':
                // 詳細-拡大画像アップロードフラグ
                $arrForm["main_large_image_flg"] = 1;
                // 詳細メイン画像へのリサイズとアップロードフラグ設定
                $arrForm["main_image_flg"] = $this->lfMakeScaleImage($objUpFile, $arrForm['image_key'], 'main_image', $arrForm["main_image_flg"]);

                // リサイズ後の処理とし、次のcaseにて処理をしないようにする。
                $main_image_uploaded = true;

            case 'main_image':
                // フラグにより上記からの流れなのか詳細ｰメイン画像を上げたのかを分岐。
                if($main_image_uploaded == false) {
                    // 詳細-メイン画像アップロードフラグ
                    $arrForm["main_image_flg"] = 1;
                }

                // 一覧メイン画像
                $arrForm["main_list_image_flg"] = $this->lfMakeScaleImage($objUpFile, $arrForm['image_key'], 'main_list_image', $arrForm["main_list_image_flg"]);

            case 'main_list_image';
                // 一覧ｰメイン画像はリサイズは無いがアップロードフラグの管理処理のみ必要。
                $arrForm["main_list_image_flg"] = 1;
                break;
            default:
                break;
        }
        return $arrForm;
    }


    /**
     * 縮小画像生成
     *
     * @param  object  $objUpFile SC_UploadFileインスタンス
     * @param  string  $from_key  元画像ファイルキー
     * @param  string  $to_key    縮小画像ファイルキー
     * @param  boolean $forced
     * @return array   $arrForm   フォーム入力パラメーター配列
     */
    public function lfMakeScaleImage(&$objUpFile, $from_key, $to_key, $base_flg, $forced = false)
    {
        $arrImageKey = array_flip($objUpFile->keyname);
        $from_path = '';

        if ($objUpFile->temp_file[$arrImageKey[$from_key]]) {
            $from_path = $objUpFile->temp_dir . $objUpFile->temp_file[$arrImageKey[$from_key]];
        } elseif ($objUpFile->save_file[$arrImageKey[$from_key]]) {
            $from_path = $objUpFile->save_dir . $objUpFile->save_file[$arrImageKey[$from_key]];
        }

        if (file_exists($from_path)) {
            // 生成先の画像サイズを取得
            $to_w = $objUpFile->width[$arrImageKey[$to_key]];
            $to_h = $objUpFile->height[$arrImageKey[$to_key]];

            if ($forced) {
                $objUpFile->save_file[$arrImageKey[$to_key]] = '';
            }
            if (empty($objUpFile->temp_file[$arrImageKey[$to_key]])
                && empty($objUpFile->save_file[$arrImageKey[$to_key]])
            ) {
            // リサイズ先のアップロードフラグ
            $arrForm[$to_key. "_flg"] = 1;
                // リネームする際は、自動生成される画像名に一意となるように、Suffixを付ける
                $dst_file = $objUpFile->lfGetTmpImageName(IMAGE_RENAME, '', $objUpFile->temp_file[$arrImageKey[$from_key]]) . $this->lfGetAddSuffix($to_key);
                $path = $objUpFile->makeThumb($from_path, $to_w, $to_h, $dst_file);
                $objUpFile->temp_file[$arrImageKey[$to_key]] = basename($path);
            } else {
                if($base_flg != 1) {
                    // リサイズ先の非アップロードフラグ
                    $arrForm[$to_key. "_flg"] = 0;
                } else {
                    $arrForm[$to_key. "_flg"] = 1;
                }
            }
        }
        return $arrForm[$to_key. "_flg"];
    }


    /**
     * リネームする際は、自動生成される画像名に一意となるように、Suffixを付ける
     *
     * @param  string $to_key
     * @return string
     */
    public function lfGetAddSuffix($to_key)
    {
        if ( IMAGE_RENAME === true) return;

        // 自動生成される画像名
        $dist_name = '';
        switch ($to_key) {
        case 'main_list_image':
            $dist_name = '_s';
            break;
        case 'main_image':
            $dist_name = '_m';
            break;
        default:
            $arrRet = explode('sub_image', $to_key);
            $dist_name = '_sub' .$arrRet[1];
            break;
        }
        return $dist_name;
    }


    /**
     * アップロードファイルパラメーター情報から削除
     * 一時ディレクトリに保存されている実ファイルも削除する
     *
     * @param  SC_UploadFile_Ex $objUpFile SC_UploadFileインスタンス
     * @param  string $image_key 画像ファイルキー
     * @return void
     */
    public function lfDeleteTempFile(&$objUpFile, $image_key)
    {
        // TODO: SC_UploadFile::deleteFileの画像削除条件見直し要
        $arrTempFile = $objUpFile->temp_file;
        $arrKeyName = $objUpFile->keyname;

        foreach ($arrKeyName as $key => $keyname) {
            if ($keyname != $image_key) continue;

            if (!empty($arrTempFile[$key])) {
                $temp_file = $arrTempFile[$key];
                $arrTempFile[$key] = '';

                if (!in_array($temp_file, $arrTempFile)) {
                    $objUpFile->deleteFile($image_key);
                } else {
                    $objUpFile->temp_file[$key] = '';
                    $objUpFile->save_file[$key] = '';
                }
            } else {
                $objUpFile->temp_file[$key] = '';
                $objUpFile->save_file[$key] = '';
            }
        }
    }


    /**
     * 表示用フォームパラメーター取得
     * - 入力画面
     *
     * @param  SC_UploadFile_Ex $objUpFile   SC_UploadFileインスタンス
     * @param  array  $arrForm     フォーム入力パラメーター配列
     * @return array  表示用フォームパラメーター配列
     */
    public function lfSetViewParam_InputPage_Imagemanegement(&$objUpFile, &$objDownFile, &$arrForm, $mode, $image_key)
    {
        $arrNewForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);

        if($mode =='upload_image') {
            // 画像アップロードか保存された画像のデータかの判別
            if(array_key_exists('temp_main_list_image', $arrNewForm['arrHidden'])) {
                $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image_path']  = 'temp';
                $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image_flg']  = '';
            } else {
                if(array_key_exists('save_main_list_image', $arrNewForm['arrHidden'])) {
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image_path']  = 'save';
                } else {
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image_path']  = '';
                }
            }

            if(array_key_exists('temp_main_image', $arrNewForm['arrHidden'])) {
                $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image_path'] = 'temp';
                $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image_flg'] = '';
            } else {
                if(array_key_exists('save_main_image', $arrNewForm['arrHidden'])) {
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image_path']       = 'save';
                } else {
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image_path']       = '';
                }
            }

            if(array_key_exists('temp_main_large_image', $arrNewForm['arrHidden'])) {
                $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image_path'] = 'temp';
                $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image_flg']  = '';
            } else {
                if(array_key_exists('save_main_large_image', $arrNewForm['arrHidden'])) {
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image_path'] = 'save';
                } else {
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image_path'] = '';
                }
            }
        } else if($mode =='delete_image') {
            // 削除フラグの処理
            switch ($image_key) {
                case 'main_list_image':
                    $arrNewForm["main_list_image_flg"] = 2;
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image_flg']  = 'del';
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image_del']  = $arrNewForm["save_main_list_image"];
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image_path']  = 'temp';
                    break;

                case 'main_image':
                    $arrNewForm["main_image_flg"] = 2;
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image_flg']  = 'del';
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image_del']  = $arrNewForm["save_main_image"];
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image_path']       = 'temp';
                    break;

                case 'main_large_image':
                    $arrNewForm["main_large_image_flg"] = 2;
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image_flg']  = 'del';
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image_del']  = $arrNewForm["save_main_large_image"];
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image_path'] = 'temp';
                    break;

                default:
                    break;
            }
        }
        return $arrNewForm;
    }


    /**
     * 表示用フォームパラメーター取得
     * - 入力画面
     *
     * @param  SC_UploadFile_Ex $objUpFile   SC_UploadFileインスタンス
     * @param  array  $arrForm     フォーム入力パラメーター配列
     * @return array  表示用フォームパラメーター配列
     */
    public function lfSetViewParam_InputPage(&$objUpFile, &$objDownFile, &$arrForm)
    {
        // アップロードファイル情報取得(Hidden用)
        $arrHidden = $objUpFile->getHiddenFileList();
        $arrForm['arrHidden'] = array_merge((array) $arrHidden, (array) $objDownFile->getHiddenFileList());

        // 画像ファイル表示用データ取得
        $arrForm['arrFile'] = $objUpFile->getFormFileList(IMAGE_TEMP_URLPATH, IMAGE_SAVE_URLPATH);

        return $arrForm;
    }


    /**
     * アンカーハッシュ文字列を取得する
     * アンカーキーをサニタイジングする
     *
     * @param  string $anchor_key フォーム入力パラメーターで受け取ったアンカーキー
     * @return <type>
     */
    public function getAnchorHash($anchor_key)
    {
        if ($anchor_key != '') {
            return "location.hash='#" . htmlspecialchars($anchor_key) . "'";
        } else {
            return '';
        }
    }


    /**
     * ページonload用JavaScriptを取得する
     * - 入力画面
     *
     * @param  string $anchor_hash アンカー用ハッシュ文字列(省略可)
     * @return string ページonload用JavaScript
     */
    public function lfSetOnloadJavaScript_InputPage($anchor_hash = '')
    {
        return "eccube.checkStockLimit('" . DISABLED_RGB . "');fnInitSelect('category_id_unselect'); fnMoveSelect('category_id_unselect', 'category_id');" . $anchor_hash;
    }


    /**
     * $_SESSIONに値を格納し、ページ間の受け渡しの準備を行う。
     *
     * @param  string $anchor_key フォーム入力パラメーターで受け取ったアンカーキー
     * @return void
     */
    public function lfInsertForSession($arrForm)
    {
        if(!(array_key_exists('plg_NakwebProductsClassImageUpload', $_SESSION))) {
            $_SESSION['plg_NakwebProductsClassImageUpload'] = array();
        }

        $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image']  = $arrForm['arrHidden']['temp_main_list_image'];
        if($_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image_flg']  == 'del' ) {
            $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['save_main_list_image']  = $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image_del'];
            unset($_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image_flg']);
            unset($_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_list_image_del']);
        } else {
            $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['save_main_list_image']  = $arrForm['arrHidden']['save_main_list_image'];
        }

        $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image']       = $arrForm['arrHidden']['temp_main_image'];
        if($_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image_flg']  == 'del') {
            $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['save_main_image']  = $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image_del'];
            unset($_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image_flg']);
            unset($_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_image_del']);
        } else {
            $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['save_main_image']       = $arrForm['arrHidden']['save_main_image'];
        }

        $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image'] = $arrForm['arrHidden']['temp_main_large_image'];
        if($_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image_flg']  == 'del') {
            $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['save_main_large_image']  = $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image_del'];
            unset($_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image_flg']);
            unset($_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['temp_main_large_image_del']);
        } else {
            $_SESSION['plg_NakwebProductsClassImageUpload'][$arrForm['product_id']][$arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2']]['save_main_large_image'] = $arrForm['arrHidden']['save_main_large_image'];
        }

        return;
    }


    /**
     * 親ウィンドウを更新し、このウィンドウを閉じる
     *
     * @return void
     */
    public function lfReloadParentWindow($arrForm, $anchor_key)
    {
        // 親ウィンドウ定義
        $this->tpl_onload  = "var pwin=window.opener;";

        // 一覧-メイン画像の書き換えと元からの表示画像の非表示化
        $selector_main_list_image = 'temp_main_list_image'. $arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2'];
        if($arrForm['main_list_image_flg'] == 1) {    // アップロード時の処理
            // 一覧-メイン画像のパスを指定
            $path_main_list_image = "\"". $arrForm['arrFile']['main_list_image']['filepath']. "\"";

            // 一覧ｰメイン画像のパスをjQuery内に読み込み
            $this->tpl_onload .= "var path_main_list_image=". $path_main_list_image. ";";

            // imgタグの属性を書き換え
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_list_image. "\").children('img').attr({'src':path_main_list_image});";
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_list_image. "\").children('img').attr({'alt':\"main_list_image\"});";

            // アップロードされた画像を表示し、元からあった画像を非表示化
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_list_image. "\").children('img').show();";
            $this->tpl_onload .= "pwin.$(\"img.". $selector_main_list_image. "\").hide();";

            // 親ウィンドウにて一覧ｰメイン画像の読み込みが完了した場合、次の処理に移行
            $this->tpl_onload .= "var pwin_main_list_image=pwin.$(\"div.". $selector_main_list_image. "\").children('img');";
            $this->tpl_onload .= "$(pwin_main_list_image).bind('load', function(){";
        } else if($arrForm['main_list_image_flg'] == 2) {    // 画像を削除時の処理
            //元のからあった画像を非表示化
            $this->tpl_onload .= "pwin.$(\"img.". $selector_main_list_image. "\").hide();";

            // srcが存在していれば要素を削除
            $this->tpl_onload .= "if(typeof pwin.$(\"div.". $selector_main_list_image. "\").children('img').attr('src') != 'undefined') {";
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_list_image. "\").children('img').removeAttr('src');";
            $this->tpl_onload .= "}";
            // altが存在していれば要素を削除
            $this->tpl_onload .= "if(typeof pwin.$(\"div.". $selector_main_list_image. "\").children('img').attr('alt') != 'undefined') {";
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_list_image. "\").children('img').removeAttr('alt');";
            $this->tpl_onload .= "}";
            // アップロードされていた画像を非表示化
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_list_image. "\").children('img').hide();";
        }

        // 詳細-メイン画像の書き換えと元からの表示画像の非表示化
        $selector_main_image = 'temp_main_image'. $arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2'];
        if($arrForm['main_image_flg'] == 1) {    // アップロード時の処理
            // 詳細-メイン画像のパスを指定
            $path_main_image = "\"". $arrForm['arrFile']['main_image']['filepath']. "\"";

            // 詳細ｰメイン画像のパスをjQuery内に読み込み
            $this->tpl_onload .= "var path_main_image=". $path_main_image. ";"; 

            // imgタグの属性を書き換え
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_image. "\").children('img').attr({'src':path_main_image});";
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_image. "\").children('img').attr({'alt':\"main_image\"});";

            // アップロードされた画像を表示し、元からあった画像を非表示化(サイズは一覧ｰメイン画像に指定)
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_image. "\").children('img').width(". SMALL_IMAGE_WIDTH. ");";
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_image. "\").children('img').show();";
            $this->tpl_onload .= "pwin.$(\"img.". $selector_main_image. "\").hide();";
            // 親ウィンドウにて詳細ｰメイン画像の読み込みが完了した場合、次の処理に移行
            $this->tpl_onload .= "var pwin_main_image=pwin.$(\"div.". $selector_main_image. "\").children('img');";
            $this->tpl_onload .= "$(pwin_main_image).bind('load', function(){";
        } else if($arrForm['main_image_flg'] == 2) {    // 画像を削除時の処理
            //元のからあった画像を非表示化
            $this->tpl_onload .= "pwin.$(\"img.". $selector_main_image. "\").hide();";

            // srcが存在していれば要素を削除
            $this->tpl_onload .= "if(typeof pwin.$(\"div.". $selector_main_image. "\").children('img').attr('src') != 'undefined') {";
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_image. "\").children('img').removeAttr('src');";
            $this->tpl_onload .= "}";
            // altが存在していれば要素を削除
            $this->tpl_onload .= "if(typeof pwin.$(\"div.". $selector_main_image. "\").children('img').attr('alt') != 'undefined') {";
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_image. "\").children('img').removeAttr('alt');";
            $this->tpl_onload .= "}";
            // アップロードされていた画像を非表示化
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_image. "\").children('img').hide();";
        }

        // 詳細-拡大画像の書き換えと元からの表示画像の非表示化
        $selector_main_large_image = 'temp_main_large_image'. $arrForm['productsclass_id1']. '-'. $arrForm['productsclass_id2'];
        if($arrForm['main_large_image_flg'] == 1) {    // アップロード時の処理
            // 詳細-拡大画像のパスを指定
            $path_main_large_image = "\"". $arrForm['arrFile']['main_large_image']['filepath']. "\"";

            // 詳細ｰ拡大画像のパスをjQuery内に読み込み
            $this->tpl_onload .= "var path_main_large_image=". $path_main_large_image. ";";

            // imgタグの属性を書き換え
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_large_image. "\").children('img').attr({'src':path_main_large_image});";
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_large_image. "\").children('img').attr({'alt':\"main_large_image\"});";

            // アップロードされた画像を表示し、元からあった画像を非表示化(サイズは一覧ｰメイン画像に指定)
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_large_image. "\").children('img').width(". SMALL_IMAGE_WIDTH. ");";
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_large_image. "\").children('img').show();";
            $this->tpl_onload .= "pwin.$(\"img.". $selector_main_large_image. "\").hide();";
            // 親ウィンドウの詳細-拡大画像の読み込みが完了した場合、次の処理に移行
            $this->tpl_onload .= "var pwin_main_large_image=pwin.$(\"div.". $selector_main_large_image. "\").children('img');";
            $this->tpl_onload .= "$(pwin_main_large_image).bind('load', function(){";
        } else if($arrForm['main_large_image_flg'] == 2) {    // 画像を削除時の処理
            //元のからあった画像を非表示化
            $this->tpl_onload .= "pwin.$(\"img.". $selector_main_large_image. "\").hide();";

            // srcが存在していれば要素を削除
            $this->tpl_onload .= "if(typeof pwin.$(\"div.". $selector_main_large_image. "\").children('img').attr('src') != 'undefined') {";
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_large_image. "\").children('img').removeAttr('src');";
            $this->tpl_onload .= "}";
            // altが存在していれば要素を削除
            $this->tpl_onload .= "if(typeof pwin.$(\"div.". $selector_main_large_image. "\").children('img').attr('alt') != 'undefined') {";
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_large_image. "\").children('img').removeAttr('alt');";
            $this->tpl_onload .= "}";
            // アップロードされていた画像を非表示化
            $this->tpl_onload .= "pwin.$(\"div.". $selector_main_large_image. "\").children('img').hide();";
        }


        // アップロードされた全ての画像が表示されたら子ウィンドウを閉じる。
        $this->tpl_onload .= "window.close();";
        if($arrForm['main_large_image_flg'] == 1) {
            $this->tpl_onload .= "});";
        }
        if($arrForm['main_image_flg'] == 1) {
            $this->tpl_onload .= "});";
        }
        if($arrForm['main_list_image_flg'] == 1) {
            $this->tpl_onload .= "});";
        }
    }


    /**
     * 対応する$_SESSIONのデータを受け取る
     *
     * @return void
     */
    public function lfGetSessionData(&$arrForm, &$objUpFile)
    {
        $productClassInfo     = array();
        if($arrForm['productsclass-state'] != "") {    //$_GETメソッドでの取得時、つまり他ページからの遷移時
            $productClassInfoBase = array();
            $productClassInfoBase = explode("-", $arrForm['productsclass-state']);
            $productClassInfo['product_id']                          = $productClassInfoBase[0];
            $productClassInfo['productsclass_id1-productsclass_id2'] = $productClassInfoBase[1]. "-". $productClassInfoBase[2];
        } else {
            $productClassInfo['product_id']                          = $arrForm['product_id'];
            $productClassInfo['productsclass_id1-productsclass_id2'] = $arrForm['productsclass_id1']. "-". $arrForm['productsclass_id2'];
        }

        // セッションデータにこのプラグインの設定した配列が含まれている場合のみ処理
        if(array_key_exists('plg_NakwebProductsClassImageUpload', $_SESSION) && array_key_exists($productClassInfo['product_id'], $_SESSION['plg_NakwebProductsClassImageUpload']) && 
           array_key_exists($productClassInfo['productsclass_id1-productsclass_id2'], $_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']])) {
            // 一覧-メイン画像用の処理
            if($_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['temp_main_list_image_path'] == "temp") {
                $arrForm['temp_main_list_image']  = $_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['temp_main_list_image'];
            } else if($_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['temp_main_list_image_path'] == "save") {
                $arrForm['save_main_list_image']  = $_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['save_main_list_image'];
            }

            // 詳細-メイン画像用の処理
            if($_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['temp_main_image_path'] == "temp") {
                $arrForm['temp_main_image']       = $_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['temp_main_image'];
            } else if($_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['temp_main_image_path'] == "save") {
                $arrForm['save_main_image']       = $_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['save_main_image'];
            }

            // 詳細ｰ拡大画像用の処理
            if($_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['temp_main_large_image_path'] == "temp") {
                $arrForm['temp_main_large_image'] = $_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['temp_main_large_image'];
            } else if($_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['temp_main_large_image_path'] == "save") {
                $arrForm['save_main_large_image'] = $_SESSION['plg_NakwebProductsClassImageUpload'][$productClassInfo['product_id']][$productClassInfo['productsclass_id1-productsclass_id2']]['save_main_large_image'];
            }

            $objUpFile->setHiddenFileList($arrForm);
        }
        return $arrForm;
    }
}
