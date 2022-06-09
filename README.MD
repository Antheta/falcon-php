# Email Scraper
A PHP Library for scraping IP/Email addresses with ease.

## Demo

## Features
- Matches multiple regexes.
- Email validation.
- Scrape IP addresses along with the following data (if found from tables): 
  - Proxy protocol
  - Level of anonymity
  - Speed in ms
- API for scraping sites with ease.

## Installation

## Setup

## Usage
Running the scraper is just as easy as running the following:
```php
$scraper = new \marcosraudkett\Scraper();
// run and return JSON response
$scraper->run($_GET["url"])->responseJson();
```
The example above scrapes the url and prints data in JSON.

Full example:
```php
// load classes (check the path)
require_once __DIR__ . '/path/to/init.php';
$scraper = new \marcosraudkett\Scraper();
// run and return JSON response
$scraper->run($_GET["url"])->responseJson();
```

If you wish to scrape specific resources (ip or email)
```php
// only emails
$scraper->onlyEmail()->run($_GET["url"])->responseJson();
// only ip addresses
$scraper->onlyIPAddress()->run($_GET["url"])->responseJson();
```

You can also call the scraper statically:
```php
// only emails
Scraper::getInstance()->run($_GET["url"])->responseJson();
```

## Scraping dynamic content
You could migrate from hQuery to headless JavaScript browser like CapserJS & Phantom to load dynamic content. This way you can also scrape data that is loaded dynamically (after the inital page load).

## Contributing
