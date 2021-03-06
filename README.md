# WooCommerce Becopay Gateway

**Tags:** woocommerce, payment gateway, payment gateways, becopay, gateway, payment, woocommerce payment, woocommerce gateway, bitcoin, crypto

**Stable tag:** 1.1.2

**Tested up to:** 5.0.1

**Requires PHP:** 5.3.0

**License:** [Apache 2](https://github.com/becopay/Woocommerce-Becopay-Gateway/blob/master/LICENSE.txt)

Becopay Woocommerce Payment Gateway allows you to pay with cryptocurrency.


## Description

This is a Becopay payment gateway for WooCommerce.

Becopay is a payment gateway that allows you to accept cryptocurrency payments online, the simple way.

To get a Becopay merchant account visit their website by clicking [here](https://www.becopay.com)

Becopay Woocommerce Payment Gateway allows you to accept cryptocurrency payment on your Woocommerce store via Bitcoin, Ethereum and etc.

With this Becopay Woocommerce Payment Gateway plugin, you will be able to accept cryptocurrency in your shop:

* __Bitcoin__
* __Ethereum__


### Plugin Features

*   __Accept payment__ via Bitcoin, Ethereum and etc.
* 	__Seamless integration__ into the WooCommerce checkout page.


### Suggestions / Feature Request

If you have suggestions or a new feature request, feel free to get in touch with me via the contact form on my website [here](https://becopay.com/en/support/#contact-us)

You can also follow me on Twitter! **[@becopayment](http://twitter.com/becopayment)**



### Contribute
To contribute to this plugin feel free to fork it on GitHub [Woocommerce-Becopay-Gateway](https://github.com/becopay/Woocommerce-Becopay-Gateway)


## Installation


### Automatic Installation
* 	Login to your WordPress Admin area
* 	Go to __`Plugins > Add New`__ from the left hand menu
* 	In the search box type "__Woocommerce Becopay Gateway__"
*	From the search result you will see "__WooCommerce Becopay Gateway__" click on "__Install Now__" to install the plugin
*	A popup window will ask you to confirm your wish to install the Plugin.

	__Note:__
	If this is the first time you've installed a WordPress Plugin, you may need to enter the FTP login credential 	information. If you've installed a Plugin before, it will still have the login information. This information is available through your web server host.

* Click "Proceed" to continue the installation. The resulting installation screen will list the installation as successful or note any problems during the install.
* If successful, click "__Activate Plugin__" to activate it.
* 	Open the settings page for WooCommerce and click the "__Payment Gateways__" tab.
* 	Click on the sub tab for "__Becopay__".
*	Configure your "__Becopay__" settings. See below for details.


### Manual Installation
1. 	Download the plugin zip file
2. 	Login to your WordPress Admin. Click on __`Plugins > Add New`__ from the left hand menu.
3.  Click on the "__Upload__" option, then click "__Choose File__" to select the zip file from your computer. Once selected, press "__OK__" and press the "__Install Now__" button.
4.  Activate the plugin.
5. 	Open the settings page for WooCommerce and click the "__Payment Gateways__" tab.
6. 	Click on the sub tab for "__Becopay__".
7.	Configure your "__Becopay__" settings. See below for details.

### Configure the plugin
To configure the plugin, go to __WooCommerce > Settings__ from the left hand menu, then click "Payment Gateways" from the top tab. You should see __"Becopay"__ as an option at the top of the screen. Click on it to configure the payment gateway.

__*You can select the radio button next to Becopay from the list of payment gateways available to make it the default gateway.*__

* __Enable/Disable__ - check the box to enable Becopay Payment Gateway.
* __Title__ - allows you to determine what your customers will see this payment option as on the checkout page.
* __Description__ - controls the message that appears under the payment fields on the checkout page. Here you can list the types of cards you accept.
* __Mobile Number__  - enter the phone number you registered in the Becopay here.If you don't have Becopay merchat account register [here](https://becopay.com/en/merchant-register/).
* __Becopay Api Base Url__  - enter Becopay api base url here. If you don't have Becopay merchat account register [here](https://becopay.com/en/merchant-register/).
* __Becopay Api Key__  - enter your Becopay Api Key here. If you don't have Becopay merchat account register [here](https://becopay.com/en/merchant-register/).
* __Merchant Currency__  - enter your money's currency wants to receive.e.g: IRR, USD 
* Click on __Save Changes__ for the changes you made to be effected.

__Note:__<br>
The format of your callback link is in this format <br>
`https://your-site/wc-api/BecopayGateway/?orderId=ORDER_ID`

## Frequently Asked Questions
### What Do I Need To Use The Plugin

1.	You need to have the WooCommerce plugin installed and activated on your WordPress site.
2.	You need to open a merchant account on [Becopay](https://becopay.com/en/merchant-register/)

## Changelog

### 1.0.0
*   First release

### 1.1.0
*   Support currency

### 1.1.1
*   Check currency and convert currency

### 1.1.2
*   Fixed load language file