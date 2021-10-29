define(['ko', 'uiComponent', 'underscore', 'Magento_Checkout/js/model/step-navigator'],
    function(ko, Component, _, stepNavigator) {
        return Component.extend({
            defaults: {
                template: 'Macraen_Tmodule/mystep'
            },

            isVisible: ko.observable(true),

            initialize: function() {
                this._super();

                stepNavigator.registerStep(
                    'step_code',
                    null,
                    'Delivery info',
                    this.isVisible,
                    _.bind(this.navigate, this),
                    15
                );

                return this;
            },
            navigate: function() {

            },

            navigateToNextStep: function() {
                stepNavigator.next();
            }
        });
    });
