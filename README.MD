<p align="center">
 <a href="https://roadrunner.dev" target="_blank">
  <picture>
    <source media="(prefers-color-scheme: dark)" srcset="https://user-images.githubusercontent.com/7326800/205905278-3899e2c8-5c15-4347-820b-a8ea4c5ba2d7.png">
    <img align="center" src="./assets/falcon.png" height="150">
  </picture>
</a>
</p>

Falcon is an open-source (MIT licensed) high-performance PHP web scraper with built-in parsers and extendability.

NOTE! This is only intended for educational purposes. Please do not use this to gather emails for spam since nobody likes it.

## Features
- Hackable
- Validations
- Multi driver support
  - simple_html_dom
  - hQuery
  - CasperJs
- Built in parsers:
  - Email addresses
  - Phonenumbers
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
composer require antheta/falcon
```

## Usage
Running the scraper:
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

### Only using specific parsers
```php
$scraper = Scraper::getInstance()->run("https://example.com/");
// this will only parse emails (see full list of parsers below)
$emails = $scraper->get(null, ["email"]); 

// or by disabling certain parsers
$scraper->disableParsers(["form", "link"])->get();
```

## Parsers

List of built-in parsers:
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
You can also add your own logic:

```php
$scraper = Scraper::getInstance();

$scraper->addParser("myCustomParser", fn ($payload) => MyParser($payload));

function MyParser($payload) {
  // your custom logic here
}

// or
$scraper->addParser("myCustomParser", function($payload) {
  // your custom logic here
});

// result from your parser
$scraper->get("myCustomParser");
```

## Custom drivers

Start by creating your own driver class that extends the `Driver` interface and implement the driver specific logic within class.

```php
$scraper = Scraper::getInstance();

$scraper->addDrivers([
  "myDriver" => MyDriver::class
]);
```

## Scraping dynamic content
You could migrate from hQuery to headless JavaScript browser like CapserJS & Phantom to load dynamic content. This way you can also scrape data that is loaded dynamically (after the inital page load).

## Contributing
