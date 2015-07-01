<?php

/**
 * @file
 * Contains \Drupal\menu_block\Plugin\Derivative\MenuBlock.
 */

namespace Drupal\menu_block\Plugin\Derivative;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides block plugin definitions for all Menu Block block displays.
 *
 * @see \Drupal\menu_block\Plugin\block\MenuBlock
 */
class MenuBlock implements ContainerDeriverInterface {

  /**
   * List of derivative definitions.
   *
   * @var array
   */
  protected $derivatives = array();

  /**
   * The base plugin ID.
   *
   * @var string
   */
  protected $basePluginId;

  /**
   * The menu block storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $menuBlockStorage;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, $base_plugin_id) {
    return new static(
      $base_plugin_id,
      $container->get('entity.manager')->getStorage('menu_block')
    );
  }

  /**
   * Constructs a MenuBlock object.
   *
   * @param string $base_plugin_id
   *   The base plugin ID.
   * @param \Drupal\Core\Entity\EntityStorageInterface $menu_block_storage
   *   The entity storage to load menu blocks.
   */
  public function __construct($base_plugin_id, EntityStorageInterface $menu_block_storage) {
    $this->basePluginId = $base_plugin_id;
    $this->menuBlockStorage = $menu_block_storage;
  }

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinition($derivative_id, $base_plugin_definition) {
    if (!empty($this->derivatives) && !empty($this->derivatives[$derivative_id])) {
      return $this->derivatives[$derivative_id];
    }
    $this->getDerivativeDefinitions($base_plugin_definition);
    return $this->derivatives[$derivative_id];
  }

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    // Check all menu blocks for block displays.
    foreach ($this->menuBlockStorage->loadMultiple() as $menu_block) {
      $delta = $menu_block->id();

      $this->derivatives[$delta] = array(
        'category' => 'menu block',
        'admin_label' => $menu_block->getAdminBlockTitle(),
      );
      $this->derivatives[$delta] += $base_plugin_definition;

    }
    return $this->derivatives;
  }

}
