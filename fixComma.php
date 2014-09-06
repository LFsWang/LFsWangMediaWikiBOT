<?php
require_once('lib/LFsWangBOT.php');

function FixComma( $page , $pid )
{
  if(!is_string($pid))
  {
    $pid=(string)$pid;
  }
  global $post;
  global $settings;
  $cont ='*';

  $json = getPageJson($page);
  $cont = $json->query->pages->$pid->revisions[0]->$cont;
  
  $count = 0;
  $cont = str_replace(',','，',$cont,$count);
  
  if( $count > 0 )
  {
    echo "[Fix Comma] Find $count half-comma in page $page($pid)\n";
    $rev = $post['edit_example'];
    $rev['title'] = $page;
    $rev['text' ] = $cont;
    $json = httpRequestJSON( $settings['wikiapi'] ,$rev );
    echo "Submit Change. Status: ".$json->edit->result."\n";
  }
  else
  {
    echo "[Fix Comma] No change ($page,$pid)\n";
  }
}

echo 'Edit Token:'.getEditTokne()."\n";


$json = httpRequestJSON($settings['wikiapi'],$post['allpage']);
echo "Function:Fix Comma\n";

foreach($json->query->allpages as $i)
{
  FixComma( $i->title , $i->pageid );
}

?>