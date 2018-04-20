<?php


namespace Belvg\Note\Controller\Adminhtml;

abstract class Note extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Belvg_Note::top_level';
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Belvg'), __('Belvg'))
            ->addBreadcrumb(__('Note'), __('Note'));
        return $resultPage;
    }
}
