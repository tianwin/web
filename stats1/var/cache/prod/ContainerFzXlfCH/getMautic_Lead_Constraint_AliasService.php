<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'mautic.lead.constraint.alias' shared service.

return $this->services['mautic.lead.constraint.alias'] = new \Mautic\LeadBundle\Form\Validator\Constraints\UniqueUserAliasValidator(($this->services['mautic.lead.repository.lead_list'] ?? $this->load('getMautic_Lead_Repository_LeadListService.php')), ($this->services['mautic.helper.user'] ?? $this->getMautic_Helper_UserService()));