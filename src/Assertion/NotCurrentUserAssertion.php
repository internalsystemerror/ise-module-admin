<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Assertion;

use Ise\Admin\Entity\User;
use ZfcRbac\Service\AuthorizationService;

class NotCurrentUserAssertion extends IsCurrentUserAssertion
{

    /**
     * {@inheritDoc}
     */
    public function assert(AuthorizationService $authorization, User $user = null): bool
    {
        return !parent::assert($authorization, $user);
    }
}
