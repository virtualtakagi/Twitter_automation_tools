<?php
require_once(__DIR__ . '/config.php');

 // Get Twitter Account
 $screen_name = $_GET['user1'];

 // Get Twitter List Name
 $list_name = $_GET['list_name1'];

// twitter instance
$twitterLogin = new MyApp\TwitterLogin();

if ($twitterLogin->isLoggedIn()) {
  $me = $_SESSION['me'];

  // Create Twitter Object
  $twitter = new MyApp\Twitter($me->tw_access_token,$me->tw_access_token_secret);

  // Get Friends
  $tweet_result = $twitter->getSearchResult($screen_name);

  // Get user_timeline
  $user_timeline = $twitter->getUserTimeline($screen_name);

  // Get Mention from user_timeline
  for($tweet_cnt = 0; $tweet_cnt < 200; $tweet_cnt++){
    // if mention
      if(!empty($user_timeline[$tweet_cnt]->in_reply_to_user_id)) {
        $user_tweet[] = $user_timeline[$tweet_cnt]->in_reply_to_user_id;
      }
  }

  // Mention count
  $mention_count_array = array_count_values($user_tweet);

  // Descending Mention Count Array
  arsort($mention_count_array);

  // Initialize $list_id
  $mention_list_id = "";
  $mention_createid_count = 0;

  // Create Mention TwitterID for Add List
  foreach ($mention_count_array as $key => $id) {
    $mention_list_id = $mention_list_id . $key . ",";
    $mention_createid_count++;
    if($mention_createid_count > 19) {
      break;
    }
  }

  // Twitter ID in to Statistics Array
  for($i = 0; $i < 99; $i++) {

    // if null Object loop exit
    if(empty($tweet_result->statuses[$i]->user->id)) {
      break;
    }
    // add Twitter ID to statistics Array
    $statistics_array[] = $tweet_result->statuses[$i]->user->id;

  }
  // array_count_values
  $twitterID_Count_Array = array_count_values($statistics_array);

  // Descending sort
  arsort($twitterID_Count_Array);

  // Initialize $list_id
  $list_id = "";
  $createid_count = 0;
  // Create TwitterID List for Add List
  foreach ($twitterID_Count_Array as $key => $id) {
    $list_id = $list_id . $key . ",";
    $createid_count++;
    if($createid_count > 9) {
      break;
    }
  }

  // merge mention_list_id and list_id
  $merged_friend_id = $mention_list_id . $list_id;

  // delete Last Comma
  $merged_friend_id = substr($merged_friend_id, 0, -1);

  // create List and Get ListID
  $list_info = $twitter->createList($list_name);
  $list_id   = $list_info->id;

  // Add Friend to Created List
  $twitter->addMembers_onetime($list_id, $merged_friend_id);

  // Add Last members to List
  $twitter->addMembers_onetime($list_id, $screen_name);

  echo "処理が完了しました。\nTwitterのリスト画面から作成したリストと追加メンバー数を確認してください";
}
 ?>
