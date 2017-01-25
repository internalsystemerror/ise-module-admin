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
        $user->setBanned(true);
        $channel->setLastModified(new DateTime);
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
        $user->setBanned(false);
        $channel->setLastModified(new DateTime);
        return $this->persist($user);
    }
}
