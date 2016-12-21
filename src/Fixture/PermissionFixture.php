<?php

namespace IseAdmin\Fixture;

use IseAdmin\Entity\Permission;

class PermissionFixture extends AbstractFixture
{

    /**
     * {@inheritDoc}
     */
    protected function run()
    {
        // Create permissions from array
        echo '*************************', PHP_EOL;
        echo '** LOADING PERMISSIONS **', PHP_EOL;
        echo '*************************', PHP_EOL;
        $data = $this->getFixtureConfig('permissions');
        $this->createPermissions($data);
        echo PHP_EOL;
    }

    /**
     * Create permissions from array
     *
     * @param array  $data
     * @param string $prefix
     */
    protected function createPermissions(array $data, $prefix = '')
    {
        // Loop through data
        foreach ($data as $key => $value) {
            // Create single permission
            $this->createPermission($prefix . $key, $value);
        }
    }

    /**
     * Create single permission
     *
     * @param string       $name
     * @param array|string $value
     */
    protected function createPermission($name, $value)
    {
        // Create permission
        echo 'Creating permission "', $name, '"', PHP_EOL;
        $permission  = new Permission;
        $description = $this->getDescriptionFromValue($value);

        // Set values
        $permission->setName($name);
        $permission->setDescription($description);
        $permission->setPermanent(true);

        // Persist permission
        $this->manager->persist($permission);

        // Store reference
        $this->addReference('permission-' . $name, $permission);

        // Check for children
        if (isset($value['children'])) {
            // Create permissions from array
            $this->createPermissions($value['children'], $name . '.');
        }
    }
}
