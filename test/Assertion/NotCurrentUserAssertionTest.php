<?php

namespace IseTest\Admin\Assertion;

use Ise\Admin\Assertion\NotCurrentUserAssertion;

class NotCurrentUserAssertionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var NotCurrentUserAssertion
     */
    protected $object;

    /**
     * @covers Ise\Admin\Assertion\NotCurrentUserAssertion::assert
     * @todo   Implement testAssert().
     */
    public function testAssert()
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
        $this->object = new NotCurrentUserAssertion;
    }
}
