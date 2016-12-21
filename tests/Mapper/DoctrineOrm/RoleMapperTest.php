<?php

namespace IseAdminTest\Mapper\DoctrineOrm;

use IseAdmin\Mapper\DoctrineOrm\RoleMapper;

class RoleMapperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var RoleMapper
     */
    protected $object;

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new RoleMapper;
    }

    /**
     * @covers IseAdmin\Mapper\DoctrineOrm\RoleMapper::browse
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
