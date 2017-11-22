# Omnipay: PayBoutique

**PayBoutique driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/siqwell/omnipay-payboutique.png?branch=master)](https://travis-ci.org/siqwell/omnipay-payboutique)
[![Latest Stable Version](https://poser.pugx.org/siqwell/omnipay-payboutique/version.png)](https://packagist.org/packages/siqwell/omnipay-payboutique)
[![Total Downloads](https://poser.pugx.org/siqwell/omnipay-payboutique/d/total.png)](https://packagist.org/packages/siqwell/omnipay-payboutique)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Stripe support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "omnipay/stripe": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* [Payboutique](https://sites.google.com/a/payboutique.com/paybwiki/wiki/xml_v0-5)

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

### Purchase

The PayBoutique integration is fairly straight forward.

```php
$gateway->setLive('false'); // Live mode
$gateway->setPassword('qwerty'); // Merchant Password
$gateway->setUserId('123'); // User ID
$gateway->setMerchantId('456'); // Merchant ID
$gateway->setSiteAddress('merchant.com'); // Your site address

$response = $gateway->purchase([
    'amount' => '10.00',
    'currency' => 'USD', // USD, RUB, EUR, etc.
    'paymentMethod' => 'CreditCard', // Qiwi, CreditCard, YandexMoney, BankTransfer
    'returnUrl' => 'http://finmaxbo.com/good', // Redirect to success page
    'cancelUrl' => 'http://finmaxbo.com/bad', // Redirect to failed page
    'notifyUrl' => 'http://finmaxbo.com/notify', // Notify URL
    'description' => 'Description'
])->send();
```

### Complete Purchase

PayBoutique will send POST responce to your notify URL with just one field "xml".
You should answer with status 200 and just "OK" in response body, if payment signature is correct.
```php
$response = $gateway->completePurchase([
   'transactionReference' => $_POST['xml']
])->send();

echo $response->getMessage();
```



## Test Mode

Just pass parameter "live" as "false" to use merchant in test mode.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/siqwell/omnipay-payboutique/issues),
or better yet, fork the library and submit a pull request.
