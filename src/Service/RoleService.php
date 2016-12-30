<?php

namespace Ise\Admin\Service;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class RoleService extends AbstractRbacService
{

    /**
     * @var string
     */
    protected $entityClass = 'Ise\Admin\Entity\Role';

    /**
     * @var string
     */
    protected $mapperClass = 'Ise\Admin\Mapper\Role';

    /**
     * @var string[]
     */
    protected $form = [
        'add'     => 'Ise\Admin\Form\Role\Add',
        'edit'    => 'Ise\Admin\Form\Role\Edit',
        'delete'  => 'Ise\Admin\Form\Role\Delete',
        'enable'  => 'Ise\Admin\Form\Role\Enable',
        'disable' => 'Ise\Admin\Form\Role\Disable',
    ];

}
