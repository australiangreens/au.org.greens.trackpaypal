<?php

require_once 'trackpaypal.civix.php';
use CRM_Trackpaypal_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function trackpaypal_civicrm_config(&$config) {
  _trackpaypal_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function trackpaypal_civicrm_xmlMenu(&$files) {
  _trackpaypal_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function trackpaypal_civicrm_install() {
  _trackpaypal_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function trackpaypal_civicrm_postInstall() {
  _trackpaypal_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function trackpaypal_civicrm_uninstall() {
  _trackpaypal_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function trackpaypal_civicrm_enable() {
  _trackpaypal_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function trackpaypal_civicrm_disable() {
  _trackpaypal_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function trackpaypal_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _trackpaypal_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function trackpaypal_civicrm_managed(&$entities) {
  _trackpaypal_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function trackpaypal_civicrm_caseTypes(&$caseTypes) {
  _trackpaypal_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function trackpaypal_civicrm_angularModules(&$angularModules) {
  _trackpaypal_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function trackpaypal_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _trackpaypal_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function trackpaypal_civicrm_entityTypes(&$entityTypes) {
  _trackpaypal_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
 */
function trackpaypal_civicrm_navigationMenu(&$menu) {
  _trackpaypal_civix_insert_navigation_menu($menu, 'Administer', array(
    'label' => E::ts('PayPal Tracking'),
    'name' => 'trackpaypal_settings',
    'url' => 'civicrm/trackpaypal/settings',
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _trackpaypal_civix_navigationMenu($menu);
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_buildForm/
 */
function trackpaypal_civicrm_buildForm($formName, &$form) {
  if ($formName === 'CRM_Contribute_Form_Contribution_Main'
    || $formName === 'CRM_Contribute_Form_Contribution_Confirm') {

    // Add a hidden field to the form with the id/key 'gcid'
    // JavaScript code in the template will populate it
    // with the Google Analytics client from the visitor's browser
    $templatePath = realpath(dirname(__FILE__) . "/templates");
    $form->add('hidden', 'gcid', '');
    CRM_Core_Region::instance('page-body')->add(array(
      'template' => "{$templatePath}/trackpaypal.tpl",
    ));
  }
}

/**
 * Implements hook_civicrm_alterPaymentProcessorParams().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterPaymentProcessorParams/
 */
function trackpaypal_civicrm_alterPaymentProcessorParams($paymentObj, &$rawParams, &$cookedParams) {
  // Eway Payment Processor sometimes passes $cookedParams as an instance of GatewayRequest class
  // From Nov 2020 Eway Recurring has a different class name for its version of the GatewayRequest class EwayRecurringGatewayRequest.
  // PHP complains if you try and use it as an array and we don't care about it in this instnce so return.
  if ($cookedParams instanceof GatewayRequest || $cookedParams instanceof EwayRecurringGatewayRequest) {
    return;
  }
  else {
    if (isset($cookedParams['custom'])) {
      // Add the Google Analytics client ID value
      // to the JSON encoded 'custom' attribute
      // of the payload that goes to PayPal
      $customPayload = json_decode($cookedParams['custom'], TRUE);
      $customPayload += ['gcid' => $rawParams['gcid']];
      $cookedParams['custom'] = json_encode($customPayload);
    }
  }
}

function trackpaypal_civicrm_postIPNProcess(&$IPNData) {
  // We've captured the IPN packet
  // Now we want to retrieve the Google Client ID
  // and transaction details to send to Google Analytics
  // via its REST interface

  // Retrieve extension settings
  $event_type = Civi::settings()->get('trackpaypal_event_type');
  $tracking_code = Civi::settings()->get('trackpaypal_tracking_code');
  $event_category = Civi::settings()->get('trackpaypal_event_category');
  if ($event_category == "") {
    $event_category = 'Transaction';
  }
  $debug_mode = Civi::settings()->get('trackpaypal_debug_mode');

  // Check the GA Code is of valid syntax
  // If not we do nothing
  if (!trackpaypal_isGACode($tracking_code)) {
    Civi::log()->warning('GA Code invalid: {code}', array('code' => $tracking_code));
    return;
  }

  // Retrieve IPN packet data
  // We're constructing a fake $gcid if none is present in the payload
  $customPayload = json_decode($IPNData['custom'], TRUE);
  $gcid = ($customPayload['gcid'] ? $customPayload['gcid'] : mt_rand(100000000,999999999) . '.' . time());
  $form_id = $customPayload['contributionPageID'];
  $trxn_id = $IPNData['txn_id'];
  $revenue = $IPNData['mc_gross'];
  $currency = $IPNData['mc_currency'];

  // Construct HTTP request object
  $client = new GuzzleHttp\Client(['base_uri' => 'https://www.google-analytics.com']);

  // Define our endpoints (production and debug)
  $endpoint = '/collect';
  $endpoint_debug = '/debug/collect';

  // Construct our two payload types: standard GA event and ecommerce transaction

  $packet_ecommerce = [
    'form_params' => [
      'v' => '1',
      'tid' => $tracking_code,
      'cid' => $gcid,
      't' => 'transaction',
      'ti' => $trxn_id,
      'tr' => $revenue,
      'cu' => $currency,
    ],
  ];

  $packet_event = [
    'form_params' => [
      'v' => '1',
      'tid' => $tracking_code,
      'cid' => $gcid,
      't' => 'event',
      'ec' => $event_category,
      'ea' => 'purchase',
      'el' => $form_id,
      'ev' => floor(floatval($revenue)),
    ],
  ];

  if ($event_type == 'ecommerce') {
    $result = $client->request('POST', $endpoint, $packet_ecommerce);
    if ($debug_mode == 'on') {
      $result = $client->request('POST', $endpoint_debug, $packet_ecommerce);
      trackpaypal_logValidation($result);
    }
  }
  elseif ($event_type == 'standard') {
    $result = $client->request('POST', $endpoint, $packet_event);
    if ($debug_mode == 'on') {
      $result = $client->request('POST', $endpoint_debug, $packet_event);
      trackpaypal_logValidation($result);
    }
  }
  elseif ($event_type == 'both') {
    $result = $client->request('POST', $endpoint, $packet_ecommerce);
    if ($debug_mode == 'on') {
      $result = $client->request('POST', $endpoint_debug, $packet_ecommerce);
      trackpaypal_logValidation($result);
    }
    $result = $client->request('POST', $endpoint, $packet_event);
    if ($debug_mode == 'on') {
      $result = $client->request('POST', $endpoint_debug, $packet_event);
      trackpaypal_logValidation($result);
    }
  }
}

function trackpaypal_isGACode($str) {
  return (bool) preg_match('/^ua-\d{4,10}(-\d{1,4})?$/i', $str);
}

function trackpaypal_logValidation($response) {
  if ($response->getBody()) {
    Civi::log()->debug('GA validation response: {response}', array(
      'response' => $response->getBody()->getContents(),
    ));
  }
}
