<?php

namespace MyApp;

use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;

class Twitter {
  private $_conn;

  public function __construct($accessToken, $accessToken_Secret) {
    $this->_conn = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessToken_Secret);
  }

  public function getFriend($screen_name) {

    try {
      // get friend list
      $follow = $this->_conn->get('friends/ids', ['screen_name' => $screen_name]);
    } catch (TwitterOAuthException $e) {
      echo 'Failed to load follow';
    }
    return $follow;
  }

  public function createList($name) {
    try {
    $list_info = $this->_conn->post('lists/create', array('name' => $name, 'mode' => 'private'));
  } catch (TwitterOAuthException $e) {
    echo 'Failed to Create List';
  }
    return $list_info;
  }

  public function addMembers_onetime($id, $members) {
    try {
          $add_result = $this->_conn->post('lists/members/create_all', array('list_id' => $id, 'screen_name' => $members));
    } catch (TwitterOAuthException $e) {
      echo 'Failed to Create List';
    }
  }

  public function addMembers($id, $members) {
    try {
      for($i = 0; $i < 5; $i++) {
        if(!empty($members[$i])){
          $add_result = $this->_conn->post('lists/members/create_all', array('list_id' => $id, 'screen_name' => $members[$i]));
        }
      }
    } catch (TwitterOAuthException $e) {
      echo 'Failed to Create List';
    }
  }

  public function addMembers_screen_name($id, $members) {
    try {
          $add_result = $this->_conn->post('lists/members/create', array('list_id' => $id, 'screen_name' => $members));
    } catch (TwitterOAuthException $e) {
      echo 'Failed to Add List';
    }
  }

  public function getSearchResult($screen_name) {
    try {
    $screen_name = "@" . $screen_name;
    $search_result = $this->_conn->get('search/tweets', array('q' => $screen_name, 'result_type' => 'recent', 'count' => '100'));
  } catch (TwitterOAuthException $e) {
    echo 'Failed to Search Tweets';
  }
    return $search_result;
  }

  public function getUserTimeline($screen_name) {
    try {
    $get_user_timeline = $this->_conn->get('statuses/user_timeline', array('screen_name' => $screen_name,
     'count' => '200', 'exclude_replies' => 'false', 'include_rts' => 'false'));
  } catch (TwitterOAuthException $e) {
    echo 'Failed to Get Tweets';
  }
    return $get_user_timeline;
  }

  public function getUserTimeline_nextPage($screen_name, $max_id) {
    try {
    $get_user_timeline = $this->_conn->get('statuses/user_timeline', array('screen_name' => $screen_name,
     'count' => '200', 'exclude_replies' => 'false', 'include_rts' => 'false', 'max_id' => $max_id));
  } catch (TwitterOAuthException $e) {
    echo 'Failed to Get Tweets';
  }
    return $get_user_timeline;
  }

}
