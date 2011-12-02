Jbuilder (for PHP)
========

A PHP port based loosely on the [original](https://github.com/rails/jbuilder):

> Jbuilder gives you a simple DSL for declaring JSON structures that beats massaging giant hash structures. This is particularly helpful when the generation process is fraught with conditionals and loops. Here's a simple example:

``` php
<?php

$json = JBuilder::encode(function($json) {
  $json->name = 'Dennis';

  $json->address(function($json) {
    $json->street = 'Cambridge St';
    $json->city = 'Melbourne';
  });

  $json->comments(array("hello", "world"), function($json, $comment) {
    return "Comment: ".$comment;
  });
});
```

This will build the following structure:

``` javascript
{
  "address": {
    "city": "Melbourne", 
    "street": "Cambridge St"
  }, 
  "comments": [
    "Comment: hello", 
    "Comment: world"
  ], 
  "name": "Dennis"
}
```

Tests
----

Tests are located in the tests subdirectory.

You'll need to install PHPUnit before running the tests: http://www.phpunit.de/manual/3.5/en/installation.html

Then run the tests like this:

    phpunit
