# papertrail-php
Let you log in your papertrail log server

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

## Severity levels constants list
- `Papertrail::SEVERITY_EMERGENCY`
- `Papertrail::SEVERITY_ALERT`
- `Papertrail::SEVERITY_CRITICAL`
- `Papertrail::SEVERITY_ERROR`
- `Papertrail::SEVERITY_WARNING`
- `Papertrail::SEVERITY_NOTICE`
- `Papertrail::SEVERITY_INFORMATIONAL`
- `Papertrail::SEVERITY_DEBUG`
