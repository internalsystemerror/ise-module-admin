<?php

namespace Ise\Admin\Service;

use Ise\Admin\Entity\User;
use Ise\Bread\Router\Http\Bread;
use Ise\Bread\Service\AbstractService;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class UserService extends AbstractService
{

    /**
     * @var string
     */
    protected $entityClass = User::class;

    /**
     * @var string
     */
    protected $mapperClass = 'Ise\Admin\Mapper\User';

    /**
     * @var string[]
     */
    protected $form = [
        Bread::ACTION_CREATE  => 'Ise\Admin\Form\User\Add',
        Bread::ACTION_UPDATE  => 'Ise\Admin\Form\User\Edit',
        Bread::ACTION_DELETE  => 'Ise\Admin\Form\User\Delete',
        Bread::ACTION_ENABLE  => 'Ise\Admin\Form\User\Enable',
        Bread::ACTION_DISABLE => 'Ise\Admin\Form\User\Disable',
        'ban'                 => 'Ise\Admin\Form\User\Ban',
        'unban'               => 'Ise\Admin\Form\User\Delete',
    ];

    /**
     * Ban user
     *
     * @param array $data
     * @return boolean
     */
    public function ban(array $data)
    {
        // Validate form
        $user = $this->validateForm('ban', $data);
        if (!$user) {
            return false;
        }
        
        // Save user
        $user->setBanned(true);
        return $this->mapper->edit($user);
    }

    /**
     * Unban user
     *
     * @param array $data
     * @return boolean
     */
    public function unban(array $data)
    {
        // Validate form
        $user = $this->validateForm('unban', $data);
        if (!$user) {
            return false;
        }
        
        // Save user
        $user->setBanned(false);
        return $this->mapper->edit($user);
    }
}
