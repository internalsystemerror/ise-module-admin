<?php

namespace Ise\Admin\Controller;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class UserController extends AdminBreadActionController
{
    
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
        return $this->dialogAction('ban');
    }

    /**
     * Unban action
     *
     * @return ViewModel
     */
    public function unbanAction()
    {
        return $this->dialogAction('unban');
    }
}
