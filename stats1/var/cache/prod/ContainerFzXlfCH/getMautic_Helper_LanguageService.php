<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'mautic.helper.language' shared service.

return $this->services['mautic.helper.language'] = new \Mautic\CoreBundle\Helper\LanguageHelper(($this->services['mautic.helper.paths'] ?? $this->getMautic_Helper_PathsService()), ($this->services['monolog.logger.mautic'] ?? $this->getMonolog_Logger_MauticService()), ($this->services['mautic.helper.core_parameters'] ?? ($this->services['mautic.helper.core_parameters'] = new \Mautic\CoreBundle\Helper\CoreParametersHelper($this))), ($this->services['mautic.http.client'] ?? ($this->services['mautic.http.client'] = new \GuzzleHttp\Client())), ($this->services['translator.default'] ?? $this->getTranslator_DefaultService()));
