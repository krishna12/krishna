<?php
require 'facebook.php';
    
$facebook = new Facebook(array(
  'appId'  => '200150466775783',
  'secret' => '0e1558433ba95d240fbc8a6c79757caa',
  'cookie' => true,
));
 
//2. retrieving session
$session = $facebook->getSession();
 
//3. requesting 'me' to API
$me = null;
if ($session) {
  try {
    $uid = $facebook->getUser();
    $me = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
  }
}
 
//4. login or logout
if ($me) {
    $logoutUrl = $facebook->getLogoutUrl();
} else {
    $loginUrl = $facebook->getLoginUrl();
}
 
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
  </head>
  <body>
    <?php if ($me): ?>
    <?php echo "Welcome, ".$me['first_name']. ".<br />"; ?>
    <a href="<?php echo $logoutUrl; ?>">
      <img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif">
    </a>
    <?php else: ?>
      <a href="<?php echo $loginUrl; ?>">
        <img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif">
      </a>
    <?php endif ?>
  </body>
</html>
