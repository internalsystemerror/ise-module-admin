<?php

namespace Ise\Admin\Service;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class PermissionService extends AbstractRbacService
{

    /**
     * @var string
     */
    protected $entityClass = 'Ise\Admin\Entity\Permission';

    /**
     * @var string
     */
    protected $mapperClass = 'Ise\Admin\Mapper\Permission';

    /**
     * @var string[]
     */
    protected $form = [
        'add'     => 'Ise\Admin\Form\Permission\Add',
        'edit'    => 'Ise\Admin\Form\Permission\Edit',
        'delete'  => 'Ise\Admin\Form\Permission\Delete',
        'enable'  => 'Ise\Admin\Form\Permission\Enable',
        'disable' => 'Ise\Admin\Form\Permission\Disable',
    ];
}
