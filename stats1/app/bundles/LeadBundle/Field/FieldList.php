<?php

declare(strict_types=1);

namespace Mautic\LeadBundle\Field;

use Mautic\LeadBundle\Entity\LeadFieldRepository;
use Symfony\Component\Translation\TranslatorInterface;

class FieldList
{
    /**
     * @var LeadFieldRepository
     */
    private $leadFieldRepository;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(LeadFieldRepository $leadFieldRepository, TranslatorInterface $translator)
    {
        $this->leadFieldRepository = $leadFieldRepository;
        $this->translator          = $translator;
    }

    /**
     * @param mixed[] $filters
     *
     * @return mixed[]
     */
    public function getFieldList(bool $byGroup = true, bool $alphabetical = true, array $filters = ['isPublished' => true, 'object' => 'lead']): array
    {
        $forceFilters = [];
        foreach ($filters as $col => $val) {
            $forceFilters[] = [
                'column' => "f.{$col}",
                'expr'   => 'eq',
                'value'  => $val,
            ];
        }
        // Get a list of custom form fields
        $fields = $this->leadFieldRepository->getEntities([
             'filter' => [
                 'force' => $forceFilters,
             ],
             'orderBy'    => 'f.order',
             'orderByDir' => 'asc',
        ]);

        $leadFields = [];

        foreach ($fields as $f) {
            if ($byGroup) {
                $fieldName                              = $this->translator->trans('mautic.lead.field.group.'.$f->getGroup());
                $leadFields[$fieldName][$f->getAlias()] = $f->getLabel();
            } else {
                $leadFields[$f->getAlias()] = $f->getLabel();
            }
        }

        if ($alphabetical) {
            // Sort the groups
            uksort($leadFields, 'strnatcmp');

            if ($byGroup) {
                // Sort each group by translation
                foreach ($leadFields as &$fieldGroup) {
                    uasort($fieldGroup, 'strnatcmp');
                }
            }
        }

        return $leadFields;
    }
}
