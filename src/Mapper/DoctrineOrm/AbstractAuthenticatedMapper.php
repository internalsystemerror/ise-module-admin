<?php

namespace Ise\Admin\Mapper;

use Ise\Bread\Mapper\DoctrineOrm\AbstractMapper;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
abstract class AbstractAuthenticatedMapper extends AbstractMapper implements AuthorizationServiceAwareInterface, AuthenticatedMapperInterface
{

    use IdentityAwareTrait;
    
}
