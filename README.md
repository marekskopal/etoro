# eToro API client library for PHP

Unofficial PHP API client library for the [eToro](https://www.etoro.com) API service.


## Install

```sh
composer require marekskopal/etoro
```

## Usage

```php
use MarekSkopal\Etoro\Etoro;
use MarekSkopal\Etoro\Config\Config;

// Create Etoro instance
$etoro = new Etoro(new Config(apiKey: '<yourApiKey>', userKey: '<yourUserKey>'));

// Search instruments by symbol
$response = $etoro->marketData->searchBySymbol('AAPL');
```

## Covered endpoints

### Market Data

* GET Search instruments           ✅
* GET Search instruments by symbol ✅
* GET Rates                        ✅
* GET Candles                      ✅
* GET Instruments metadata         ✅
* GET Instrument types             ✅
* GET Closing prices               ✅
* GET Exchanges                    ✅
* GET Stocks industries            ✅

### Trading

* GET Portfolio                          ✅
* GET Portfolio PnL                      ✅
* POST Open order by amount              ✅
* POST Open order by units               ✅
* POST Close position                    ✅
* POST Place market if touched order     ✅
* DELETE Cancel open order               ✅
* DELETE Cancel close order              ✅
* DELETE Cancel market if touched order  ✅
* GET Order info                         ✅
* GET Trade history                      ✅

### Watchlists

* GET Fetch all watchlists                   ✅
* GET Fetch a watchlist                      ✅
* POST Create watchlist                      ✅
* POST Add items                             ✅
* DELETE Remove items                        ✅
* PUT Rename watchlist                       ✅
* PUT Change rank                            ✅
* PUT Set default                            ✅
* DELETE Delete watchlist                    ✅
* GET Public watchlists                      ✅
* GET Public watchlist                       ✅
* GET Default watchlist items                ✅
* POST Create default watchlist with items   ✅
* POST Create watchlist and set as default   ✅
* PUT Update items                           ✅

### Feeds

* GET Instrument feed posts     ✅
* GET User feed posts           ✅
* POST Create discussion post   ✅
* POST Create comment on post   ✅

### Users Info

* GET Search users              ✅
* GET User profiles             ✅
* GET User live portfolio       ✅
* GET User trade info           ✅
* GET User gain                 ✅
* GET User daily gain           ✅

### PI Data

* GET Copiers public info       ✅

### Curated Lists

* GET Fetch curated lists       ✅

### Market Recommendations

* GET Fetch recommendations     ✅

## Notice
This is NOT an official eToro library, and the authors of this library are not affiliated with eToro in any way, shape or form.

## Contributing
If you want to contribute, feel free to submit a pull request.
