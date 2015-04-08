<h1>PHPDoc</h1>

<dl>
  <dt>Namespaces</dt>
  <dd><?php echo count($database->getNamespaces()); ?></dd>
</dl>

<h2>Namespaces</h2>

<ul>
<?php
  foreach ($database->getNamespaces() as $namespace) {
    echo "<li>";
    echo $this->linkTo($namespace->getFilename(), $namespace->getName());
    echo " - " . $this->plural(count($namespace->getClasses()), "class", "classes");
    echo "</li>";
  }
?>
</ul>