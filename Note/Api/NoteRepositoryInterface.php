<?php


namespace Belvg\Note\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface NoteRepositoryInterface
{


    /**
     * Save Note
     * @param \Belvg\Note\Api\Data\NoteInterface $note
     * @return \Belvg\Note\Api\Data\NoteInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Belvg\Note\Api\Data\NoteInterface $note);

    /**
     * Retrieve Note
     * @param string $noteId
     * @return \Belvg\Note\Api\Data\NoteInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($noteId);

    /**
     * Retrieve Note matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Belvg\Note\Api\Data\NoteSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Note
     * @param \Belvg\Note\Api\Data\NoteInterface $note
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Belvg\Note\Api\Data\NoteInterface $note);

    /**
     * Delete Note by ID
     * @param string $noteId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($noteId);
}
