<?php
require_once('lib/LFsWangBOT.php');

$defaultContent = '{{請注意：請在這行文字底下進行您的測試，請不要刪除或變更這行文字以及這行文字以上的部份。}}';

include_once( 'login.php' );
echo 'Edit Token:'.getEditTokne()."\n";

$rev = $post['edit_example'];
$rev['title'] = '竹園Wiki:沙盒';
$rev['text' ] = $defaultContent;

$json = httpRequestJSON( $settings['wikiapi'] ,$rev );
echo "[ClearSandBox] Status: ".$json->edit->result."\n";

?>