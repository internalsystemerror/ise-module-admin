<?php

namespace IseAdminTest\Controller;

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
     * @covers IseAdmin\Controller\ProfileController::indexAction
     */
    public function testIndexActionCanNotBeAccessed()
    {
        $this->dispatch('/auth/profile');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('IseAdmin');
        $this->assertControllerName('IseAdmin\Controller\Profile');
        $this->assertControllerClass('ProfileController');
        $this->assertActionName('index');
        $this->assertMatchedRouteName('zfcuser/profile');
    }

    /**
     * @covers IseAdmin\Controller\ProfileController::editAction
     */
    public function testEditActionCanNotBeAccessed()
    {
        $this->dispatch('/auth/profile/edit');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('IseAdmin');
        $this->assertControllerName('IseAdmin\Controller\Profile');
        $this->assertControllerClass('ProfileController');
        $this->assertActionName('edit');
        $this->assertMatchedRouteName('zfcuser/profile/edit');
    }

    /**
     * @covers IseAdmin\Controller\ProfileController::viewAction
     */
    public function testViewActionCanNotBeAccessed()
    {
        $this->dispatch('/auth/profile/view/1');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('IseAdmin');
        $this->assertControllerName('IseAdmin\Controller\Profile');
        $this->assertControllerClass('ProfileController');
        $this->assertActionName('view');
        $this->assertMatchedRouteName('zfcuser/profile/view');
    }

    /**
     * @covers IseAdmin\Controller\ProfileController::settingsAction
     */
    public function testSettingsActionCanNotBeAccessed()
    {
        $this->dispatch('/auth/profile/settings');
        $this->assertResponseStatusCode(302);
        $this->assertApplicationException('ZfcRbac\Exception\UnauthorizedException');

        $this->assertModuleName('IseAdmin');
        $this->assertControllerName('IseAdmin\Controller\Profile');
        $this->assertControllerClass('ProfileController');
        $this->assertActionName('settings');
        $this->assertMatchedRouteName('zfcuser/profile/settings');
    }

    /**
     * @covers IseAdmin\Controller\ProfileController::getUserService
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
     * @covers IseAdmin\Controller\ProfileController::getFormElementManager
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
     * @covers IseAdmin\Controller\ProfileController::setFormElementManager
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
     * @covers IseAdmin\Controller\ProfileController::getForm
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
     * @covers IseAdmin\Controller\ProfileController::setForm
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
