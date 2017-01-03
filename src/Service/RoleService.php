<?php

namespace Ise\Admin\Service;

use Ise\Admin\Entity\Role;
use Ise\Bread\Router\Http\BreadRouteStack;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class RoleService extends AbstractRbacService
{

    /**
     * @var string
     */
    protected $entityClass = Role::class;

    /**
     * @var string
     */
    protected $mapperClass = 'Ise\Admin\Mapper\Role';

    /**
     * @var string[]
     */
    protected $form = [
        BreadRouteStack::ACTION_CREATE  => 'Ise\Admin\Form\Role\Add',
        BreadRouteStack::ACTION_UPDATE  => 'Ise\Admin\Form\Role\Edit',
        BreadRouteStack::ACTION_DELETE  => 'Ise\Admin\Form\Role\Delete',
        BreadRouteStack::ACTION_ENABLE  => 'Ise\Admin\Form\Role\Enable',
        BreadRouteStack::ACTION_DISABLE => 'Ise\Admin\Form\Role\Disable',
    ];
}
