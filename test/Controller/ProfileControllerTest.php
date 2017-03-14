<?php

namespace IseTest\Admin\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ProfileControllerTest extends AbstractHttpControllerTestCase
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
     * @covers Ise\Admin\Controller\ProfileController::indexAction
     */
    public function testIndexActionCanNotBeAccessed()
    {
        $this->dispatch('/auth/profile');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('Ise\Admin');
        $this->assertControllerName('Ise\Admin\Controller\Profile');
        $this->assertControllerClass('ProfileController');
        $this->assertActionName('index');
        $this->assertMatchedRouteName('zfcuser/profile');
    }

    /**
     * @covers Ise\Admin\Controller\ProfileController::editAction
     */
    public function testEditActionCanNotBeAccessed()
    {
        $this->dispatch('/auth/profile/edit');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('Ise\Admin');
        $this->assertControllerName('Ise\Admin\Controller\Profile');
        $this->assertControllerClass('ProfileController');
        $this->assertActionName('edit');
        $this->assertMatchedRouteName('zfcuser/profile/edit');
    }

    /**
     * @covers Ise\Admin\Controller\ProfileController::viewAction
     */
    public function testViewActionCanNotBeAccessed()
    {
        $this->dispatch('/auth/profile/view/1');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('Ise\Admin');
        $this->assertControllerName('Ise\Admin\Controller\Profile');
        $this->assertControllerClass('ProfileController');
        $this->assertActionName('view');
        $this->assertMatchedRouteName('zfcuser/profile/view');
    }

    /**
     * @covers Ise\Admin\Controller\ProfileController::settingsAction
     */
    public function testSettingsActionCanNotBeAccessed()
    {
        $this->dispatch('/auth/profile/settings');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('Ise\Admin');
        $this->assertControllerName('Ise\Admin\Controller\Profile');
        $this->assertControllerClass('ProfileController');
        $this->assertActionName('settings');
        $this->assertMatchedRouteName('zfcuser/profile/settings');
    }

    /**
     * @covers Ise\Admin\Controller\ProfileController::getUserService
     * @todo   Implement testGetUserService().
     */
    public function testGetUserService()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ise\Admin\Controller\ProfileController::getFormElementManager
     * @todo   Implement testGetFormElementManager().
     */
    public function testGetFormElementManager()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ise\Admin\Controller\ProfileController::setFormElementManager
     * @todo   Implement testSetFormElementManager().
     */
    public function testSetFormElementManager()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ise\Admin\Controller\ProfileController::getForm
     * @todo   Implement testGetForm().
     */
    public function testGetForm()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ise\Admin\Controller\ProfileController::setForm
     * @todo   Implement testSetForm().
     */
    public function testSetForm()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
