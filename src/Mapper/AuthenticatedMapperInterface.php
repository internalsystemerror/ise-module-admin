<?php

namespace Ise\Admin\Mapper\DoctrineOrm;

use Ise\Bread\Mapper\MapperInterface;
use ZfcRbac\Service\AuthorizationServiceAwareInterface;

interface AuthenticatedMapperInterface extends MapperInterface, AuthorizationServiceAwareInterface
{
    
    /**
     * Get the current identity
     */
    public function identity();
    
}
