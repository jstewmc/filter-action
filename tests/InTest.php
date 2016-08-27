<?php
/**
 * The file for the in-arrays service test
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\InArrays;

use Jstewmc\TestCase\TestCase;

/**
 * Tests for the in-arrays service
 */
class InTest extends TestCase
{
    /* !__construct() */
    
    /**
     * __construct() should throw an exception if $arrays is not an array of arrays
     */
    public function testConstructThrowsExceptionIfArraysIsNotArrayOfArrays()
    {
        $this->setExpectedException('InvalidArgumentException');
        
        (new In(['foo']));
        
        return;
    }
    
    /**
     * __construct() should set the service's properties
     */
    public function testConstructSetsProperties()
    {
        $arrays = ['foo' => ['foo']];
        
        $service = new In($arrays);
        
        $this->assertEquals($arrays, $this->getProperty('arrays', $service));
        
        return;
    }
    
    
    /* !__invoke() */ 
    
    /**
     * __invoke() should throw exception if name is illegal offset
     */
    public function testInvokeThrowsExceptionIfNameIsIllegalOffset()
    {
        $this->setExpectedException('InvalidArgumentException');
        
        // note the use of an array as an array key
        (new In([]))([], 'foo');
        
        return;
    }
    
    /**
     * __invoke() should return false if array does not exist
     */
    public function testInvokeReturnsFalseIfArrayDoesNotExist()
    {
        $arrays = ['foo' => ['foo']];
        
        $service = new In($arrays);
        
        $this->assertFalse($service('bar', 'baz'));
        
        return;
    }

    /**
     * __invoke() should return false if value does not exist
     */
    public function testInvokeReturnsFalseIfValueDoesNotExist()
    {
        $arrays = ['foo' => ['foo']];
        
        $service = new In($arrays);
        
        $this->assertFalse($service('foo', 'bar'));
        
        return;
    }

    /**
     * __invoke() should return true if the value does exist
     */
    public function testInvokeReturnsTrueIfValueDoesExist()
    {
        $arrays = ['foo' => ['foo']];
        
        $service = new In($arrays);
        
        $this->assertTrue($service('foo', 'foo'));
        
        return;
    }
    
    /**
     * __invoke() should return false if key case does not match
     */
    public function testInvokeReturnsBoolIfKeyCaseDoesNotMatch()
    {
        $arrays = ['FOO' => ['foo']];
        
        $service = new In($arrays);
        
        $this->assertFalse($service('foo', 'foo'));
        
        return;
    }
    
    /**
     * __invoke() should return false if value case does not match
     */
    public function testInvokeReturnsBoolIfValueCaseDoesNotMatch()
    {
        $arrays = ['foo' => ['FOO']];
        
        $service = new In($arrays);
        
        $this->assertFalse($service('foo', 'foo'));
        
        return;
    }
}
