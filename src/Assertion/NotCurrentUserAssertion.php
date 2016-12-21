<?php

namespace IseAdmin\Assertion;

use ZfcRbac\Assertion\AssertionInterface;
use ZfcRbac\Service\AuthorizationService;

class NotCurrentUserAssertion implements AssertionInterface
{

    /**
     * Check if this assertion is true
     *
     * @param  AuthorizationService $authorization
     * @param  mixed                $entity
     *
     * @return bool
     */
    public function assert(AuthorizationService $authorization, $user = null)
    {
//        var_dump($authorization->getIdentity());
//        exit;
        return $authorization->getIdentity() === $user;
    }
}