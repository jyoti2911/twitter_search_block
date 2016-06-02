<?php

/**
 * @file
 * Contains \Drupal\twitter_search_block\Plugin\field\widget\TwitterWidget.
 */

namespace Drupal\twitter_search_block\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'field_example_text' widget.
 *
 * @FieldWidget(
 *   id = "twitter_hashtag_widget",
 *   module = "twitter_search_block",
 *   label = @Translation("Twitter Hashtag Widget"),
 *   field_types = {
 *     "twitter_hashtag_fieldtype"
 *   }
 * )
 */
class TwitterWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
   public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $element['tweet_values'] = array(
      '#title' => t('twitter Hashtag'),
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->tweet_values) ? $items[$delta]->tweet_values : NULL,
    );
    return $element;

}
}
