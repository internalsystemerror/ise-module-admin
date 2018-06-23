<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Fixture;

use Ise\Admin\Entity\Permission;

class PermissionFixture extends AbstractFixture
{

    /**
     * {@inheritDoc}
     * @throws \ReflectionException
     */
    protected function run(): void
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
     * @param array       $data
     * @param string|null $prefix
     *
     * @return void
     */
    protected function createPermissions(array $data, string $prefix = null): void
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
     *
     * @return void
     */
    protected function createPermission(string $name, $value): void
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
