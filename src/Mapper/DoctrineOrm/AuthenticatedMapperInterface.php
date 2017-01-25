<?php

namespace Ise\Admin\Mapper\DoctrineOrm;

use Ise\Bread\Mapper\DoctrineOrm\MapperInterface;
use Ise\Admin\Mapper\AuthenticatedMapperInterface as IseAuthenticatedMapperInterface;

interface AuthenticatedMapperInterface extends MapperInterface, IseAuthenticatedMapperInterface
{
    
}
