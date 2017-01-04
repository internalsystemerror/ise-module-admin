<?php

namespace Ise\Admin\Service;

use Ise\Admin\Entity\User;
use Ise\Bread\Service\AbstractService;
use ZfcRbac\Service\AuthorizationServiceAwareInterface;
use ZfcRbac\Service\AuthorizationServiceAwareTrait;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
abstract class AbstractAuthenticatedService extends AbstractService implements AuthorizationServiceAwareInterface
{

    use AuthorizationServiceAwareTrait;
    
    /**
     * @var User 
     */
    protected $identity;
    
    /**
     * Get identity
     * 
     * @return User
     */
    protected function identity()
    {
        if (!$this->identity) {
            $this->identity = $this->getAuthorizationService()->getIdentity();
        }
        
        return $this->identity;
    }
    
}
