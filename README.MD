# Email Scraper
A PHP Library for scraping IP/Email addresses with ease.

NOTE! This is only intended for educational purposes. Please do not use this to gather emails for spam since nobody likes it.

## Features
- Validations
- Multi engine support
  - hQuery
- Parsers:
  - IP addresses along with the following data (if found from tables): 
    - Proxy protocol
    - Level of anonymity
    - Speed in ms
  - Forms
  - Links
  - Images
  - Stylesheets (+inline)
  - Scripts (+inline)
  - Fonts
  - Tables (+data)

## Installation

### Composer
```bash
composer require marcosraudkett/email-crawler
```

## Usage
Running the scraper is just as easy as running the following:
```php
$scraper = Scraper::getInstance()->run("https://example.com/");
$scraper->get(); // get full response
```
The example above scrapes the url and prints data in JSON.


If you wish to scrape specific resources (ip or email)
```php
$scraper = Scraper::getInstance()->run("https://example.com/");
// only emails
$scraper->get("email"); 
// only ip addresses
$scraper->get("ip");
```

## Scraping dynamic content
You could migrate from hQuery to headless JavaScript browser like CapserJS & Phantom to load dynamic content. This way you can also scrape data that is loaded dynamically (after the inital page load).

## Contributing
