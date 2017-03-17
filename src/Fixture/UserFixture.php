<?php

namespace Ise\Admin\Fixture;

use Ise\Admin\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixture extends AbstractFixture implements DependentFixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function getDependencies()
    {
        return [
            RoleFixture::class,
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function run()
    {
        // Create users from array
        echo '*************************', PHP_EOL;
        echo '**    LOADING USERS    **', PHP_EOL;
        echo '*************************', PHP_EOL;
        $data = $this->getFixtureConfig('users');
        $this->createUsers($data);
        echo PHP_EOL;
    }

    /**
     * Create users from array
     *
     * @param array $data
     */
    protected function createUsers($data)
    {
        // Loop through data
        foreach ($data as $key => $value) {
            $this->createUser($key, $value);
        }
    }

    /**
     * Create a single user
     *
     * @param string $name
     * @param array  $data
     */
    protected function createUser($name, array $data)
    {
        // Create user
        echo 'Creating user "', $name, '"';
        $user = new User;
        $user->setUsername($name);
        $user->setPassword($data['password']);
        $user->setEmail($data['email']);
        $user->setDisplayName($data['display_name']);

        // Add roles
        if (isset($data['role'])) {
            echo ', with assigned roles:', PHP_EOL;
            $roles = array_merge([], (array) $data['role']);
            foreach ($roles as $role) {
                echo "\t", '- ', $role, PHP_EOL;
                $user->addRole($this->getReference('role-' . $role));
            }
        }

        // Persist user
        $this->manager->persist($user);

        // Store reference
        $this->addReference('user-' . $name, $user);
        echo PHP_EOL;
    }
}
