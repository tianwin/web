<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'cache.app' shared service.

$this->services['cache.app'] = $instance = new \Symfony\Component\Cache\Adapter\FilesystemAdapter('ywm5bsMrZ5', 0, ($this->targetDir.''.'/pools'), ($this->privates['cache.default_marshaller'] ?? ($this->privates['cache.default_marshaller'] = new \Symfony\Component\Cache\Marshaller\DefaultMarshaller(NULL))));

$instance->setLogger(($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));

return $instance;
