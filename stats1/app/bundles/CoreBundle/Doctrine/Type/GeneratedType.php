<?php

declare(strict_types=1);

namespace Mautic\CoreBundle\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Type that creates a read-only generated (virtual) column.
 */
class GeneratedType extends Type
{
    /**
     * @var string
     */
    const GENERATED = 'generated';

    /**
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        // Must be defined in `columnDefinition` option when adding the column in the subscriber
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    /**
     * @param mixed $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::GENERATED;
    }
}
