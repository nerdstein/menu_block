<?php

/**
 * @file
 * Contains Drupal\menu_block\Form\MenuBlockForm.
 */

namespace Drupal\menu_block\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MenuBlockForm.
 *
 * @package Drupal\menu_block\Form
 */
class MenuBlockForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $menu_block = $this->entity;

    // Label field.
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Administrative Label'),
      '#maxlength' => 255,
      '#default_value' => $menu_block->label(),
      '#required' => TRUE,
    );

    // ID field.
    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $menu_block->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\menu_block\Entity\MenuBlock::load',
      ),
      '#disabled' => !$menu_block->isNew(),
    );

    // Menu selection.
    $options = [];
    $menu_storage = \Drupal::entityManager()->getStorage('menu');
    foreach ($menu_storage->loadMultiple() as $menu) {
      $options[$menu->id()] = $menu->label();
    }
    $form['menu'] = [
      '#type' => 'select',
      '#title' => $this->t('Menu'),
      '#options' => $options,
      '#default_value' => $menu_block->getMenu(),
    ];

    // Block title.
    $form['block_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Block Title'),
      '#maxlength' => 255,
      '#default_value' => $menu_block->getBlockTitle(),
    );

    // Administrative block title.
    $form['admin_block_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Administrative Block Title'),
      '#maxlength' => 255,
      '#default_value' => $menu_block->getAdminBlockTitle(),
      '#required' => TRUE,
    );

    // Starting level.
    // TODO - Look at AJAX based on menu selected
    $form['starting_level'] = array(
      '#type' => 'select',
      '#title' => $this->t('Starting Menu Level'),
      '#maxlength' => 255,
      '#default_value' => $menu_block->getStartingLevel(),
      '#options' => array(
        '0' => 'Root',
        '1' => 'Level 1',
        '2' => 'Level 2',
        '3' => 'Level 3',
        '4' => 'Level 4',
        '5' => 'Level 5',
        '6' => 'Level 6',
        '7' => 'Level 7',
        '8' => 'Level 8',
      ),
      '#required' => TRUE,
      '#description' => $this->t("Select which level of the menu the menu block begins."),
    );

    // Maximum depth.
    $form['maximum_depth'] = array(
      '#type' => 'select',
      '#title' => $this->t('Starting Menu Level'),
      '#maxlength' => 255,
      '#default_value' => $menu_block->getMaximumDepth(),
      '#options' => array(
        '0' => 'All levels',
        '1' => '1 level',
        '2' => '2 levels',
        '3' => '3 levels',
        '4' => '4 levels',
        '5' => '5 levels',
        '6' => '6 levels',
        '7' => '7 levels',
        '8' => '8 levels',
      ),
      '#required' => TRUE,
      '#description' => $this->t("Select how many levels of the menu block should render."),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $menu_block = $this->entity;
    $status = $menu_block->save();

    if ($status) {
      drupal_set_message($this->t('Saved the %label menu block.', array(
        '%label' => $menu_block->label(),
      )));
    }
    else {
      drupal_set_message($this->t('The %label menu block was not saved.', array(
        '%label' => $menu_block->label(),
      )));
    }
    $form_state->setRedirectUrl($menu_block->urlInfo('collection'));
  }

}
