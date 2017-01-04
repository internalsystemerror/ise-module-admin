<?php

namespace Ise\Admin\Controller;

use Ise\Bread\Controller\AbstractActionController;
use Ise\Admin\Service\UserService;
use Zend\View\Model\ViewModel;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class UserController extends AbstractActionController
{
    
    /**
     * @var string
     */
    protected static $serviceClass = UserService::class;

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
    public function readAction()
    {
        return $this->redirect()->toRoute('zfcuser/profile/view', [], null, true);
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
        return $this->dialogueAction('ban', 'ise/admin/user/ban');
    }

    /**
     * Unban action
     *
     * @return ViewModel
     */
    public function unbanAction()
    {
        return $this->dialogueAction('unban', 'ise/admin/user/unban');
    }
}
