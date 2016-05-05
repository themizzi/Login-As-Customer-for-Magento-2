<?php
/**
 * Copyright © 2015 Ihor Vansach (ihor@magefan.com). All rights reserved.
 * See LICENSE.txt for license details (http://opensource.org/licenses/osl-3.0.php).
 *
 * Glory to Ukraine! Glory to the heroes!
 */

namespace Magefan\LoginAsCustomer\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * LoginAsCustomer observer
 */
class PredispathAdminActionControllerObserver implements ObserverInterface
{
    /**
     * @var \Magefan\LoginAsCustomer\Model\AdminNotificationFeedFactory
     */
    protected $_feedFactory;

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_backendAuthSession;

    /**
     * @param \Magefan\LoginAsCustomer\Model\AdminNotificationFeedFactory $feedFactory
     * @param \Magento\Backend\Model\Auth\Session $backendAuthSession
     */
    public function __construct(
        \Magefan\LoginAsCustomer\Model\AdminNotificationFeedFactory $feedFactory,
        \Magento\Backend\Model\Auth\Session $backendAuthSession
    ) {
        $this->_feedFactory = $feedFactory;
        $this->_backendAuthSession = $backendAuthSession;
    }

    /**
     * Predispath admin action controller
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->_backendAuthSession->isLoggedIn()) {
            $feedModel = $this->_feedFactory->create();
            /* @var $feedModel \Magefan\LoginAsCustomer\Model\AdminNotificationFeed */
            $feedModel->checkUpdate();
        }
    }
}
