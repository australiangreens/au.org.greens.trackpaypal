<?php

use CRM_Trackpaypal_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://wiki.civicrm.org/confluence/display/CRMDOC/QuickForm+Reference
 */
class CRM_Trackpaypal_Form_Settings extends CRM_Core_Form {

  public static function eventTypes() {
    return array(
      'standard' => 'standard',
      'ecommerce' => 'ecommerce',
    );
  }

  private $_settingFilter = array('group' => 'trackpaypal');
  private $_submittedValues = array();
  private $_settings = array();
  public function buildQuickForm() {
    $settings = $this->getFormSettings();
    foreach ($settings as $name => $setting) {
      drupal_set_message(json_encode($setting));
      if (isset($setting['quick_form_type'])) {
        $options = NULL;
        if (isset($setting['pseudoconstant'])) {
          $options = civicrm_api3('Setting', 'getoptions', array('field' => $name));
        }
        $add = 'add' . $setting['quick_form_type'];
        if ($add == 'addElement') {
          $this->$add(
            $setting['html_type'],
            $name,
            ts($setting['title']),
            ($options !== NULL) ? $options['values'] : CRM_Utils_Array::value('html_attributes', $setting, array()),
            ($options !== NULL) ? CRM_Utils_Array::value('html_attributes', $setting, array()) : NULL
          );
        }
        else {
          $this->$add($name, ts($setting['title']));
        }
        $this->assign("{$name}_description", $setting['description']);
      }
    }
    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => ts('Submit'),
        'isDefault' => TRUE,
      ),
    ));
    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }
  public function postProcess() {
    $this->_submittedValues = $this->exportValues();
    $this->saveSettings();
    parent::postProcess();
  }
  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  public function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons". These
    // items don't have labels. We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }
  /**
   * Get the settings we are going to allow to be set on this form.
   *
   * @return array
   */
  public function getFormSettings() {
    if (empty($this->_settings)) {
      $settings = civicrm_api3('setting', 'getfields', array('filters' => $this->_settingFilter));
    }
    return $settings['values'];
  }
  /**
   * Get the settings we are going to allow to be set on this form.
   */
  public function saveSettings() {
    $settings = $this->getFormSettings();
    $values = array_intersect_key($this->_submittedValues, $settings);
    civicrm_api3('setting', 'create', $values);
  }
  /**
   * Set defaults for form.
   *
   * @see CRM_Core_Form::setDefaultValues()
   */
  public function setDefaultValues() {
    $existing = civicrm_api3('setting', 'get', array('return' => array_keys($this->getFormSettings())));
    $defaults = array();
    $domainID = CRM_Core_Config::domainID();
    foreach ($existing['values'][$domainID] as $name => $value) {
      $defaults[$name] = $value;
    }
    return $defaults;
  }

}
