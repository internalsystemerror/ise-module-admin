<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Controller;

use Ise\Admin\Entity\User;
use Ise\Admin\Service\UserService;
use Ise\Bread\EventManager\BreadEvent;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Plugin\Prg\PostRedirectGet;
use Zend\View\Model\ViewModel;
use ZfcRbac\Exception\UnauthorizedException;
use ZfcUser\View\Helper\ZfcUserIdentity;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 * @method ZfcUserIdentity|User identity()
 * @method PostRedirectGet|Response|array|bool|null prg()
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
    public function indexAction(): ViewModel
    {
        return new ViewModel(['user' => $this->identity()]);
    }

    /**
     * Edit profile action
     *
     * @return Response|ViewModel
     * @throws \Exception
     */
    public function editAction()
    {
        $user = $this->identity();
        if (!$user) {
            throw new UnauthorizedException;
        }

        $form = $this->userService->getForm(BreadEvent::FORM_UPDATE);
        $form->bind($user);
        $prg = $this->prg();

        if ($prg instanceof Response) {
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
    public function viewAction(): ViewModel
    {
        $id   = (string)$this->params(BreadEvent::IDENTIFIER, '');
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
    public function settingsAction(): ViewModel
    {
        return new ViewModel;
    }
}
