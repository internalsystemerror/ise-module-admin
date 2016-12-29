<?php

namespace Ise\Admin\Controller;

use Ise\Bread\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class UserController extends AbstractActionController
{

    /**
     * @var string
     */
    protected $indexRoute = 'admin/users';

    /**
     * @var string
     */
    protected $basePermission = 'admin.users';

    /**
     * @var string
     */
    protected $entityType = 'user';
    
    /**
     * {@inheritDoc}
     */
    public function browseAction()
    {
        $viewModel = parent::browseAction();
        $viewModel->setTemplate('ise/admin/user/browse');
        return $viewModel;
    }

    /**
     * {@inheritDoc}
     */
    public function editAction()
    {
        return $this->notFoundAction();
    }

    /**
     * Ban action
     *
     * @return ViewModel
     */
    public function banAction()
    {
        return $this->bread('ban', 'ise/admin/user/ban');
    }

    /**
     * Unban action
     *
     * @return ViewModel
     */
    public function unbanAction()
    {
        return $this->bread('unban', 'ise/admin/user/unban');
    }
}
