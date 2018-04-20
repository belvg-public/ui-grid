<?php


namespace Belvg\Note\Api\Data;

interface NoteSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Note list.
     * @return \Belvg\Note\Api\Data\NoteInterface[]
     */
    public function getItems();

    /**
     * Set customer_id list.
     * @param \Belvg\Note\Api\Data\NoteInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
