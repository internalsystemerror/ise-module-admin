<?php

namespace Ise\Admin\Service;

use Ise\Admin\Entity\User;
use Ise\Bread\Router\Http\BreadRouteStack;
use Ise\Bread\Service\AbstractService;
use ZfcRbac\Service\AuthorizationServiceAwareInterface;
use ZfcRbac\Service\AuthorizationServiceAwareTrait;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class UserService extends AbstractService implements AuthorizationServiceAwareInterface
{

    use AuthorizationServiceAwareTrait;

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
        BreadRouteStack::ACTION_CREATE  => 'Ise\Admin\Form\User\Add',
        BreadRouteStack::ACTION_UPDATE  => 'Ise\Admin\Form\User\Edit',
        BreadRouteStack::ACTION_DELETE  => 'Ise\Admin\Form\User\Delete',
        BreadRouteStack::ACTION_ENABLE  => 'Ise\Admin\Form\User\Enable',
        BreadRouteStack::ACTION_DISABLE => 'Ise\Admin\Form\User\Disable',
        'ban'                           => 'Ise\Admin\Form\User\Ban',
        'unban'                         => 'Ise\Admin\Form\User\Delete',
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

        // Get entity
        $entity->setBanned(true);

        // Save entity
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

        // Get entity
        $entity->setBanned(false);

        // Save entity
        return $this->mapper->edit($entity);
    }
}
