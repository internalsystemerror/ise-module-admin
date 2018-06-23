<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

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
    public function assert(AuthorizationService $authorization, User $user = null): bool
    {
        return $authorization->getIdentity() === $user;
    }
}
