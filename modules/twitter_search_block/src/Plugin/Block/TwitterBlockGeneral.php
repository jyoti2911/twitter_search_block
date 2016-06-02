<?php

/**
 * @file
 * Contains \Drupal\twitter_search_block\Plugin\Block\TwitterBlockGeneral.
 */

namespace Drupal\twitter_search_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;

require_once('TwitterAPIExchange.php'); //libarry used by twitter to process the Rest API with the respective variables

/**
 * Provides block with embeded tweets for independent use
 *
 * @Block(
 * id = "general_twitter_block",
 * admin_label = @Translation("tweet block:General"),
 * category = @Translation("Blocks")
 * )
 */
class TwitterBlockGeneral extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   * 
   */
  public function build() {

    $config = \Drupal::config('twitter_search_block.settings'); //Settings file for the module to store the credentials for twitter account
    $count = $config->get('tweets_count');
    $result_type = $config->get('result_type');
    $search_value = $config->get('search_query_value');
    $settings = array(
      'oauth_access_token' => $config->get('oauth_access_token'),
      'oauth_access_token_secret' => $config->get('oauth_access_token_secret'),
      'consumer_key' => $config->get('consumer_key'),
      'consumer_secret' => $config->get('consumer_secret')
    );

    $result = TwitterAPIClass::twitter_api($search_value, $settings, $count, $result_type);
    return array(
      '#children' => $result,
      '#cache' => array(
        'max-age' => 0,
      ),
    );
  }

}
