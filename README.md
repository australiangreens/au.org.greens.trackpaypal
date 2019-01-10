# au.org.greens.trackpaypal

![Screenshot](/images/screenshot.png)

This extension is designed to facilitate tracking of PayPal transactions in Google Analytics

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v5.4+
* CiviCRM 4.7+
* PayPal account with Instant Payment Notification (IPN) enabled and configured to send data to CiviCRM

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl au.org.greens.trackpaypal@https://github.com/australiangreens/au.org.greens.trackpaypal/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/australiangreens/au.org.greens.trackpaypal.git
cv en trackpaypal
```

## Usage

Enable the extension then go to the settings page (path is `/civicrm/trackpaypal/settings`; `PayPal Tracking` under the `Administer` menu). Set your preferred options. Be sure you enter your Google Analytics tracking code correctly.

You may wish to start with the extension in Debug Mode. In this mode transaction data will only be sent to Google Analytics for validation, with the validation results being logged in Civi's [debug logs](https://docs.civicrm.org/dev/en/latest/tools/debugging/#viewing-log-fileshttps://docs.civicrm.org/dev/en/latest/tools/debugging/#viewing-log-files). You can use this to ensure everything is working properly before sending live data to your Google Analytics account.

You may find the [CiviCRM Log Viewer extension](https://civicrm.org/extensions/civicrm-log-viewer) useful for viewing the debug logs.
## Details

This extension rewrites the data packet sent by CiviCRM to PayPal for payment handling to include the Google Analytics ID of the person making the transaction. When PayPal sends its IPN data back to CiviCRM, a hook function parses the returned data and constructs either a Google Analytics [Event](https://developers.google.com/analytics/devguides/collection/analyticsjs/events), [ecommerce transaction](https://developers.google.com/analytics/devguides/collection/analyticsjs/ecommerce) or both. It sends the data using Google's [Measurement Protocol API](https://developers.google.com/analytics/devguides/collection/protocol/v1/).

## Known Issues

N/A
