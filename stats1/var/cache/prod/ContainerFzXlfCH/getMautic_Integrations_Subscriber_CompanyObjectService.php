<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'mautic.integrations.subscriber.company_object' shared service.

return $this->services['mautic.integrations.subscriber.company_object'] = new \Mautic\IntegrationsBundle\EventListener\CompanyObjectSubscriber(($this->services['mautic.integrations.helper.company_object'] ?? $this->load('getMautic_Integrations_Helper_CompanyObjectService.php')), ($this->services['router'] ?? $this->getRouterService()));