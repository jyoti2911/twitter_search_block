<?php

/**
 * @file
 * Contains \Drupal\twitter_search_block\Plugin\Block\TweetBlock.
 */

namespace Drupal\twitter_search_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;

require_once('TwitterAPIExchange.php'); //libarry used by twitter to process the Rest API with the respective variables

/**
 * Provides my custom block.
 *
 * @Block(
 * id = "tweet_block",
 * admin_label = @Translation("tweet block"),
 * category = @Translation("Blocks")
 * )
 */
class TweetBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   * 
   */
  public function build() {

    $config = \Drupal::config('twitter_search_block.settings'); //Settings file for the module to store the credentials for twitter account
    $count=$config->get('tweets_count');
    $result_type=$config->get('result_type');
    $node = \Drupal::request()->attributes->get('node');
    $bundle_fields = \Drupal::entityManager()->getFieldDefinitions('node', 'article');
    foreach(array_keys($bundle_fields) as $field_name) {
      if ($bundle_fields[$field_name]->getType() == 'twitter_hashtag_fieldtype'){
        $field_data[] = $field_name;
      }
    }
    
    $settings = array(
      'oauth_access_token' => $config->get('oauth_access_token'),
      'oauth_access_token_secret' => $config->get('oauth_access_token_secret'),
      'consumer_key' => $config->get('consumer_key'),
      'consumer_secret' => $config->get('consumer_secret')
    );
    
    if (!empty($node->$field_data[0]->tweet_values)){
      $search_value = $node->$field_data[0]->tweet_values;
      $result = TwitterAPIClass::twitter_api($search_value, $settings, $count,$result_type);
      return array(
        '#children' => $result,
        '#cache' => array(
          'max-age' => 0,
        ),
      );
    }
  }

//function to get the embedded timeline of tweets with given search query value and count 
//  public function twitter_api($hash_value_one, $settings, $count,$result_type) {
//    $output = '';
//    /** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ * */
//    $url = 'https://api.twitter.com/1.1/search/tweets.json';
//    $requestMethod = 'GET';
//    $getfield = '?q=' . $hash_value_one . '&count=' . $count . '&result_type='.$result_type;
//
//    $twitter = new TwitterAPIExchange($settings);
//    $api_response = $twitter->setGetfield($getfield)
//        ->buildOauth($url, $requestMethod)
//        ->performRequest();
//
//    $response = json_decode($api_response);
//    foreach ($response->statuses as $tweetinn) {
//      $tweet_id = $tweetinn->id_str;
//      $url = 'https://api.twitter.com/1.1/statuses/oembed.json'; //twitter Rest Api to get the embedded tweet
//      $requestMethod = 'GET';
//      $getfield = '?id=' . $tweet_id . '&hide_media=true&maxwidth=260&hide_thread=true';
//      $twitter1 = new TwitterAPIExchange($settings);
//      $api_response1 = $twitter1->setGetfield($getfield)
//          ->buildOauth($url, $requestMethod)
//          ->performRequest();
//
//      $response1 = json_decode($api_response1);
//      $output .= $response1->html;
//    }
//    return $output;
//  }

}
