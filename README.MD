# Email Scraper
A PHP Library for scraping IP/Email addresses with ease.

## Demo

## Features
- Parses emails and IP adresses.
- Email validation.
- Scrape IP addresses along with the following data (if found from tables): 
  - Proxy protocol
  - Level of anonymity
  - Speed in ms

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
// run and return JSON response
$scraper = (new \marcosraudkett\Scraper())->run($_GET["url"])->get();
```

If you wish to scrape specific resources (ip or email)
```php
$scraper = new \marcosraudkett\Scraper();
// only emails
$scraper->run($_GET["url"])->emails()->get();
// only ip addresses
$scraper->run($_GET["url"])->ips()->get();
```

You can also call the scraper statically:
```php
// only emails
Scraper::getInstance()->run($_GET["url"])->get();
```

## Scraping dynamic content
You could migrate from hQuery to headless JavaScript browser like CapserJS & Phantom to load dynamic content. This way you can also scrape data that is loaded dynamically (after the inital page load).

## Contributing
