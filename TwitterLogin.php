<?php

namespace MyApp;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterLogin {
  public function Login(){

    // alradey logged in procedure
    if($this->isLoggedIn()) {
      goHome();
    }

    // not logged in procedure
    if(!isset($_GET['oauth_token']) || !isset($_GET['oauth_verifier'])){
        $this->_redirectFlow();
    } else {
      $this->_callbackFlow();
    }
  }

  public function isLoggedIn() {
    return isset($_SESSION['me']) && !empty($_SESSION['me']);
  }

  private function _callbackFlow(){
      if ($_GET['oauth_token'] !== $_SESSION['oauth_token']){
        throw new \Exception('invalid_oauth_token');
      }
      $conn = new TwitterOAuth(
        CONSUMER_KEY,
        CONSUMER_SECRET,
        $_SESSION['oauth_token'],
        $_SESSION['oauth_token_secret']
      );

       $tokens = $conn->oauth('oauth/access_token',
        array('oauth_verifier' => $_REQUEST['oauth_verifier'])
//        'oauth_token'=> $_GET['oauth_token']
      );

//    var_dump($tokens);
    $user = new User();
    $user->saveTokens($tokens);
    // echo "save tokens.";
    // exit;

    // session hijack
    session_regenerate_id(true);

    $_SESSION['me'] = $user->getUser($tokens['user_id']);

    // unset token
    unset ($_SESSION['oauth_token']);
    unset ($_SESSION['oauth_token_secret']);

    //go to index.php
    goHome();

    }

  private function _redirectFlow (){
    $conn = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

    // request token
    $tokens = $conn->oauth('oauth/request_token', [
      'oauth_callback' => CALLBACK_URL
    ]);

    // save
    $_SESSION['oauth_token'] = $tokens['oauth_token'];
    $_SESSION['oauth_token_secret'] = $tokens['oauth_token_secret'];

    // redirect
    $authorizeUrl = $conn->url('oauth/authorize',[
      'oauth_token' => $tokens['oauth_token']
    ]);
    header('Location: ' . $authorizeUrl);
    exit;
  }
}

 ?>
