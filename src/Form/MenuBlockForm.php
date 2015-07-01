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
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $menu_block->label(),
      '#description' => $this->t("Label for the MenuBlock."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $menu_block->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\menu_block\Entity\MenuBlock::load',
      ),
      '#disabled' => !$menu_block->isNew(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $menu_block = $this->entity;
    $status = $menu_block->save();

    if ($status) {
      drupal_set_message($this->t('Saved the %label MenuBlock.', array(
        '%label' => $menu_block->label(),
      )));
    }
    else {
      drupal_set_message($this->t('The %label MenuBlock was not saved.', array(
        '%label' => $menu_block->label(),
      )));
    }
    $form_state->setRedirectUrl($menu_block->urlInfo('collection'));
  }

}
