<?php

namespace IseAdmin\Controller;

use IseAdmin\Service\UserService;
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

        $form = $this->userService->getForm('edit');
        $form->bind($user);
        $form->getInputFilter()->remove('email');
        $form->getInputFilter()->remove('password');
        $prg  = $this->prg();

        if ($prg instanceof ResponseInterface) {
            return $prg;
        } elseif ($prg !== false) {
            $prg['id'] = $user->getId();
            if ($this->userService->edit($prg)) {
                return $this->redirect()->toRoute('zfcuser/profile');
            }
        }
        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function viewAction()
    {
        return new ViewModel;
    }

    public function settingsAction()
    {
        return new ViewModel;
    }
}
