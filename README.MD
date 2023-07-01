<p align="center">
 <a href="https://antheta.com" target="_blank">
  <picture>
    <source media="(prefers-color-scheme: dark)" srcset="./assets/falcon.png">
    <img align="center" src="./assets/falcon.png" height="150">
  </picture>
</a>
</p>

Falcon is an open-source (MIT licensed) high-performance PHP web scraper with built-in parsers and extendability.

Please notice that this library is not intended to be used to gather emails or any other personal data for spam.

## Documentation

[Documentation](http://docs.antheta.com/)

## Features
- Extendable (Ability to create custom parsers & drivers).
- Custom regex support.
- Many different built-in parsers.
- Multi driver support (in development).
  - hQuery

## Installation

### Composer
```bash
composer require antheta/falcon
```

## Usage
Running the scraper:
```php
$falcon = Falcon::getInstance()->run("https://example.com/");
$result = $falcon->parse()->results(); // use all available parsers and get all results
```
The example above scrapes the url and returns an array.


### Use specific parsers
If you wish to get specific resources from the results
```php
$falcon = Falcon::getInstance()->run("https://example.com/");
// only returns emails
$emails = $falcon->parse(["email", "ip"])->emails(); 
```

## Methods

Helper methods for returning the results:
| Name | 
| - |
| results | 
| emails | 
| phonenumbers | 
| ipAddresses |
| forms |
| links |
| images |
| stylesheets |
| scripts |
| fonts |

## Custom regexes
To add your own regexes to parsers you can just use the `addRegexes` helper:

```php
// this will attempt to parse emails with the given regex
$falcon = Falcon::getInstance()
          ->addRegexes("email", ["/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-ddd]+/i"])
          ->run("https://example.com/")->parse()->emails();

// you can extend this to other parsers as well and add as many regexes as needed
$falcon = Falcon::getInstance()
            // regexes for emails
            ->addRegexes("email", [
              "/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-ddd]+/i",
              "/[\._a-zA-Z0-9-]+\(at\)[\._a-zA-Z0-9-]+/i",
            ])
            // regexes for phonenumbers
            ->addRegexes("phonenumber", [
              "/([\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,12})/",
            ])
            ->run("https://example.com/")
            ->parse()
            ->results();
```

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
$falcon->parse("myCustomParser")->results()["myCustomParser"];
```

## Custom drivers

Start by creating your own driver class that extends the `DriverInterface` interface and implement the driver specific logic within class.

```php
$falcon = Falcon::getInstance();

$falcon->addDrivers([
  "myDriver" => MyDriver::class
]);
```

## Scraping dynamic content
You could migrate from hQuery to headless JavaScript browser like CapserJS & Phantom to load dynamic content. This way you can also scrape data that is loaded dynamically (after the inital page load).

## Contributing
