<?php

namespace Ise\Admin\Controller;

use Ise\Admin\Service\UserService;
use Ise\Bread\EventManager\BreadEvent;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ResponseInterface;
use Zend\View\Model\ViewModel;
use ZfcRbac\Exception\UnauthorizedException;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class ProfileController extends AbstractActionController
{

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * {@inheritDoc}
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * View own profile action
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel(['user' => $this->identity()]);
    }

    /**
     * Edit profile action
     *
     * @return Response|ViewModel
     */
    public function editAction()
    {
        $user = $this->identity();
        if (!$user) {
            throw new UnauthorizedException();
        }

        $form = $this->userService->getForm(BreadEvent::FORM_UPDATE);
        $form->bind($user);
        $prg  = $this->prg();

        if ($prg instanceof ResponseInterface) {
            return $prg;
        } elseif ($prg !== false) {
            // Set id
            $prg[BreadEvent::IDENTIFIER] = $user->getId();
            
            // Remove password
            unset($prg['password']);
            $form->remove('password');
            $form->getInputFilter()->remove('password');
            
            // Remove email
            unset($prg['email']);
            $form->remove('email');
            $form->getInputFilter()->remove('email');
            
            // Perform action
            if ($this->userService->edit($prg)) {
                return $this->redirect()->toRoute('zfcuser/profile');
            }
        }
        return new ViewModel(['form' => $form,]);
    }

    /**
     * View a profile
     *
     * @return ViewModel
     */
    public function viewAction()
    {
        $id   = (string) $this->params(BreadEvent::IDENTIFIER, '');
        $user = $this->userService->read($id);
        if (!$user) {
            return $this->notFoundAction();
        }

        return new ViewModel(['user' => $user]);
    }

    /**
     * Users settings
     *
     * @return ViewModel
     */
    public function settingsAction()
    {
        return new ViewModel;
    }
}
