<?php

namespace Ise\Admin\Service;

use DateTime;
use Ise\Bread\Router\Http\Bread;
use Ise\Bread\Service\AbstractService;

class UserService extends AbstractService
{

    /**
     * @var string
     */
    protected static $mapperClass = 'Ise\Admin\Mapper\User';

    /**
     * @var string[]
     */
    protected static $form = [
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
        $entity = $this->validateForm('ban', $data);
        if (!$entity) {
            return false;
        }

        // Save entity
        $entity->setBanned(true);
        $entity->setLastModified(new DateTime);
        return $this->mapper->edit($entity);
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
        $entity = $this->validateForm('unban', $data);
        if (!$entity) {
            return false;
        }

        // Save entity
        $entity->setBanned(false);
        $entity->setLastModified(new DateTime);
        return $this->mapper->edit($entity);
    }
}
