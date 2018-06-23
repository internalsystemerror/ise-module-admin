<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Controller;

use Ise\Bread\EventManager\BreadEvent;
use Zend\Http\Response;
use Zend\View\Model\ViewModel;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class UserController extends AdminController
{

    /**
     * {@inheritDoc}
     */
    public function readAction(): Response
    {
        return $this->redirect()->toRoute('zfcuser/profile/view', [], null, true);
    }

    /**
     * {@inheritDoc}
     */
    public function editAction(): ViewModel
    {
        return $this->notFoundAction();
    }

    /**
     * Ban action
     *
     * @return ViewModel|Response
     */
    public function banAction()
    {
        return $this->triggerActionEvent(BreadEvent::EVENT_DIALOG, 'ban', BreadEvent::FORM_DIALOG);
    }

    /**
     * Unban action
     *
     * @return ViewModel|Response
     */
    public function unbanAction()
    {
        return $this->triggerActionEvent(BreadEvent::EVENT_DIALOG, 'unban', BreadEvent::FORM_DIALOG);
    }
}
