<?php

namespace IseAdminTest\Assertion;

use IseAdmin\Assertion\NotCurrentUserAssertion;

class NotCurrentUserAssertionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var NotCurrentUserAssertion
     */
    protected $object;

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new NotCurrentUserAssertion;
    }

    /**
     * @covers IseAdmin\Assertion\NotCurrentUserAssertion::assert
     * @todo   Implement testAssert().
     */
    public function testAssert()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
