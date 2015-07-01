<?php

/**
 * @file
 * Contains Drupal\menu_block\Plugin\Block\MenuBlock.
 */

namespace Drupal\menu_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'MenuBlock' block.
 *
 * @Block(
 *  id = "menu_block",
 *  admin_label = @Translation("menu_block"),
 *  category = @Translation("Menus"),
 *  deriver = "Drupal\menu_block\Plugin\Derivative\MenuBlock"
 * )
 */
class MenuBlock extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['menu_block']['#markup'] = 'Implement MenuBlock.';

    return $build;
  }

}
