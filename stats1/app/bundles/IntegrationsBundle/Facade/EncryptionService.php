<?php

declare(strict_types=1);

namespace Mautic\IntegrationsBundle\Facade;

use Mautic\CoreBundle\Helper\EncryptionHelper;

class EncryptionService
{
    /**
     * @var EncryptionHelper
     */
    private $encryptionHelper;

    /**
     * EncryptionService constructor.
     */
    public function __construct(EncryptionHelper $encryptionHelper)
    {
        $this->encryptionHelper = $encryptionHelper;
    }

    /**
     * @param mixed $keys
     *
     * @return array|string
     */
    public function encrypt($keys)
    {
        if (!is_array($keys)) {
            return $this->encryptionHelper->encrypt($keys);
        }

        foreach ($keys as $name => $key) {
            $keys[$name] = $this->encryptionHelper->encrypt($key);
        }

        return $keys;
    }

    /**
     * @param      $keys
     * @param bool $onlyPrimaryCipher
     *
     * @return array|string
     */
    public function decrypt($keys, $onlyPrimaryCipher = false)
    {
        if (!is_array($keys)) {
            return $this->encryptionHelper->decrypt($keys, $onlyPrimaryCipher);
        }

        foreach ($keys as $name => $key) {
            $keys[$name] = $this->encryptionHelper->decrypt($key, $onlyPrimaryCipher);
        }

        return $keys;
    }
}
