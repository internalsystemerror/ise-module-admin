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
     * {@inheritDoc}
     */
    public function editAction()
    {
        return $this->notFoundAction();
    }

    /**
     * Ban action
     *
     * @return ViewModel|ResponseInterface
     */
    public function banAction()
    {
        return $this->triggerActionEvent(BreadEvent::EVENT_DIALOG, 'ban', BreadEvent::FORM_DIALOG);
    }

    /**
     * Unban action
     *
     * @return ViewModel|ResponseInterface
     */
    public function unbanAction()
    {
        return $this->triggerActionEvent(BreadEvent::EVENT_DIALOG, 'unban', BreadEvent::FORM_DIALOG);
    }
}
