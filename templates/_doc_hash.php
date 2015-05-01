<?php

// try fqn
// e.g. @see Namespace\Class
$discovered_class = $database->findClasslike($see_class, $logger);
if (!$discovered_class) {
  // try our local namespace
  // e.g. @see Class
  $discovered_class = $database->findClasslike($doc_reference->getNamespace()->getName() . "\\" . $see_class, $logger);
}

if (!$discovered_class) {
  // try method search
  // e.g. @see Namespace\Class#method
  $discovered_method = $database->findMethod($see_class, $logger);
  if (!$discovered_method) {
    // try our local namespace
    // e.g. @see Class#method
    $discovered_method = $database->findMethod($doc_reference->getNamespace()->getName() . "\\" . $see_class, $logger);
  }
  if (!$discovered_method) {
    // try our local namespace + Class
    // e.g. @see #method
    $discovered_method = $database->findMethod($doc_reference->getNamespace()->getName() . "\\" . $doc_reference->getClass()->getName() . $see_class, $logger);
  }
}

if ($discovered_class) {
  echo $generator->linkTo($discovered_class->getFilename(), $discovered_class->getPrintableName());
} else if ($discovered_method) {
  echo $generator->linkTo($discovered_method->getFilename(), $discovered_method->getPrintableName());
} else {
  echo $generator->formatInline($doc_reference, $see_class);
}

if ($description) {
  echo " - " . $generator->formatInline($doc_reference, $description);
}
