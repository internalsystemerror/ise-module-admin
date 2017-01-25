<?php

namespace Ise\Admin\Service;

use Ise\Bread\Service\AbstractService;
use ZfcRbac\Service\AuthorizationServiceAwareInterface;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class AbstractAuthenticatedService extends AbstractService implements AuthorizationServiceAwareInterface
{

    use IdentityAwareTrait;
    
}
