<?php

/**
 * @file
 * Contains \Drupal\twitter_search_block\Form\TwitterHashBlockConfig.
 */

namespace Drupal\twitter_search_block\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class TwitterHashBlockConfig extends FormBase {

  public function getFormId() {
    return 'block_config_form_id';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['tweets_count'] = array(
      '#type' => 'number',
      '#title' => t('Number of Tweets'),
      '#required' => TRUE,
      '#description' => 'Number of embedded tweets thet gets displayed inside the Block'
    );
    $form['search_query_value'] = array(
      '#type' => 'textfield',
      '#title' => t('Twitter Hashtag'),
      '#required' => FALSE,
      "#description" => 'This search value is used to display the embeded tweets in seperate Block-(Twitter:Independent embeded).The module also provides a field(hashtag) which can be added to specefic content and get different embedded tweets on different pages having different hash field value.'
    );
    $form['result_type'] = array(
      '#type' => 'radios',
      '#options' => ['mixed' => t('Mixed'),
        'recent' => t('Recent'),
        'popular' => t('Popular'),
      ],
      '#title' => t('Result Type'),
      '#required' => TRUE,
      '#description' => 'Gives results you would prefer to receive. Valid values include: * Mixed: Include both popular and real time results in the response. * recent: return only the most recent results in the response * popular: return only the most popular results in the response.<a href="https://dev.twitter.com/rest/reference/get/search/tweets">Read More</a>'
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    
  }

  /**
   * Saving Twitter Block Configuration   
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config = \Drupal::service('config.factory')->getEditable('twitter_search_block.settings');
    $config->set('tweets_count', $form_state->getValue('tweets_count'))->save();
    $config->set('search_query_value', $form_state->getValue('search_query_value'))->save();
    $config->set('result_type', $form_state->getValue('result_type'))->save();
  }

}
