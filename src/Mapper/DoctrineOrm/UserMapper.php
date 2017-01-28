<?php

namespace Ise\Admin\Mapper\DoctrineOrm;

use Ise\Admin\Entity\User;
use Ise\Bread\Mapper\DoctrineOrm\AbstractMapper;

class UserMapper extends AbstractMapper
{

    /**
     * @var string
     */
    protected static $entityClass = User::class;

}
