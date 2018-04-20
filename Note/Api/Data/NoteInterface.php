<?php


namespace Belvg\Note\Api\Data;

interface NoteInterface
{

    const CUSTOMER_ID = 'customer_id';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const NOTE_ID = 'note_id';


    /**
     * Get note_id
     * @return string|null
     */
    public function getNoteId();

    /**
     * Set note_id
     * @param string $noteId
     * @return \Belvg\Note\Api\Data\NoteInterface
     */
    public function setNoteId($noteId);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Belvg\Note\Api\Data\NoteInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \Belvg\Note\Api\Data\NoteInterface
     */
    public function setTitle($title);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Belvg\Note\Api\Data\NoteInterface
     */
    public function setDescription($description);
}
