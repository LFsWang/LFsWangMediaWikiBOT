<?
#login
#cURL will save cookie to $settings['cookiefile'].
#只需登入一次，第一次使用時務必登入!
#請注意檔案的存取權限
require_once('lib/LFsWangBOT.php');

$loginResult = login();
if( $loginResult[0] === 0 ){
  echo 'Login with error : '.$loginResult[1]."\n";
}
else{
  echo "Login ! user : $settings[user]\n";
}

?>