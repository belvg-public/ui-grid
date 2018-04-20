<?php


namespace Belvg\Note\Model;

use Belvg\Note\Api\Data\NoteSearchResultsInterfaceFactory;
use Magento\Store\Model\StoreManagerInterface;
use Belvg\Note\Api\NoteRepositoryInterface;
use Magento\Framework\Api\SortOrder;
use Belvg\Note\Api\Data\NoteInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Belvg\Note\Model\ResourceModel\Note as ResourceNote;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Belvg\Note\Model\ResourceModel\Note\CollectionFactory as NoteCollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class NoteRepository implements noteRepositoryInterface
{

    protected $resource;

    private $storeManager;

    protected $noteCollectionFactory;

    protected $searchResultsFactory;

    protected $noteFactory;

    protected $dataNoteFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;


    /**
     * @param ResourceNote $resource
     * @param NoteFactory $noteFactory
     * @param NoteInterfaceFactory $dataNoteFactory
     * @param NoteCollectionFactory $noteCollectionFactory
     * @param NoteSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceNote $resource,
        NoteFactory $noteFactory,
        NoteInterfaceFactory $dataNoteFactory,
        NoteCollectionFactory $noteCollectionFactory,
        NoteSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->noteFactory = $noteFactory;
        $this->noteCollectionFactory = $noteCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataNoteFactory = $dataNoteFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Belvg\Note\Api\Data\NoteInterface $note)
    {
        /* if (empty($note->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $note->setStoreId($storeId);
        } */
        try {
            $note->getResource()->save($note);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the note: %1',
                $exception->getMessage()
            ));
        }
        return $note;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($noteId)
    {
        $note = $this->noteFactory->create();
        $note->getResource()->load($note, $noteId);
        if (!$note->getId()) {
            throw new NoSuchEntityException(__('Note with id "%1" does not exist.', $noteId));
        }
        return $note;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->noteCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(\Belvg\Note\Api\Data\NoteInterface $note)
    {
        try {
            $note->getResource()->delete($note);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Note: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($noteId)
    {
        return $this->delete($this->getById($noteId));
    }
}
