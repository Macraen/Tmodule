<?php
namespace Macraen\Tmodule\Plugin\Checkout;

class LayoutProcessorCheckbox
{
    /**
     * Checkout LayoutProcessor after process plugin.
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $processor
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $processor, $jsLayout)
    {
        $shippingConfiguration = &$jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
        ['children']['shippingAddress']['children']['shipping-address-fieldset']['children'];
        $billingConfiguration = &$jsLayout['components']['checkout']['children']['steps']['children']['billing-step']
        ['children']['payment']['children']['payments-list']['children'];
        $customConfiguration = &$jsLayout['components']['checkout']['children']['steps']['children']['my-new-step']['children']['field-group-custom']['children']['custom_checkbox_field'];

        if (isset($customConfiguration)) {
            $customConfiguration = $this->processCheckbox(
                $customConfiguration,
                'field-group-custom',
                [
                    'checkoutProvider',
                    'checkout.steps.billing-step.payment.payments-list.form-fields.billing-address-same-as-shipping'
                ]
            );
        }

        //Checks if shipping step available.
        if (isset($shippingConfiguration)) {
            $shippingConfiguration = $this->processAddress(
                $shippingConfiguration,
                'shippingAddress',
                [
                    'checkoutProvider',
                    'checkout.steps.shipping-step.shippingAddress.shipping-address-fieldset.street',
                    'checkout.steps.shipping-step.shippingAddress.shipping-address-fieldset.city',
                    'checkout.steps.shipping-step.shippingAddress.shipping-address-fieldset.country_id',
//                    'checkout.steps.my-new-step.field-group-custom.custom_checkbox_field.billing-address-same-as-shipping'
                ]
            );
        }

        //Checks if billing step available.
        if (isset($billingConfiguration)) {
            //Iterate over billing forms.
            foreach($billingConfiguration as $key => &$billingForm) {
                //Exclude not billing forms
                if (!strpos($key, '-form')) {
                    continue;
                }

                $billingForm['children']['form-fields']['children'] = $this->processAddress(
                    $billingForm['children']['form-fields']['children'],
                    $billingForm['dataScopePrefix'],
                    [
                        'checkoutProvider',
                        'checkout.steps.billing-step.payment.payments-list.' . $key . '.form-fields.street',
                        'checkout.steps.billing-step.payment.payments-list.' . $key . '.form-fields.city',
                        'checkout.steps.billing-step.payment.payments-list.' . $key . '.form-fields.country_id',
                        'checkout.steps.billing-step.payment.payments-list.' . $key . '.form-fields.billing-address-same-as-shipping'
                    ]
                );
            }
        }

        return $jsLayout;
    }

    /**
     * Process provided address to contains checkbox and have trackable address fields.
     *
     * @param $addressFieldset - Address fieldset config.
     * @param $dataScope - data scope
     * @param $deps - list of dependencies
     * @return array
     */
    private function processAddress($addressFieldset, $dataScope, $deps)
    {
        //Creates checkbox.
        $addressFieldset['custom_checkbox'] = [
            'component' => 'Macraen_Tmodule/js/single-checkbox',
            'config' => [
                'customScope' => $dataScope,
                'template' => 'ui/form/field',
                'prefer' => 'checkbox'
            ],
            'dataScope' => $dataScope . '.custom_checkbox',
            'deps' => $deps,
            'label' => __('Custom Address'),
            'provider' => 'checkoutProvider',
            'visible' => true,
            'initialValue' => false,
            'sortOrder' => 10,
            'valueMap' => [
                'true' => true,
                'false' => false
            ]
        ];

        //Makes each address field label trackable.
        if (isset($addressFieldset['street']['children'])) {
            foreach($addressFieldset['street']['children'] as $key => $street) {
                $street['tracks']['label'] = true;
                //Remove .additional class. Can be removed, but style fix provided instead.
                $street['additionalClasses'] = '';
                $addressFieldset['street']['children'][$key] = $street;
            }
        }

        return $addressFieldset;
    }
    private function processCheckbox($deliveryFieldset, $dataScope, $deps)
    {
        //Creates checkbox.
        $deliveryFieldset['custom_checkbox'] = [
            'component' => 'Macraen_Tmodule/js/single-checkbox',
            'config' => [
                'customScope' => $dataScope,
                'template' => 'ui/form/field',
                'prefer' => 'checkbox'
            ],
            'dataScope' => $dataScope . '.custom_checkbox',
            'deps' => $deps,
            'label' => __('Custom Address'),
            'provider' => 'checkoutProvider',
            'visible' => true,
            'initialValue' => false,
            'sortOrder' => 10,
            'valueMap' => [
                'true' => true,
                'false' => false
            ]
        ];

        return $deliveryFieldset;
    }
}
