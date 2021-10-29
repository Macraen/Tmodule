<?php

namespace Macraen\Tmodule\Model\ResourceModel\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Macraen\Tmodule\Model\Grid',
            'Macraen\Tmodule\Model\ResourceModel\Grid'
        );
    }
}
