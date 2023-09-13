<?php

declare(strict_types=1);

namespace Mautic\CoreBundle\Templating\Twig\Extension;

use Mautic\CoreBundle\Templating\Helper\SlotsHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SlotExtension extends AbstractExtension
{
    /**
     * @var SlotsHelper
     */
    protected $helper;

    public function __construct(SlotsHelper $slotsHelper)
    {
        $this->helper = $slotsHelper;
    }

    /**
     * @see Twig_Extension::getFunctions()
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('slot', [$this, 'getSlot'], ['is_safe' => ['html']]),
            new TwigFunction('slotHasContent', [$this, 'slotHasContent'], ['is_safe' => ['html']]),
        ];
    }

    public function getName()
    {
        return 'slot';
    }

    public function getSlot($name, $default = null)
    {
        ob_start();

        $this->helper->output($name, $default);

        return ob_get_clean();
    }

    public function slotHasContent($name)
    {
        return $this->helper->hasContent($name);
    }
}
