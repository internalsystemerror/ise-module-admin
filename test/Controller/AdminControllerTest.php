<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace IseTest\Admin\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class AdminControllerTest extends AbstractHttpControllerTestCase
{

    /**
     * Sets up the fixture
     */
    public function setUp()
    {
        $this->setApplicationConfig(include 'config/application.config.php');
        parent::setUp();
    }

    /**
     * @covers Ise\Admin\Controller\AdminController::indexAction
     */
    public function testIndexActionCanNotBeAccessed()
    {
        $this->dispatch('/admin');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('Ise\Admin');
        $this->assertControllerName('Ise\Admin\Controller\Admin');
        $this->assertControllerClass('AdminController');
        $this->assertActionName('index');
        $this->assertMatchedRouteName('admin');
    }

    /**
     * @covers Ise\Admin\Controller\AdminController::dashboardAction
     */
    public function testDashboardActionCanNotBeAccessed()
    {
        $this->dispatch('/admin/dashboard');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('Ise\Admin');
        $this->assertControllerName('Ise\Admin\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertActionName('dashboard');
        $this->assertMatchedRouteName('zfcuser');
    }
}
