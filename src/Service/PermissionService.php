<?php

namespace Ise\Admin\Service;

use Ise\Admin\Entity\Permission;
use Ise\Bread\Router\Http\BreadRouteStack;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class PermissionService extends AbstractRbacService
{

    /**
     * @var string
     */
    protected $entityClass = Permission::class;

    /**
     * @var string
     */
    protected $mapperClass = 'Ise\Admin\Mapper\Permission';

    /**
     * @var string[]
     */
    protected $form = [
        BreadRouteStack::ACTION_CREATE  => 'Ise\Admin\Form\Permission\Add',
        BreadRouteStack::ACTION_UPDATE  => 'Ise\Admin\Form\Permission\Edit',
        BreadRouteStack::ACTION_DELETE  => 'Ise\Admin\Form\Permission\Delete',
        BreadRouteStack::ACTION_ENABLE  => 'Ise\Admin\Form\Permission\Enable',
        BreadRouteStack::ACTION_DISABLE => 'Ise\Admin\Form\Permission\Disable',
    ];
}
