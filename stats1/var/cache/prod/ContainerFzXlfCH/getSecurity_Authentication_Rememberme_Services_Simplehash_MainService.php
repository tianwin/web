<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'security.authentication.rememberme.services.simplehash.main' shared service.

return $this->privates['security.authentication.rememberme.services.simplehash.main'] = new \Symfony\Component\Security\Http\RememberMe\TokenBasedRememberMeServices([0 => ($this->services['mautic.user.provider'] ?? $this->getMautic_User_ProviderService())], $this->getEnv('nullable:resolve:MAUTIC_REMEMBERME_KEY'), 'main', ['lifetime' => $this->getEnv('int:resolve:MAUTIC_REMEMBERME_LIFETIME'), 'path' => $this->getEnv('nullable:resolve:MAUTIC_REMEMBERME_PATH'), 'domain' => $this->getEnv('nullable:resolve:MAUTIC_REMEMBERME_DOMAIN'), 'name' => 'REMEMBERME', 'secure' => false, 'httponly' => true, 'samesite' => NULL, 'always_remember_me' => false, 'remember_me_parameter' => '_remember_me'], ($this->privates['monolog.logger.security'] ?? $this->load('getMonolog_Logger_SecurityService.php')));
