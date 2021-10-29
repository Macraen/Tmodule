define([
    'Magento_Ui/js/form/element/checkbox-set',
    'mage/translate'
], function (AbstractField, $t) {
    'use strict';

    return AbstractField.extend({
        defaults: {
            streetLabels: [$t('Company / Section / Unit'), $t('Post Sector Type'), $t('Post Sector')],
            modules: {
                checkbox: '${ $.parentName }.billing-address-same-as-shipping',
            }
        },

        updateCheckbox: function () {
            if (this.value()) {
                this.checkbox().checkable(false);
            } else {
                this.checkbox().checkable(false);
            }
        },

        onCheckedChanged: function () {
            this._super();
            this.updateCheckbox();
        }
    });
});
