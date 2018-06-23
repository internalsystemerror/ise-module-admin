<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Service;

use DateTime;
use Ise\Admin\Entity\User;
use Ise\Bread\EventManager\BreadEvent;
use Ise\Bread\Service\BreadService;

class UserService extends BreadService
{

    /**
     * Ban user
     *
     * @param array $data
     *
     * @return User|null
     * @throws \Exception
     */
    public function ban(array $data): ?User
    {
        // Validate form
        $user = $this->validateForm(BreadEvent::FORM_DIALOG, $data);
        if (!$user instanceof User) {
            return null;
        }

        // Save entity
        $user->setBanned(true);
        $user->setLastModified(new DateTime);
        $this->mapper->edit($user);
        return $user;
    }

    /**
     * Unban user
     *
     * @param array $data
     *
     * @return User|null
     * @throws \Exception
     */
    public function unBan(array $data): ?User
    {
        // Validate form
        $user = $this->validateForm(BreadEvent::FORM_DIALOG, $data);
        if (!$user instanceof User) {
            return null;
        }

        // Save entity
        $user->setBanned(false);
        $user->setLastModified(new DateTime);
        $this->mapper->edit($user);
        return $user;
    }
}
