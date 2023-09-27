# phpunit-tap

A TAP extension for phpunit 10+. Based on [gh640/phpunit-tap](https://github.com/gh640/phpunit-tap) (which works for phpunit 9).

## Usage
```sh
composer require --dev nikeee/phpunit-tap
```

To print the TAP output to a file (for example, `output.tap`), add the bootstrap to your `phpunit.xml`:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit>
  <extensions>
    <bootstrap class="nikeee\PhpunitTap\TapExtension">
        <parameter name="fileName" value="output.tap"/>
    </bootstrap>
  </extensions>
</phpunit>
```

To print the results to stdout, omit the parameter:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit>
  <extensions>
    <bootstrap class="nikeee\PhpunitTap\TapExtension" />
  </extensions>
</phpunit>
```
