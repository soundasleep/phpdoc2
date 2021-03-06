<?php

namespace PHPDoc2\Database;

use Monolog\Logger;

/**
 * Represents a namespace.
 */
abstract class AbstractDocElement implements Visible {

  /**
   * @return the type of doc element to display in {@link #getModifiers()},
   *      e.g. 'function', 'class', 'interface'
   */
  abstract function getElementType();

  /**
   * Make the given string filename-safe.
   * @param $s any arbitrary string
   */
  function escape($s) {
    return preg_replace("#[^a-zA-Z0-9_]#", "_", $s);
  }

  function getName() {
    return $this->name;
  }

  function getData() {
    return $this->data;
  }

  function getDoc($key) {
    if (isset($this->data['doc'][$key]) && $this->data['doc'][$key]) {
      return $this->data['doc'][$key];
    }
    // we can't find anything
    return null;
  }

  function getModifiers() {
    $modifiers = array();
    if (isset($this->data['public']) && $this->data['public']) {
      $modifiers[] = "public";
    }
    if (isset($this->data['protected']) && $this->data['protected']) {
      $modifiers[] = "protected";
    }
    if (isset($this->data['private']) && $this->data['private']) {
      $modifiers[] = "private";
    }
    if (isset($this->data['abstract']) && $this->data['abstract']) {
      $modifiers[] = "abstract";
    }
    if (isset($this->data['static']) && $this->data['static']) {
      $modifiers[] = "static";
    }
     if (isset($this->data['final']) && $this->data['final']) {
      $modifiers[] = "final";
    }
    $modifiers[] = $this->getElementType();
    return implode(" ", $modifiers);
  }

  var $warnings;

  function addWarning($s) {
    $this->warnings[] = $s;
  }

  function getWarnings() {
    return $this->warnings;
  }

  /**
   * So this can be used in {@link array_unique()}, etc.
   */
  function __toString() {
    $bits = array();
    $bits[] = $this->getElementType();
    if ($this instanceof DocClasslike) {
      $bits[] = $this->getNamespace()->getName();
    }
    $bits[] = $this->getName();
    return implode(" ", $bits);
  }

  function getInheritedDoc(Logger $logger, $key) {
    $method = $this->getInheritedDocElement($logger, $key);
    if ($method) {
      return $method->getDoc($key);
    } else {
      return null;
    }
  }

  abstract function getInheritedDocElement(Logger $logger, $key);

  function getPrintableName() {
    return $this->getName();
  }

}
