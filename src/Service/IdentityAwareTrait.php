<?php

namespace Ise\Admin\Service;

use Ise\Admin\Entity\User;
use ZfcRbac\Service\AuthorizationServiceAwareTrait;

trait IdentityAwareTrait
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
