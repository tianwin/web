<?php

namespace Mautic\PageBundle\Form\Type;

use Mautic\PageBundle\Helper\TrackingHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class TrackingPixelSendType.
 */
class TrackingPixelSendType extends AbstractType
{
    /**
     * @var TrackingHelper
     */
    protected $trackingHelper;

    /**
     * TrackingPixelSendType constructor.
     */
    public function __construct(TrackingHelper $trackingHelper)
    {
        $this->trackingHelper = $trackingHelper;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $trackingServices = $this->trackingHelper->getEnabledServices();

        $builder->add('services', ChoiceType::class, [
            'label'      => 'mautic.page.tracking.form.services',
            'label_attr' => ['class' => 'control-label'],
            'attr'       => [
                'class' => 'form-control',
            ],
            'expanded'    => false,
            'multiple'    => true,
            'choices'     => array_flip($trackingServices),
            'placeholder' => 'mautic.core.form.chooseone',
            'constraints' => [
                new NotBlank(
                    ['message' => 'mautic.core.ab_test.winner_criteria.not_blank']
                ),
            ],
            ]);

        $builder->add(
            'category',
            TextType::class,
            [
                'label'      => 'mautic.page.tracking.form.category',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'class'   => 'form-control',
                    'tooltip' => 'mautic.page.tracking.form.category.tooltip',
                ],
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ]
        );

        $builder->add(
            'action',
            TextType::class,
            [
                'label'      => 'mautic.page.tracking.form.action',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'class' => 'form-control',
                ],
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ]
        );

        $builder->add(
            'label',
            TextType::class,
            [
                'label'      => 'mautic.page.tracking.form.label',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'class' => 'form-control',
                ],
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ]
        );
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'tracking_pixel_send_action';
    }
}
