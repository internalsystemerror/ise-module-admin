<?php

namespace Ise\AdminTest\Mapper\DoctrineOrm;

use Ise\Admin\Mapper\DoctrineOrm\PermissionMapper;

class PermissionMapperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var PermissionMapper
     */
    protected $object;

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new PermissionMapper;
    }

    /**
     * @covers Ise\Admin\Mapper\DoctrineOrm\PermissionMapper::browse
     * @todo   Implement testBrowse().
     */
    public function testBrowse()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
