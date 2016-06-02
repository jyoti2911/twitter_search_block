<?php
/**
 * @file
 * Contains \Drupal\twitter_search_block\Plugin\Block\TwitterAPIClass.
 */

namespace Drupal\twitter_search_block\Plugin\Block;

class TwitterAPIClass {
  /**
   * function to get the embedded timeline of tweets with given search query value and count
   */ 
  public function twitter_api($hash_value_one, $settings, $count,$result_type) {
    $output = '';
    /** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ * */
    $url = 'https://api.twitter.com/1.1/search/tweets.json';
    $requestMethod = 'GET';
    $getfield = '?q=' . $hash_value_one . '&count=' . $count . '&result_type='.$result_type;

    $twitter = new TwitterAPIExchange($settings);
    $api_response = $twitter->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest();

    $response = json_decode($api_response);
    foreach ($response->statuses as $tweetinn) {
      $tweet_id = $tweetinn->id_str;
      $url = 'https://api.twitter.com/1.1/statuses/oembed.json'; //twitter Rest Api to get the embedded tweet
      $requestMethod = 'GET';
      $getfield = '?id=' . $tweet_id . '&hide_media=true&maxwidth=260&hide_thread=true';
      $twitter1 = new TwitterAPIExchange($settings);
      $api_response1 = $twitter1->setGetfield($getfield)
          ->buildOauth($url, $requestMethod)
          ->performRequest();

      $response1 = json_decode($api_response1);
      $output .= $response1->html;
    }
    return $output;
  }

}
