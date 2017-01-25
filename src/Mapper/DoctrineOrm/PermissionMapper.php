<?php

namespace Ise\Admin\Mapper\DoctrineOrm;

use Ise\Admin\Entity\Permission;
use Ise\Bread\Mapper\DoctrineOrm\AbstractMapper;

class PermissionMapper extends AbstractMapper
{

    /**
     * @var string
     */
    protected static $entityClass = Permission::class;
}
