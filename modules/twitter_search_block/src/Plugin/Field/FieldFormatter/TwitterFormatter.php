<?php

/**
 * @file
 * Contains Drupal\twitter_search_block\Plugin\Field\FieldFormatter\TwitterFormatter.
 */

namespace Drupal\twitter_search_block\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 *
 * @FieldFormatter(
 *   id = "twitter_hashtag_formatter",
 *   module = "twitter_search_block",
 *   label = @Translation("Twitter Hashtag Formatter"),
 *   field_types = {
 *     "twitter_hashtag_fieldtype"
 *   }
 * )
 */
class TwitterFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();

    foreach ($items as $delta => $item) {
      // Render output using person_default theme.
      $elements[$delta] = array(
        '#tweet_values' => $item->tweet_values,
      );
    }
    return $elements;
  }
}
