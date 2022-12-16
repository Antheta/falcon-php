# Email Scraper
A PHP Library for scraping IP/Email addresses with ease.

NOTE! This is only intended for educational purposes. Please do not use this to gather emails for spam since nobody likes it.

## Features
- Validations
- Multi "engine" support
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
$result = $scraper->get(); // get full response
```
The example above scrapes the url and returns an array.


### Specific results
If you wish to get specific resources from the results
```php
$scraper = Scraper::getInstance()->run("https://example.com/");
// only emails
$emails = $scraper->get("email"); 
// only ip addresses
$ips = $scraper->get("ip");
```

### Using specific parsers
```php
$scraper = Scraper::getInstance()->run("https://example.com/");
// this will only parse emails (see full list of parsers below)
$emails = $scraper->get(null, ["email"]); 
```

## Parsers

List of parsers:
| Name | 
| - |
| email | 
| ip |
| form |
| link |
| image |
| stylesheet |
| script |
| font |
| from |

## Custom parsers
If you wish to add new parsers then you can ...

## Scraping dynamic content
You could migrate from hQuery to headless JavaScript browser like CapserJS & Phantom to load dynamic content. This way you can also scrape data that is loaded dynamically (after the inital page load).

## Contributing
