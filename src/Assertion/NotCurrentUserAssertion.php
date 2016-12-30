<?php

namespace Ise\Admin\Assertion;

use ZfcRbac\Service\AuthorizationService;

class NotCurrentUserAssertion extends IsCurrentUserAssertion
{

    /**
     * {@inheritDoc}
     */
    public function assert(AuthorizationService $authorization, $user = null)
    {
        die('here');
        return !parent::assert($authorization, $user);
    }
}
