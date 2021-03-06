<?php

namespace PHPDoc2\Test\Database;

use Monolog\Logger;
use PHPDoc2\Test\SilentLogger;
use PHPDoc2\Database\Database;
use PHPDoc2\Database\DocNamespace;
use PHPDoc2\Database\DocClass;
use PHPDoc2\Database\DocMethod;

abstract class SetupDatabase extends \PHPUnit_Framework_TestCase {

  function setUp() {
    $this->logger = new \Monolog\Logger("test");
    $this->logger->pushHandler(new SilentLogger());

    $json = array(
      'namespaces' => array(
        'Empty' => array(
          'classes' => array(
            'Foo' => array(
              'methods' => array(
                'foo' => array(
                  'doc' => array(
                    'title' => 'Found it',
                  ),
                ),
              ),
            ),
            'Bar' => array(
              'extends' => 'Empty\\Foo',
            ),
            'Baz' => array(
              'extends' => 'Empty\\Foo',
              'methods' => array(
                'foo' => array(
                  'doc' => array(
                    'title' => 'Overridden',
                  ),
                ),
              ),
            )
          ),
        ),
      ),
    );

    $this->database = new Database("Sample database", $json);
  }

}
