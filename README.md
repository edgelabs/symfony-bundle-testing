# Symfony Bundle Testing

Light-weight Symfony2 application that you can use as the skeleton for your bundle tests. 
This code is based on eymengunay/symfony-test.

## Install & Configure

### Step 1: Add Symfony Bundle Testing to your project using composer

```
# composer require edgelabs/symfony-bundle-testing
```

### Step 2: Configure PHPUnit
Example phpunit.xml configuration:

```
<?xml version="1.0" encoding="UTF-8"?>
<!-- phpunit.xml -->
<phpunit backupGlobals="false"
         backupStaticAttributes="false"
         colors="true"
         convertErrorsToExceptions="true"
         convertNoticesToExceptions="true"
         convertWarningsToExceptions="true"
         processIsolation="false"
         stopOnFailure="false"
         syntaxCheck="false"
         bootstrap="Tests/bootstrap.php"
>
    <php>
        <server name="KERNEL_DIR" value="./vendor/edgelabs/symfony-bundle-testing/app" />
    </php>

    <testsuites>
        <testsuite name="Your Bundle Test Suite">
            <directory>./Tests/</directory>
        </testsuite>
    </testsuites>
    
    <filter>
        <!-- Ignore Code Coverage for these directories -->
        <whitelist>
            <directory>./</directory>
            <exclude>
                <directory>./Tests/</directory>
                <directory>./Resources/</directory>
                <directory>./DependencyInjection/</directory>
                <directory>./vendor/</directory>
            </exclude>
        </whitelist>
    </filter>
</phpunit>
```

### Step 3: Bootstrap your tests
Now that you have properly installed Symfony Test Edition and configured PHPUnit, the next step is to create a `bootstrap.php` file 
for your custom configuration and bundles:

```
<?php
// Tests/bootstrap.php

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    // dependencies were installed via composer - this is the main project
    $classLoader = require __DIR__ . '/../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/../../../autoload.php')) {
    // installed as a dependency in `vendor`
    $classLoader = require __DIR__ . '/../../../autoload.php';
} else {
    throw new Exception('Can\'t find autoload.php. Did you install dependencies via Composer?');
}

function registerBundles() {
    return array(
        new Acme\DemoBundle\AcmeDemoBundle(),
    );
}

// The part below is optional.
function registerContainerConfiguration($loader) {
    // If you need additional configuration
    // parameters you can load it here as you would normally do
    // with the Symfony Standard Edition
    // This function is optional.

    // A simple example:
    $loader->load(__DIR__ . "/config.yml");
}

?>
```

## Usage
You are now ready for executing your tests. For a real-world example you can have a look at [PassbookBundle](https://github.com/eymengunay/PassbookBundle).

## License
This bundle is under the MIT license. See the complete license in:

```
./LICENSE
```
