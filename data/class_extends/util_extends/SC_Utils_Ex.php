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

require_once CLASS_REALDIR . 'util/SC_Utils.php';

/**
 * 各種ユーティリティクラス(拡張).
 *
 * SC_Utils をカスタマイズする場合はこのクラスを使用する.
 *
 * @package Util
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class SC_Utils_Ex extends SC_Utils
{
    public static function sfGetRankClass($rank)
    {
        if ($rank ==1 or $rank ==2 or $rank ==3){
        	return "rank".$rank;
        }

       	return "rank4-more";
    }

    public static function sfGetColorClassArray($color)
    {
    	$context = array(
    		'red'=>'レッド'
    		,'black'=>'ブラック'
    		,'white'=>'ホワイト'
    		,'blue'=>'ブルー'
    		,'dark-cilver'=>'ダークシルバー'
    		);

    	$hoge=explode(",",$color);
    	$result = array();
    	foreach ($hoge as $key => $value) {
    		if(isset($context[$value])){
		    	$result[$value] = $context[$value];

    		}else{
		    	$result[$value] = "カラー不明";

    		}
    	}
    	return $result;
    }	    
}
