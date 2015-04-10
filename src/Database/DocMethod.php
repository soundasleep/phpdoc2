<?php

namespace PHPDoc\Database;

/**
 * Represents a method.
 */
class DocMethod extends AbstractDocElement {

  function __construct($name, $data) {
    if (!$name) {
      throw new \InvalidArgumentException("'$name' is not a valid method name");
    }

    $this->name = $name;
    $this->data = $data;
  }

  function setClass($class) {
    $this->class = $class;
  }

  function getClass() {
    return $this->class;
  }

  function getTitle($options) {
    throw new \Exception("DocMethods are not generated to HTML");
  }

  function getDatabase() {
    return $this->getClass()->getDatabase();
  }

  function getNamespace() {
    return $this->getClass()->getNamespace();
  }

  function getFilename() {
    if ($this->getClass() instanceof DocClass) {
      $type = "class";
    } else if ($this->getClass() instanceof DocInterface) {
      $type = "interface";
    } else {
      throw new \Exception("Unknown class instance " . get_class($this->getClass()));
    }
    return $type . "_" . $this->escape($this->getClass()->getNamespace()->getName()) . "_" . $this->escape($this->getClass()->getName()) . ".html#" . $this->escape($this->getName());
  }

  function getPrintableName() {
    $params = array();
    foreach ($this->data['params'] as $name => $data) {
      $params[] = '$' . $name;
    }
    return $this->getName() . "(" . implode(", ", $params) . ")";
  }

  function getElementType() {
    return "function";
  }

}
