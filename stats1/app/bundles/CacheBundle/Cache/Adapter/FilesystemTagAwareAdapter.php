<?php

declare(strict_types=1);

namespace Mautic\CacheBundle\Cache\Adapter;

use Symfony\Component\Cache\Adapter\TagAwareAdapter;

class FilesystemTagAwareAdapter extends TagAwareAdapter
{
    public function __construct(?string $prefix, int $lifetime = 0, string $directory = null)
    {
        $prefix = 'app_cache_'.$prefix;

        parent::__construct(
            new \Symfony\Component\Cache\Adapter\FilesystemAdapter($prefix, $lifetime, $directory),
            new \Symfony\Component\Cache\Adapter\FilesystemAdapter($prefix.'_tags')
        );
    }
}
