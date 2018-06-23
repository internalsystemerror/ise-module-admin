<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Fixture;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Ise\Admin\Entity\Role;
use Ise\Admin\Entity\User;

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
     * @throws \ReflectionException
     */
    protected function run(): void
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
     *
     * @return void
     */
    protected function createUsers($data): void
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
     *
     * @return void
     */
    protected function createUser(string $name, array $data): void
    {
        // Create user
        echo 'Creating user "', $name, '"';
        $user = new User;
        $user->setUsername($name);
        $user->setPassword($data['password']);
        $user->setEmail($data['email']);
        $user->setDisplayName($data['display_name']);

        // Add roles
        if ($data['role']) {
            echo ', with assigned roles:', PHP_EOL;
            $roles = array_merge([], (array)$data['role']);
            foreach ($roles as $role) {
                if (!$role instanceof Role) {
                    continue;
                }
                echo "\t", '- ', $role->getName(), PHP_EOL;
                $user->addRole($role);
            }
        }

        // Persist user
        $this->manager->persist($user);

        // Store reference
        $this->addReference('user-' . $name, $user);
        echo PHP_EOL;
    }
}
