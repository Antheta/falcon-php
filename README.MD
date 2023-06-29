<p align="center">
 <a href="https://antheta.com" target="_blank">
  <picture>
    <source media="(prefers-color-scheme: dark)" srcset="./assets/falcon.png">
    <img align="center" src="./assets/falcon.png" height="150">
  </picture>
</a>
</p>

Falcon is an open-source (MIT licensed) high-performance PHP web scraper with built-in parsers and extendability.

NOTE! This is only intended for educational purposes. Please do not use this to gather emails for spam since nobody likes it.

## Features
- Hackable
- Extendable (Ability to create custom parsers & drivers)
- Validations
- Multi driver support
  - hQuery
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
$falcon = Falcon::getInstance()->run("https://example.com/");
$result = $falcon->parse(); // parse full response
```
The example above scrapes the url and returns an array.


### Use specific parsers
If you wish to get specific resources from the results
```php
$falcon = Falcon::getInstance()->run("https://example.com/");
// only emails
$emails = $falcon->parse(["email", "ip"]); 
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
$falcon = Falcon::getInstance();

$falcon->addParser("myCustomParser", fn ($payload) => MyParser($payload));

function MyParser($payload) {
  // your custom logic here
}

// or
$falcon->addParser("myCustomParser", function($payload) {
  // your custom logic here
});

// result from your parser
$falcon->get("myCustomParser");
```

## Custom drivers

Start by creating your own driver class that extends the `Driver` interface and implement the driver specific logic within class.

```php
$falcon = Falcon::getInstance();

$falcon->addDrivers([
  "myDriver" => MyDriver::class
]);
```

## Scraping dynamic content
You could migrate from hQuery to headless JavaScript browser like CapserJS & Phantom to load dynamic content. This way you can also scrape data that is loaded dynamically (after the inital page load).

## Contributing
