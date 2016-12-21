<?php

namespace IseAdmin\Service;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class PermissionService extends AbstractRbacService
{

    /**
     * @var string
     */
    protected $entityClass = 'IseAdmin\Entity\Permission';

    /**
     * @var string
     */
    protected $mapperClass = 'IseAdmin\Mapper\Permission';

    /**
     * @var string[]
     */
    protected $form = [
        'add'     => 'IseAdmin\Form\Permission\Add',
        'edit'    => 'IseAdmin\Form\Permission\Edit',
        'delete'  => 'IseAdmin\Form\Permission\Delete',
        'enable'  => 'IseAdmin\Form\Permission\Enable',
        'disable' => 'IseAdmin\Form\Permission\Disable',
    ];
}
