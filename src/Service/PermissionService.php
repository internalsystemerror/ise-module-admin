<?php

namespace Ise\Admin\Service;

use Ise\Admin\Entity\Permission;
use Ise\Bread\Router\Http\Bread;

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
        Bread::ACTION_CREATE  => 'Ise\Admin\Form\Permission\Add',
        Bread::ACTION_UPDATE  => 'Ise\Admin\Form\Permission\Edit',
        Bread::ACTION_DELETE  => 'Ise\Admin\Form\Permission\Delete',
        Bread::ACTION_ENABLE  => 'Ise\Admin\Form\Permission\Enable',
        Bread::ACTION_DISABLE => 'Ise\Admin\Form\Permission\Disable',
    ];

    /**
     * {@inheritDoc}
     */
    public function getForm($action)
    {
        $form = parent::getForm($action);
        if ($action !== Bread::ACTION_UPDATE) {
            return $form;
        }
        
        $form->getInputFilter()->remove('name');
        return $form;
    }
}
