<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace IseTest\Admin\Service;

use Ise\Admin\Service\UserService;

class UserServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var UserService
     */
    protected $object;

    /**
     * @covers Ise\Admin\Service\UserService::ban
     * @todo   Implement testBan().
     */
    public function testBan()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ise\Admin\Service\UserService::unban
     * @todo   Implement testUnban().
     */
    public function testUnban()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ise\Admin\Service\UserService::setAuthorizationService
     * @todo   Implement testSetAuthorizationService().
     */
    public function testSetAuthorizationService()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ise\Admin\Service\UserService::getAuthorizationService
     * @todo   Implement testGetAuthorizationService().
     */
    public function testGetAuthorizationService()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new UserService;
    }
}
