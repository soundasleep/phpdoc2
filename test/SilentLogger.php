<?php

namespace PHPDoc2\Test;

use PHPDoc2\Parser;
use Monolog\Logger;

class SilentLogger extends \Monolog\Handler\AbstractHandler {
  function handle(array $record) {
    // does nothing unless error
    $message = $record['message'];
    if ($record['level'] >= Logger::WARNING) {
      if ($record['level'] >= Logger::ERROR) {
        $message = "[ERROR] " . $message;
      } else {
        $message = "[Warning] " . $message;
      }
      echo $message . "\n";
    }
  }
}