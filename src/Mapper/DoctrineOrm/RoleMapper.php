<?php

namespace Ise\Admin\Mapper\DoctrineOrm;

use Ise\Admin\Entity\Role;
use Ise\Bread\Mapper\DoctrineOrm\AbstractMapper;

class RoleMapper extends AbstractMapper
{

    /**
     * @var string
     */
    protected static $entityClass = Role::class;
}
