<?php

namespace Ise\Admin\Service;

use Ise\Bread\Router\Http\Bread;

class RoleService extends AbstractRbacService
{

    /**
     * @var string
     */
    protected static $mapperClass = 'Ise\Admin\Mapper\Role';

    /**
     * @var string[]
     */
    protected static $form = [
        Bread::ACTION_CREATE  => 'Ise\Admin\Form\Role\Add',
        Bread::ACTION_UPDATE  => 'Ise\Admin\Form\Role\Edit',
        Bread::ACTION_DELETE  => 'Ise\Admin\Form\Role\Delete',
        Bread::ACTION_ENABLE  => 'Ise\Admin\Form\Role\Enable',
        Bread::ACTION_DISABLE => 'Ise\Admin\Form\Role\Disable',
    ];

}
