<?php

namespace Ise\Admin\Mapper\DoctrineOrm;

use DateTime;
use Ise\Admin\Entity\User;
use Ise\Bread\Mapper\DoctrineOrm\AbstractMapper;

class UserMapper extends AbstractMapper
{

    /**
     * @var string
     */
    protected static $entityClass = User::class;

    /**
     * Ban user
     *
     * @param User $user
     * @return boolean
     */
    public function ban(User $user)
    {
        return $this->persist($user);
    }

    /**
     * Unban user
     *
     * @param User $user
     * @return boolean
     */
    public function unban(User $user)
    {
        return $this->persist($user);
    }
}
