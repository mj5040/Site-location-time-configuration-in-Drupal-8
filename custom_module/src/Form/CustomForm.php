<?php

namespace Drupal\custom_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form to set site location and current time
 */
class CustomForm extends ConfigFormBase {

  /**  
   * {@inheritdoc}  
   */  
  protected function getEditableConfigNames() {  
    return [  
      'custom.adminsettings',  
    ];  
  }  

  /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'custom_form';  
  }    

 /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $config = $this->config('custom.adminsettings');
  
    $form['country'] = [  
      '#type' => 'textfield',  
      '#title' => $this->t('Country'),  
      '#default_value' => $config->get('country'),  
    ]; 

    $form['city'] = [  
      '#type' => 'textfield',  
      '#title' => $this->t('City'),  
      '#default_value' => $config->get('city'),  
    ];  

    $form['timezone'] = [  
      '#type' => 'select',  
      '#title' => $this->t('Timezone'),
      '#options' => array('America/Chicago' => 'America/Chicago',
        'America/New_York' => 'America/New_York',
        'Asia/Tokyo' => 'Asia/Tokyo',
        'Asia/Dubai' => 'Asia/Dubai',
        'Asia/Kolkata' => 'Asia/Kolkata',
        'Europe/Amsterdam' => 'Europe/Amsterdam',
        'Europe/Oslo' => 'Europe/Oslo',
        'Europe/London' => 'Europe/London'
      ),  
      '#default_value' => $config->get('timezone'),  
    ];    
    
    return parent::buildForm($form, $form_state);  
  }

  /**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {      
    $config = $this->config('custom.adminsettings'); 
    $config->set('country', $form_state->getValue('country')) ;
    $config->set('city', $form_state->getValue('city')) ;
    $config->set('timezone', $form_state->getValue('timezone')) ;
    $config->save();  
    parent::submitForm($form, $form_state);
  }

}  