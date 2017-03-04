<?php

namespace Ise\Admin\Controller;

use Ise\Bread\EventManager\BreadEvent;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class UserController extends AdminActionController
{
    
    /**
     * {@inheritDoc}
     */
    public function readAction()
    {
        return $this->redirect()->toRoute('zfcuser/profile/view', [], null, true);
    }

    /**
     * Ban action
     *
     * @return ViewModel|ResponseInterface
     */
    public function banAction()
    {
        return $this->triggerActionEvent('ban', BreadEvent::FORM_DIALOG);
    }

    /**
     * Unban action
     *
     * @return ViewModel|ResponseInterface
     */
    public function unbanAction()
    {
        return $this->triggerActionEvent('unban', BreadEvent::FORM_DIALOG);
    }
}
