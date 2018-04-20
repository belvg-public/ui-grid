<?php


namespace Belvg\Note\Model\ResourceModel\Note;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Belvg\Note\Model\Note',
            'Belvg\Note\Model\ResourceModel\Note'
        );
    }
}
