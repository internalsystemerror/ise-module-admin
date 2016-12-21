<?php

namespace IseAdmin\Service;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class RoleService extends AbstractRbacService
{

    /**
     * @var string
     */
    protected $entityClass = 'IseAdmin\Entity\Role';

    /**
     * @var string
     */
    protected $mapperClass = 'IseAdmin\Mapper\Role';

    /**
     * @var string[]
     */
    protected $form = [
        'add'     => 'IseAdmin\Form\Role\Add',
        'edit'    => 'IseAdmin\Form\Role\Edit',
        'delete'  => 'IseAdmin\Form\Role\Delete',
        'enable'  => 'IseAdmin\Form\Role\Enable',
        'disable' => 'IseAdmin\Form\Role\Disable',
    ];
}
