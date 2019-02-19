<?php
require_once(__DIR__ . '/config.php');

 // namespace MyApp;

 // use Abraham\TwitterOAuth\TwitterOAuth;

 // Get Twitter Account
 $screen_name = $_GET['user2'];

 // Get Twitter List Name
 $list_name = $_GET['list_name2'];

// twitter instance
$twitterLogin = new MyApp\TwitterLogin();

if ($twitterLogin->isLoggedIn()) {
  $me = $_SESSION['me'];

  // Create Twitter Object
  $twitter = new MyApp\Twitter($me->tw_access_token,$me->tw_access_token_secret);

  // Get Friends
  $follow_user = $twitter->getFriend($screen_name);

  // initialize var
  for($i = 0; $i < 5; $i++) {
    $add_friend_id[$i] = "";
  }
  $add_cnt = 0;
  // friend add to list(split 100)
  foreach ($follow_user->ids as $ids ) {
    if($add_cnt < 99) {
        $add_friend_id[0] = $add_friend_id[0] . $ids . ',';
    } elseif($add_cnt < 199) {
        $add_friend_id[1] = $add_friend_id[1] . $ids . ',';
    } elseif($add_cnt < 299) {
        $add_friend_id[2] = $add_friend_id[2] . $ids . ',';
    } elseif($add_cnt < 399) {
        $add_friend_id[3] = $add_friend_id[3] . $ids . ',';
    } elseif($add_cnt < 499) {
        $add_friend_id[4] = $add_friend_id[4] . $ids . ',';
    }
    $add_cnt++;
  }

  // delete Last Comma
  for($i = 0; $i < 5; $i++) {
    $add_friend_id[$i] = substr($add_friend_id[$i], 0, -1);
  }

  // create List and Get ListID, ListSlug
  $list_info = $twitter->createList($list_name);
  $list_id   = $list_info->id;

  // Add Friend to Created List
  $twitter->addMembers($list_id, $add_friend_id);

  // Add Target User Account to Created List
  $twitter->addMembers_screen_name($list_id, $screen_name);

  echo "処理が完了しました。Twitterアカウントのリストを確認してください。";

}



 ?>
