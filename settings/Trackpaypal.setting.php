<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.7                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2017                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
 */
/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2017
 * $Id$
 *
 */
/*
 * Settings metadata file
 */
return array(
  'trackpaypal_event_type' => array(
    'group_name' => 'trackpaypal',
    'group' => 'trackpaypal',
    'name' => 'trackpaypal_event_type',
    'filter' => 'trackpaypal',
    'type' => 'String',
    'add' => '4.7',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Send eCommerce Transaction, standard Event or both to Google Analytics?',
    'title' => 'Data to send to GA',
    'default' => array('ecommerce'),
    'html_type' => 'Select',
    'pseudoconstant' => array(
      'callback' => 'CRM_Trackpaypal_Form_Settings::eventTypes',
    ),
    'quick_form_type' => 'Element',
  ),
  'trackpaypal_tracking_code' => array(
    'group_name' => 'trackpaypal',
    'group' => 'trackpaypal',
    'name' => 'trackpaypal_tracking_code',
    'filter' => 'trackpaypal',
    'type' => 'String',
    'add' => '4.7',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Google Analytics tracking code (similar to UA-XXXXXX-X)',
    'title' => 'Tracking Code',
    'html_type' => 'Text',
    'html_attributes' => array(
      'size' => 18,
      'maxlength' => 16,
    ),
    'quick_form_type' => 'Element',
  ),
  'trackpaypal_event_category' => array(
    'group_name' => 'trackpaypal',
    'group' => 'trackpaypal',
    'name' => 'trackpaypal_event_category',
    'filter' => 'trackpaypal',
    'type' => 'String',
    'add' => '4.7',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Google Analytics Event Category term. Defaults to "Transaction" if blank.',
    'title' => 'Event Category',
    'html_type' => 'Text',
    'html_attributes' => array(
      'size' => 18,
      'maxlength' => 16,
    ),
    'quick_form_type' => 'Element',
  ),
  'trackpaypal_debug_mode' => array(
    'group_name' => 'trackpaypal',
    'group' => 'trackpaypal',
    'name' => 'trackpaypal_debug_mode',
    'filter' => 'trackpaypal',
    'type' => 'String',
    'add' => '4.7',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Enable debug mode? Logs GA validation data to ConfigAndLog. Data will sent to GA as well.',
    'title' => 'Debug mode',
    'default' => array('off'),
    'html_type' => 'Select',
    'pseudoconstant' => array(
      'callback' => 'CRM_Trackpaypal_Form_Settings::debugMode',
    ),
    'quick_form_type' => 'Element',
  ),

);
