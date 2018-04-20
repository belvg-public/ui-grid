<?php


namespace Belvg\Note\Model\ResourceModel;

class Note extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('belvg_note_note', 'note_id');
    }
}
