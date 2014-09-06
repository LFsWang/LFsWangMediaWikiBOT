<?php
require_once('lib/LFsWangBOT.php');
$re = httpRequestJSON($settings['wikiapi'],$post['logout']);
var_dump($re);
?>