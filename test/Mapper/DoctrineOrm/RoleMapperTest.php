<?php

namespace IseTest\Admin\Mapper\DoctrineOrm;

use Ise\Admin\Mapper\DoctrineOrm\RoleMapper;

class RoleMapperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var RoleMapper
     */
    protected $object;

    /**
     * @covers Ise\Admin\Mapper\DoctrineOrm\RoleMapper::browse
     * @todo   Implement testBrowse().
     */
    public function testBrowse()
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
        $this->object = new RoleMapper;
    }
}
