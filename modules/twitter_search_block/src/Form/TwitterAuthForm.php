<?php

/**
 * @file
 * Contains \Drupal\twitter_search_block\Form\TwitterAuthForm.
 */

namespace Drupal\twitter_search_block\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class TwitterAuthForm extends FormBase {

  /**
   * Configuration form for setting OAuth values of Twitter
   */
  public function getFormId() {
    return 'twitter_oAuth_form_id';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['oauth_access_token'] = array(
      '#type' => 'textfield',
      '#title' => t('OAuth Access Token'),
      '#required' => TRUE,
      '#placeholder' => t('OAUTH ACCESS TOKEN *')
    );
    $form['oauth_access_token_secret'] = array(
      '#type' => 'textfield',
      '#title' => t('OAuth Access Token Secret'),
      '#required' => TRUE,
      '#placeholder' => t('OAUTH ACCESS TOKEN SECRET *')
    );
    $form['consumer_key'] = array(
      '#type' => 'textfield',
      '#title' => t('Consumer Key'),
      '#required' => TRUE,
      '#placeholder' => t('CONSUMER KEY *')
    );
    $form['consumer_secret'] = array(
      '#type' => 'textfield',
      '#title' => t('Consumer Secret'),
      '#required' => TRUE,
      '#placeholder' => t('CONSUMER SECRET *')
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
   * Saving OAuth credentials in configuration
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config = \Drupal::service('config.factory')->getEditable('twitter_search_block.settings');
    $config->set('oauth_access_token', $form_state->getValue('oauth_access_token'))->save();
    $config->set('oauth_access_token_secret', $form_state->getValue('oauth_access_token_secret'))->save();
    $config->set('consumer_key', $form_state->getValue('consumer_key'))->save();
    $config->set('consumer_secret', $form_state->getValue('consumer_secret'))->save();
  }

}
