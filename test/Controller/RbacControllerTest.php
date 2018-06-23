<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace IseTest\Admin\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class RbacControllerTest extends AbstractHttpControllerTestCase
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
     * @covers Ise\Admin\Controller\RbacController::indexAction
     */
    public function testIndexActionCanNotBeAccessed()
    {
        $this->dispatch('/admin/rbac');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('Ise\Admin');
        $this->assertControllerName('Ise\Admin\Controller\Rbac');
        $this->assertControllerClass('RbacController');
        $this->assertActionName('index');
        $this->assertMatchedRouteName('admin/rbac');
    }

    /**
     * @covers IseBread\Controller\AbstractActionController::browseAction
     * @todo   Implement testBrowseAction().
     */
    public function testBrowseAction()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers IseBread\Controller\AbstractActionController::readAction
     * @todo   Implement testReadAction().
     */
    public function testReadAction()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers IseBread\Controller\AbstractActionController::addAction
     * @todo   Implement testAddAction().
     */
    public function testAddAction()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers IseBread\Controller\AbstractActionController::editAction
     * @todo   Implement testEditAction().
     */
    public function testEditAction()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers IseBread\Controller\AbstractActionController::deleteAction
     * @todo   Implement testDeleteAction().
     */
    public function testDeleteAction()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers IseBread\Controller\AbstractActionController::enableAction
     * @todo   Implement testEnableAction().
     */
    public function testEnableAction()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers IseBread\Controller\AbstractActionController::disableAction
     * @todo   Implement testDisableAction().
     */
    public function testDisableAction()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
