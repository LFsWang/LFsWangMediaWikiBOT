<?php
function getEditTokne()
{
  	global $post;
  	global $settings;
  
  	$json = httpRequestJSON($settings['wikiroot'].'/api.php',$post['edittoken']);
	$post['edit_example']['token'] = $json->tokens->edittoken;
  	return $post['edit_example']['token'];
}

function getPageJson( $pagename )
{
  global $post;
  global $settings;
  
  $post['getpage']['titles'] = $pagename;
  return httpRequestJSON( $settings['wikiapi'] , $post['getpage'] );
}
function submit( $pagename , $arg = array() )
{
}
?>