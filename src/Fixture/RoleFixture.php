<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Fixture;

use Ise\Admin\Entity\Role;

class RoleFixture extends AbstractFixture
{

    /**
     * {@inheritDoc}
     */
    protected function run()
    {
        // Create roles from array
        echo '*************************', PHP_EOL;
        echo '**    LOADING ROLES    **', PHP_EOL;
        echo '*************************', PHP_EOL;
        $data = $this->getFixtureConfig('roles');
        $this->createRoles($data);
        echo PHP_EOL;
    }

    /**
     * Create roles from array
     *
     * @param array       $data
     * @param null|string $parent
     */
    protected function createRoles($data, $parent = null)
    {
        // Loop through data
        foreach ($data as $key => $value) {
            $this->createRole($key, $value, $parent);
        }
    }

    /**
     * Create a single role
     *
     * @param string       $name
     * @param array|string $value
     * @param null|string  $parent
     */
    protected function createRole($name, $value, $parent)
    {
        // Create role
        echo 'Creating role "', $name, '"';
        $role        = new Role;
        $description = $this->getDescriptionFromValue($value);

        // Set parent
        if ($parent) {
            echo ', a child of "', $parent, '"';
            $role->setParent($this->getReference('role-' . $parent));
        }

        // Set values
        $role->setName($name);
        $role->setDescription($description);
        $role->setPermanent(true);

        // Check for permissions
        if (isset($value['permissions'])) {
            $this->addPermissionsToRole($role, $value['permissions']);
        }

        // Persist role
        $this->manager->persist($role);

        // Store reference
        $this->addReference('role-' . $name, $role);
        echo PHP_EOL;

        // Check for children
        if (isset($value['children'])) {
            $this->createRoles($value['children'], $name);
        }
    }

    /**
     * Add permissions to role
     *
     * @param Role  $role
     * @param array $permissions
     */
    protected function addPermissionsToRole(Role $role, array $permissions)
    {
        echo ', with permissions...', PHP_EOL;
        foreach ($permissions as $permission) {
            echo "\t", '- ', $permission, PHP_EOL;
            $role->addPermission($this->getReference('permission-' . $permission));
        }
    }
}
