<?php

namespace Ise\Admin\Assertion;

use Ise\Admin\Entity\User;
use ZfcRbac\Service\AuthorizationService;

class NotCurrentUserAssertion extends IsCurrentUserAssertion
{

    /**
     * {@inheritDoc}
     */
    public function assert(AuthorizationService $authorization, User $user = null)
    {
        return !parent::assert($authorization, $user);
    }
}
