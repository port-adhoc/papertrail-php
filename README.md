# Warning

This package is abandoned for a more reliable, standardized and tested package. Please refer to [khalyomede/syslog](https://github.com/khalyomede/syslog) as an alternative as this package will now loose its support.

# papertrail-php
Let you log in your papertrail log server

[![Packagist](https://img.shields.io/packagist/v/port-adhoc/papertrail.svg)]()

## Requirements
- You will need to activate the `php_sockets` extension by uncommenting the line in the `php.ini` file.
- You will need to use Composer for this package.

## Installation
Execute `composer require port-adhoc/papertrail` from the prompt command in your project folder.

## Examples
- [Example of usage 1 : basic example](#example-of-usage-1--basic-example)
- [Example of usage 2 : sending multiple message in one script](#example-of-usage-2--sending-multiple-message-in-one-script)

### Example of usage 1 : basic example
```php
require( __DIR__ . '/vendor/autoload.php' );

use PortAdhoc\Papertrail;

Papertrail::host('example.papertrailapp.com')
  ->port(123456)
  ->facility(99)
  ->program('cron')
  ->component('spam-cleaning')
  ->message('hello world')
  ->severity( Papertrail::SEVERITY_DEBUG )
  ->send();
```

Refer to the [Severity levels constants list](#severity-levels-constants-list) for more severity levels.

[back to the example list](#examples)

### Example of usage 2 : sending multiple message in one script
```php
require( __DIR__ . '/vendor/autoload.php' );

use PortAdhoc\Papertrail;

Papertrail::host('example.papertrailapp.com')
  ->port(123456)
  ->facility(99)
  ->program('cron')
  ->component('spam-cleaning');

// a few moments later

Papertrail::message('fetching table done')
  ->severity( Papertrail::SEVERITY_DEBUG )
  ->send();

// an eternity later

Papertrail::message('cleaning table done')
  ->severity( Papertrail::SEVERITY_DEBUG )
  ->send();
```

Refer to the [Severity levels constants list](#severity-levels-constants-list) for more severity levels.

[back to the example list](#examples)

## Known issues
- [Timezone error](#timezone-error)

### Timezone error
If you ran into a similar error :

```
It is not safe to rely on the system's timezone settings. You are required to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected the timezone 'UTC' for now, but please set date.timezone to select your timezone.
```

Please use [`date_default_timezone_set()`](http://php.net/manual/en/function.date-default-timezone-set.php) to globally set your timezone. 

## Severity levels constants list
- `Papertrail::SEVERITY_EMERGENCY`
- `Papertrail::SEVERITY_ALERT`
- `Papertrail::SEVERITY_CRITICAL`
- `Papertrail::SEVERITY_ERROR`
- `Papertrail::SEVERITY_WARNING`
- `Papertrail::SEVERITY_NOTICE`
- `Papertrail::SEVERITY_INFORMATIONAL`
- `Papertrail::SEVERITY_DEBUG`
