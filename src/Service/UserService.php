<?php

namespace Ise\Admin\Service;

use DateTime;
use Ise\Bread\Router\Http\Bread;
use Ise\Bread\Service\BreadService;

class UserService extends BreadService
{

    /**
     * Ban user
     *
     * @param array $data
     * @return boolean
     */
    public function ban(array $data)
    {
        // Validate form
        $user = $this->validateForm(Bread::FORM_DIALOG, $data);
        if (!$user) {
            return false;
        }

        // Save entity
        $user->setBanned(true);
        $user->setLastModified(new DateTime);
        return $this->mapper->edit($user);
    }

    /**
     * Unban user
     *
     * @param array $data
     * @return boolean
     */
    public function unban(array $data)
    {
        // Validate form
        $user = $this->validateForm(Bread::FORM_DIALOG, $data);
        if (!$user) {
            return false;
        }

        // Save entity
        $user->setBanned(false);
        $user->setLastModified(new DateTime);
        return $this->mapper->edit($user);
    }
}
