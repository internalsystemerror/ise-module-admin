<?php

namespace IseAdmin\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture as AbstractDoctrineFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Config\Factory;

abstract class AbstractFixture extends AbstractDoctrineFixture
{
    /**
     * @var array
     */
    private static $modulesList;

    /**
     * @var ObjectManager
     */
    protected $manager;
    
    /**
     * Get list of modules
     *
     * @return array
     */
    private static function getModulesList()
    {
        if (!self::$modulesList) {
            // Load application config
            $applicationConfig = Factory::fromFile('config/application.config.php', true);
            foreach ($applicationConfig->modules as $module) {
                $className = $module . '\\Module';
                if (!class_exists($className)) {
                    continue;
                }
                $reflection = new \ReflectionClass($className);
                self::$modulesList[] = dirname($reflection->getFileName());
            }
        }
        return self::$modulesList;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Set manager
        $this->manager = $manager;
        
        // Run
        $this->run();

        // Flush manager
        $this->manager->flush();
    }
    
    /**
     * Run the fixture
     */
    abstract protected function run();


    /**
     * Get fixture configuration
     *
     * @param string $configName
     * @return array
     */
    protected function getFixtureConfig($configName)
    {
        $modules     = self::getModulesList();
        $configFiles = [];
        foreach ($modules as $modulePath) {
            $filePath = $modulePath . '/../config/fixtures/' . $configName . '.fixture.php';
            if (!file_exists($filePath)) {
                continue;
            }
            $configFiles[] = realpath($filePath);
        }
        return Factory::fromFiles($configFiles);
    }
    
    /**
     * Get description from value
     *
     * @param array|string $value
     * @return string
     */
    protected function getDescriptionFromValue($value)
    {
        if (is_array($value)) {
            if (isset($value['description'])) {
                return (string) $value['description'];
            }
            return '';
        }
        
        return (string) $value;
    }
}
