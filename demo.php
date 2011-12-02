<?php

require_once "lib/JBuilder.php";

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

echo "$json\n";
