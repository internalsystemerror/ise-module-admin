<?php

namespace Ise\Admin\Service;

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
    protected $entityClass = 'Ise\Admin\Entity\User';

    /**
     * @var string
     */
    protected $mapperClass = 'Ise\Admin\Mapper\User';

    /**
     * @var string[]
     */
    protected $form = [
        'add'     => 'Ise\Admin\Form\User\Add',
        'edit'    => 'Ise\Admin\Form\User\Edit',
        'delete'  => 'Ise\Admin\Form\User\Delete',
        'enable'  => 'Ise\Admin\Form\User\Enable',
        'disable' => 'Ise\Admin\Form\User\Disable',
        'ban'     => 'Ise\Admin\Form\User\Ban',
        'unban'   => 'Ise\Admin\Form\User\Delete',
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
