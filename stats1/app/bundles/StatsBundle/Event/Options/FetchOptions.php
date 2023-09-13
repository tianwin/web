<?php

namespace Mautic\StatsBundle\Event\Options;

class FetchOptions
{
    /**
     * @var array
     */
    private $options = [];

    /**
     * @var int|null
     */
    private $itemId;

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setItemId($value)
    {
        $this->itemId = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @param null   $default
     *
     * @return mixed
     */
    public function getOption($key, $default = null)
    {
        if (isset($this->options[$key])) {
            return $this->options[$key];
        }

        return $default;
    }
}
