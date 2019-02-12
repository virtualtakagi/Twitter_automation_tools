<?php

namespace MyApp;

class Token {

  static function create() {
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
  }

  static function validate($tokenKey) {
    if (
      !isset($_SESSION['token']) ||
      !isset($_POST[$tokenKey]) ||
      $_SESSION['token'] !== $_POST[$tokenKey]
    ) {
//      echo "session : ". $_SESSION['token'] .", post" . $_POST[$tokenKey];

      throw new \Exception('invalid token.');
    }
  }

}


 ?>
