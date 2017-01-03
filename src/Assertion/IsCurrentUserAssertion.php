<?php

namespace Ise\Admin\Assertion;

use Ise\Admin\Entity\User;
use ZfcRbac\Assertion\AssertionInterface;
use ZfcRbac\Service\AuthorizationService;

class IsCurrentUserAssertion implements AssertionInterface
{

    /**
     * Check if this assertion is true
     *
     * @param  AuthorizationService $authorization
     * @param  User                 $user
     *
     * @return bool
     */
    public function assert(AuthorizationService $authorization, User $user = null)
    {
        return $authorization->getIdentity() === $user;
    }
}
