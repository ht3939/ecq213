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

require_once CLASS_REALDIR . 'pages/admin/products/LC_Page_Admin_Products_Maker.php';

/**
 * メーカー管理 のページクラス(拡張).
 *
 * LC_Page_Admin_Products_Maker をカスタマイズする場合はこのクラスを編集する.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class LC_Page_Admin_Products_Maker_Ex extends LC_Page_Admin_Products_Maker
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
        $objMaker = new SC_Helper_Maker_Ex();
        $objFormParam = new SC_FormParam_Ex();

        // パラメーター情報の初期化
        $this->lfInitParam($objFormParam);

        // POST値をセット
        $objFormParam->setParam($_POST);

        // POST値の入力文字変換
        $objFormParam->convParam();

        //maker_idを変数にセット
        $maker_id = $objFormParam->getValue('maker_id');

        // アップロードファイル情報の初期化
        $objUpFile = new SC_UploadFile_Ex(IMAGE_TEMP_REALDIR, IMAGE_SAVE_REALDIR);
        $this->lfInitFile($objUpFile);
        $objUpFile->setHiddenFileList($_POST);

        $mode = $this->getMode();
        // モードによる処理切り替え
        switch ($mode) {
            // 編集処理
            case 'edit':
                // エラーチェック
                $this->arrErr = $this->lfCheckError($objFormParam, $objMaker);
                if (!SC_Utils_Ex::isBlank($this->arrErr['maker_id'])) {
                    trigger_error('', E_USER_ERROR);

                    return;
                }

                if (count($this->arrErr) <= 0) {
                    // POST値の引き継ぎ
                    $arrParam = $objFormParam->getHashArray();
                    // 登録実行
                    $res_maker_id = $this->doRegist($maker_id, $arrParam, $objMaker);
                    if ($res_maker_id !== FALSE) {
                        // 完了メッセージ
                        $this->tpl_onload = "alert('登録が完了しました。');";
                        SC_Response_Ex::reload();
                    } else {
                        $this->arrErr['maker_id'] = '登録に失敗しました。';
                    }
                }
                break;

            // 編集前処理
            case 'pre_edit':
                $maker = $objMaker->getMaker($maker_id);
                $objFormParam->setParam($maker);

                // POSTデータを引き継ぐ
                $this->tpl_maker_id = $maker_id;
                break;

            // メーカー順変更
            case 'up':
                $objMaker->rankUp($maker_id);

                // リロード
                SC_Response_Ex::reload();
                break;

            case 'down':
                $objMaker->rankDown($maker_id);

                // リロード
                SC_Response_Ex::reload();
                break;

            // 削除
            case 'delete':
                $objMaker->delete($maker_id);

                // リロード
                SC_Response_Ex::reload();
                break;
            // 画像のアップロード
            case 'upload_image':
            case 'delete_image':
                // パラメーター初期化
                $this->lfInitFormParam_UploadImage($objFormParam);
                $this->lfInitFormParam($objFormParam, $_POST);
                $arrForm = $objFormParam->getHashArray();

                switch ($mode) {
                    case 'upload_image':
                        // ファイルを一時ディレクトリにアップロード
                        $this->arrErr[$arrForm['image_key']] = $objUpFile->makeTempFile($arrForm['image_key'], IMAGE_RENAME);
                        if ($this->arrErr[$arrForm['image_key']] == '') {
                            // 縮小画像作成
                            $this->lfSetScaleImage($objUpFile, $arrForm['image_key']);
                        }
                        break;
                    case 'delete_image':
                        // ファイル削除
                        $this->lfDeleteTempFile($objUpFile, $arrForm['image_key']);
                        break;
                    default:
                        break;
                }

                // 入力画面表示設定
                $this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
                // ページonload時のJavaScript設定
                $anchor_hash = $this->getAnchorHash($arrForm['image_key']);
                $this->tpl_onload = $this->lfSetOnloadJavaScript_InputPage($anchor_hash);
                break;
            default:
                break;
        }

        $this->arrForm = $objFormParam->getFormParamList();

        // メーカー情報読み込み
        $this->arrMaker = $objMaker->getList();
    }    
    /**
     * パラメーター情報の初期化を行う.
     *
     * @param  SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    public function lfInitParam(&$objFormParam)
    {
        parent::lfInitParam($objFormParam);
        $objFormParam->addParam('画像参照URL1', 'mk_img_url1', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('画像参照URL2', 'mk_img_url2', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('サイトURL', 'mk_site_url', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('画像', 'mk_image', LLTEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
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
        $objUpFile->addFile('画像', 'mk_image', array('jpg', 'gif', 'png'), IMAGE_SIZE, false, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);

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
     * 縮小した画像をセットする
     *
     * @param  SC_UploadFile_Ex $objUpFile SC_UploadFileインスタンス
     * @param  string $image_key 画像ファイルキー
     * @return void
     */
    public function lfSetScaleImage(&$objUpFile, $image_key)
    {
        switch ($image_key) {
        case 'mk_image':
            // 詳細メイン画像
            $this->lfMakeScaleImage($objUpFile, $image_key, 'main_image');

        default:
            break;
        }
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
     * 縮小画像生成
     *
     * @param  object  $objUpFile SC_UploadFileインスタンス
     * @param  string  $from_key  元画像ファイルキー
     * @param  string  $to_key    縮小画像ファイルキー
     * @param  boolean $forced
     * @return void
     */
    public function lfMakeScaleImage(&$objUpFile, $from_key, $to_key, $forced = false)
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
                // リネームする際は、自動生成される画像名に一意となるように、Suffixを付ける
                $dst_file = $objUpFile->lfGetTmpImageName(IMAGE_RENAME, '', $objUpFile->temp_file[$arrImageKey[$from_key]]) . $this->lfGetAddSuffix($to_key);
                $path = $objUpFile->makeThumb($from_path, $to_w, $to_h, $dst_file);
                $objUpFile->temp_file[$arrImageKey[$to_key]] = basename($path);
            }
        }
    }
    /**
     * 入力エラーチェック.
     *
     * @param SC_FormParam $objFormParam
     * @return array $objErr->arrErr エラー内容
     */
    public function lfCheckError(&$objFormParam, SC_Helper_Maker_Ex &$objMaker)
    {
        $arrErr = parent::lfCheckError($objFormParam,$objMaker);


        return $arrErr;
    }
}
