<?php

namespace Ise\Admin\Controller;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Ise\Bread\EntityManager\EntityManagerAwareInterface;
use Ise\Bread\EntityManager\EntityManagerAwareTrait;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Exception\RuntimeException;
use Zend\Mvc\MvcEvent;

class ConsoleController extends AbstractActionController implements EntityManagerAwareInterface
{

    use EntityManagerAwareTrait;

    /**
     * @var string
     */
    private $projectPath = '';

    /**
     * @var integer
     */
    private $dbAttempt = 0;

    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->projectPath = getcwd();
    }

    /**
     * Install action
     */
    public function installAction()
    {
        $this->composerUpdate();
        $this->setupAccess();
        $this->populateDatabase();
        $this->warmAssets();
    }

    /**
     * Update action
     */
    public function updateAction()
    {
        $this->composerUpdate();
        $this->updateDatabase();
        $this->warmAssets();
    }

    /**
     * Refresh action
     */
    public function refreshAction()
    {
        $this->composerUpdate();
        $this->dropDatabase();
        $this->populateDatabase();
        $this->warmAssets();
    }

    /**
     * Update composer
     */
    protected function composerUpdate()
    {
        chdir($this->projectPath);
        $this->run('composer self-update -q -n', 'Checking composer version');
        $this->run('composer update -o -q -n', 'Updating project dependencies');
    }

    /**
     * Setup access
     */
    protected function setupAccess()
    {
        chdir($this->projectPath);
        // Check database connection
        $connection = $this->getEntityManager()->getConnection();
        if (!$connection->connect()) {
            $this->createDatabaseConnection();
            $this->createDatabaseAccess();
        }

        $this->run('php public/index.php diag', 'Performing diagnostics');
    }

    /**
     * Create database connection
     */
    protected function createDatabaseConnection()
    {
        echo 'Database connection cannot be established. Please enter ',
        'database root password to continue: ' . PHP_EOL;
        $handle   = fopen("php://stdin", "r");
        $password = trim(fgets($handle));

        // Create new connection
        $connection = $this->getDatabaseConnection($password);
        if ($connection->connect()) {
            echo 'Database connection established.' . PHP_EOL;
            return;
        }

        $this->dbAttempt++;
        if ($this->dbAttempt > 3) {
            chdir($this->projectPath);
            throw RuntimeException('Unable to establish a connection.');
        }

        $this->createDatabaseConnection();
    }

    /**
     * Create new database connection
     *
     * @param string $password
     * @return Connection
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function getDatabaseConnection($password)
    {
        // Get parameters
        $config = new Configuration;
        $params = $this->getEntityManager()->getConnection()->getParams();

        // Set new details
        $params['user']     = 'root';
        $params['password'] = $password;

        return DriverManager::getConnection($params, $config);
    }

    /**
     * Create database access
     */
    protected function createDatabaseAccess()
    {
        // Set variables
        $entityManager = $this->getEntityManager();
        $connection    = $entityManager->getConnection();
        $database      = $connection->getDatabase();
        $hostname      = $connection->getHost();
        $username      = $connection->getUsername();
        $password      = $connection->getPassword();

        // Create project database if it doesnt exist
        $entityManager->createQuery(
            'CREATE DATABASE IF NOT EXISTS `' . $database . '`;'
        );
        // Create project user if it doesnt exist
        $entityManager->createQuery(
            'GRANT ALL ON `' . $database . '`.* TO \'' . $username . '\'@\''
            . $hostname . '\' IDENTIFIED BY \'' . $password . '\';'
        );
    }

    /**
     * Drop database
     */
    protected function dropDatabase()
    {
        chdir($this->projectPath . '/vendor/bin');
        $this->run(
            'doctrine-module orm:schema-tool:drop --full-database --force -q -n',
            'Dropping existing database'
        );
        chdir($this->projectPath);
    }

    /**
     * Update database
     */
    protected function updateDatabase()
    {
        chdir($this->projectPath . '/vendor/bin');
        $this->run(
            'doctrine-module orm:schema-tool:update --complete --force -q -n',
            'Updating existing database'
        );
        chdir($this->projectPath);
    }

    /**
     * Populate database
     */
    protected function populateDatabase()
    {
        chdir($this->projectPath . '/vendor/bin');
        $this->run('doctrine-module orm:schema-tool:create -q -n', 'Creating database');
        $this->run('doctrine-module data-fixture:import -n', 'Importing default data');
        chdir($this->projectPath);
    }

    /**
     * Warmup assets
     */
    protected function warmAssets()
    {
        chdir($this->projectPath);
        $this->run('php public/index.php assetmanager warmup --purge', 'Warming assets');
    }

    /**
     * Run command
     *
     * @param string $command
     * @param string $message
     */
    protected function run($command, $message)
    {
        $return = 0;
        echo $message . PHP_EOL;
        passthru($command, $return);
        if ($return > 0) {
            chdir($this->projectPath);
            throw RuntimeException('An error occurred.');
        }
    }
}
