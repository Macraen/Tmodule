<?php
namespace Macraen\Tmodule\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class LayoutProcessorPlugin
{
    public function afterProcess(LayoutProcessor $subject, array $jsLayout)
    {
        $attributeCode = 'switch_field';
        $jsLayout['components']['checkout']['children']['steps']['children']['my-new-step']['children']['field-group-custom']['children']['custom_checkbox_field'] = [
            'component' => 'Magento_Ui/js/form/element/checkbox-set',
            'config' => [
                'customScope' => 'customStepFields.custom_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/checkbox-set',
                'options' => [
                    [
                        'value' => '1',
                        'label' => 'I`m shipping for myself',
                    ],
                    [
                        'value' => '0',
                        'label' => 'I`m shipping for another person'
                    ]
                ],
                'value' => '1'
            ],
            'dataScope' => 'customStepFields.custom_attributes.' . $attributeCode,
            'provider' => 'checkoutProvider'
        ];

        return $jsLayout;
    }
}
