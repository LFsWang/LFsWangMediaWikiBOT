<?php
require_once('lib/LFsWangBOT.php');

$replace = array(
  ',' => '，',
  '?' => '？',
  '(' => '（',
  ')' => '）',
);

function FixComma( $page , $pid )
{
  if(!is_string($pid))
  {
    $pid=(string)$pid;
  }
  global $post;
  global $settings;
  global $replace;
  $cont ='*';
  $fixcont = '';
  
  $json = getPageJson($page);
  $cont = $json->query->pages->$pid->revisions[0]->$cont;
  
  if( strpos($cont,'<!--nosylveonbot-->') ){
    echo "[Fix Comma] Block Flag (nosylveonbot) match! $page($pid)\n";
    return ;
  }
  
  $inHtmlTag = 0;
  $count = 0;
  $strlen = mb_strlen( $cont , 'utf-8');

  for( $i=0 ; $i<$strlen ; $i++ )
  {
    //Maybe it will very slow
    $w = mb_substr($cont ,$i ,1, 'utf-8');
    if( $w === '<' || $w === '[' || $w === '{'){
      $inHtmlTag ++;
    }
    if( $w === '>' || $w === ']' || $w === '}'){
      $inHtmlTag --;
    }
    if( $inHtmlTag === 0 && isset( $replace[$w] ) ){
      //echo $w."=>".$replace[$w]."\n";
      $w = $replace[$w];
      $count++;
    }
    $fixcont .= $w;
  }

  if( $count > 0 )
  {
    echo "[Fix Comma] Find $count half-comma in page $page($pid)\n";
    $rev = $post['edit_example'];
    $rev['title'] = $page;
    $rev['text' ] = $fixcont;
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


//FixComma( '竹園Wiki:沙盒' , 369 );

foreach($json->query->allpages as $i)
{
  FixComma( $i->title , $i->pageid );
}

?>