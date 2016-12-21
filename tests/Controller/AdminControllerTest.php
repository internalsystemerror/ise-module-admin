<?php

namespace IseAdminTest\Controller;

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
     * @covers IseAdmin\Controller\AdminController::indexAction
     */
    public function testIndexActionCanNotBeAccessed()
    {
        $this->dispatch('/admin');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('IseAdmin');
        $this->assertControllerName('IseAdmin\Controller\Admin');
        $this->assertControllerClass('AdminController');
        $this->assertActionName('index');
        $this->assertMatchedRouteName('admin/index');
    }

    /**
     * @covers IseAdmin\Controller\AdminController::dashboardAction
     */
    public function testDashboardActionCanNotBeAccessed()
    {
        $this->dispatch('/admin/dashboard');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('IseAdmin');
        $this->assertControllerName('IseAdmin\Controller\Admin');
        $this->assertControllerClass('AdminController');
        $this->assertActionName('dashboard');
        $this->assertMatchedRouteName('zfcuser/dashboard');
    }
}
