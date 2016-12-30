<?php

namespace Ise\Admin\Assertion;

use ZfcRbac\Assertion\AssertionInterface;
use ZfcRbac\Service\AuthorizationService;

class IsCurrentUserAssertion implements AssertionInterface
{

    /**
     * Check if this assertion is true
     *
     * @param  AuthorizationService $authorization
     * @param  mixed                $user
     *
     * @return bool
     */
    public function assert(AuthorizationService $authorization, $user = null)
    {
        return $authorization->getIdentity() === $user;
    }
}
