# Omnipay: PagSeguro
**PagSeguro driver for the Omnipay PHP payment processing library** 

[Omnipay] is a framework agnostic, multi-gateway payment
processing library for PHP. This package implements PagSeguro support for Omnipay.


## Installation

Omnipay is installed via [Composer]. To install, simply require `league/omnipay` and `jerfeson/omnipay-pagseguro` with Composer:

```
composer require league/omnipay jerfeson/omnipay-pagseguro
```

## Basic Usage

For general usage instructions, please see the main [Omnipay]
repository.

##Sample


```php
// purchase
    
$params = $this->getParams();
$gateway = $this->getGateway();

$items = [];
foreach ($params->items as $item) {
    $items[] = [
        'number' => $item->id, // 1, 2
        'quantity' => $item->quantity, // 10, 20
        'name' => $item->name, // sample product 1, sample product 2
        'description' => $item->description, // sample description 1, sample description 2
        'price' => $item->price, // 10.00, 40.00
        'weight' => $item->weight // 1, 1
    ];
}

$response = $gateway->purchase(
    [
        'transactionId' => $params->id, // 1
        'amount' => $params->value, //50.00
        'currency' => $params->currency, //BRL
        'returnUrl' => 'http://example.com/return',
        'cancelUrl' => 'http://example.com/cancel',
        'NotifyUrl' => 'http://example.com/notify',
        'items' => $items
    ]
)->send();

```

## Roadmap

 - [ ] more methods
 - [ ] more code examples
 
## Contributing

 - welcome to discuss a bugs, features and ideas.
 
  
## License

jerfeson/omnipay-pagseguro is release under the MIT license.
 
## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow]. Be sure to add the
[omnipay tag] so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list] which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker],
or better yet, fork the library and submit a pull request.

[Omnipay]:https://github.com/thephpleague/omnipay
[Stack Overflow]:http://stackoverflow.com/
[omnipay tag]:http://stackoverflow.com/questions/tagged/omnipay
[mailing list]:https://groups.google.com/forum/#!forum/omnipay
[GitHub issue tracker]:https://github.com/jerfeson/omnipay-pagseguro/issues
[Composer]:http://getcomposer.org/
