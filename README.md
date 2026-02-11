# Trading212 API client library for PHP

Unofficial PHP API client library for the [Trading212](https://www.trading212.com) API service. 


## Install

```sh
composer require marekskopal/trading212
```

## Usage

```php
use MarekSkopal\Trading212\Trading212;
use MarekSkopal\Trading212\Config\Config;

// Create Trading212 instance
$trading212 = new Trading212(new Config('<yourApiKey>'));

// Get exchange list
$response = $trading212->instrumentsMetadata->exchangeList();
```

## Covered endpoints
More endpoints will be covered in future versions.

### Instruments Metadata

* GET Exchange List        ✅
* GET Instrument List      ✅

### Pies

* GET Fetch all pies       ✅
* POST Create pie          ✅
* DELETE Delete pie        ✅
* GET Fetch a pie          ✅
* POST Update pie          ✅

### Equity Orders
* GET Fetch all              ✅
* POST Place Limit order     ✅
* POST Place Market order    ✅
* POST Place Stop order      ✅
* POST Place StopLimit order ✅
* DELETE Cancel by ID        ✅
* GET Fetch by ID            ✅

### Account Data
* GET Fetch account cash     ✅
* GET Fetch account metadata ✅

### Personal Portfolio
* GET Fetch all open positions  ✅
* GET Fetch a specific position ✅

### Historical items

* GET Historical order data ✅
* GET Paid out dividends    ✅
* GET Exports List          ✅
* POST Export csv           ✅
* GET Transaction list      ✅

## Notice
This is NOT an official Trading212 library, and the authors of this library are not affiliated with Trading212 in any way, shape or form.

## Contributing
If you want to contribute, feel free to submit a pull request.
