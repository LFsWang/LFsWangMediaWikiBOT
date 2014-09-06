<?php
#httpRequest
#向WIKI 發送POST請求
function httpRequest( $url , $post = null )
{
  global $settings;
 
  if( is_array($post) )
  {
    ksort( $post );
    $post = http_build_query( $post );
  }
  
  $ch = curl_init();
  curl_setopt( $ch , CURLOPT_URL , $url );
  curl_setopt( $ch , CURLOPT_ENCODING, "UTF-8" );
  curl_setopt( $ch , CURLOPT_POST, true );
  curl_setopt( $ch , CURLOPT_POSTFIELDS , $post );
  curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );
  curl_setopt ($ch , CURLOPT_COOKIEFILE, $settings['cookiefile']);
  curl_setopt ($ch , CURLOPT_COOKIEJAR , $settings['cookiefile']);

  $data = curl_exec($ch);
  curl_close($ch);
  if(!$data)
  {
    return false;
  }
  return $data;
}

function httpRequestJSON( $url , $post = null )
{
  return json_decode( httpRequest( $url , $post ) );
}

function login()
{
  global $post;
  global $settings;
  
  $json = httpRequestJSON( $settings['wikiapi'], $post['login']); 
  if( $json->login->result == 'NeedToken' ){
      $post['login']['lgtoken'] = $json->login->token;
      $json = httpRequestJSON( $settings['wikiapi'], $post['login']);
  }
  if( $json->login->result == 'Success' )
  {
    return array(0 => 1);
  }
  return array( 0 => 0,$json->login->result);
}
?>