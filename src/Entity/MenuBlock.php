<?php

/**
 * @file
 * Contains Drupal\menu_block\Entity\MenuBlock.
 */

namespace Drupal\menu_block\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\menu_block\MenuBlockInterface;

/**
 * Defines the MenuBlock entity.
 *
 * @ConfigEntityType(
 *   id = "menu_block",
 *   label = @Translation("MenuBlock"),
 *   handlers = {
 *     "list_builder" = "Drupal\menu_block\Controller\MenuBlockListBuilder",
 *     "form" = {
 *       "add" = "Drupal\menu_block\Form\MenuBlockForm",
 *       "edit" = "Drupal\menu_block\Form\MenuBlockForm",
 *       "delete" = "Drupal\menu_block\Form\MenuBlockDeleteForm"
 *     }
 *   },
 *   config_prefix = "menu_block",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "edit-form" = "entity.menu_block.edit_form",
 *     "delete-form" = "entity.menu_block.delete_form",
 *     "collection" = "entity.menu_block.collection"
 *   }
 * )
 */
class MenuBlock extends ConfigEntityBase implements MenuBlockInterface {
  /**
   * The MenuBlock ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The MenuBlock label.
   *
   * @var string
   */
  protected $label;

  /**
   * The menu to embed the vocabulary.
   *
   * @var \Drupal\system\Entity\Menu
   */
  protected $menu;

  /**
   * The block title.
   *
   * @var string
   */
  protected $block_title;

  /**
   * The admin title for the block.
   *
   * @var string
   */
  protected $admin_block_title;

  /**
   * The starting level.
   *
   * @var int
   */
  protected $starting_level;

  /**
   * The depth of the menu.
   *
   * @var int
   */
  protected $maximum_depth;

  /**
   * @return \Drupal\system\Entity\Menu
   */
  public function getMenu() {
    return $this->menu;
  }

  /**
   * @param \Drupal\system\Entity\Menu $menu
   */
  public function setMenu($menu) {
    $this->menu = $menu;
  }

  /**
   * @return string
   */
  public function getBlockTitle() {
    return $this->block_title;
  }

  /**
   * @param string $block_title
   */
  public function setBlockTitle($block_title) {
    $this->block_title = $block_title;
  }

  /**
   * @return string
   */
  public function getAdminBlockTitle() {
    return $this->admin_block_title;
  }

  /**
   * @param string $admin_block_title
   */
  public function setAdminBlockTitle($admin_block_title) {
    $this->admin_block_title = $admin_block_title;
  }

  /**
   * @return int
   */
  public function getStartingLevel() {
    return $this->starting_level;
  }

  /**
   * @param int $starting_level
   */
  public function setStartingLevel($starting_level) {
    $this->starting_level = $starting_level;
  }

  /**
   * @return int
   */
  public function getMaximumDepth() {
    return $this->maximum_depth;
  }

  /**
   * @param int $maximum_depth
   */
  public function setMaximumDepth($maximum_depth) {
    $this->maximum_depth = $maximum_depth;
  }

}
