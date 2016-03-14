<?php
    if (preg_match("|/admin/contents/plg_DIYCampaign[^.]*\.php$|", $_SERVER['PHP_SELF'])) {
        echo '<link rel="stylesheet" type="text/css" href="' . ROOT_URLPATH . 'plugin/DIYCampaign/media/diycampaign.css" media="all" />';
//      echo '<script type="text/javascript" src="' . ROOT_URLPATH . 'plugin/DIYCampaign/media/diycampaign.js"></script>';
    }
?>