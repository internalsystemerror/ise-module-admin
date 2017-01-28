<?php

namespace Ise\Admin\Service;

use Ise\Bread\Router\Http\Bread;

class PermissionService extends AbstractRbacService
{

    /**
     * @var string
     */
    protected static $mapperClass = 'Ise\Admin\Mapper\Permission';

    /**
     * @var string[]
     */
    protected static $form = [
        Bread::ACTION_CREATE  => 'Ise\Admin\Form\Permission\Add',
        Bread::ACTION_UPDATE  => 'Ise\Admin\Form\Permission\Edit',
        Bread::ACTION_DELETE  => 'Ise\Admin\Form\Permission\Delete',
        Bread::ACTION_ENABLE  => 'Ise\Admin\Form\Permission\Enable',
        Bread::ACTION_DISABLE => 'Ise\Admin\Form\Permission\Disable',
    ];

}
