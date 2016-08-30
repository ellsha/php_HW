<?php

namespace tests;

include 'framework/Contracts/Arrayable.php';
include 'framework/Collection.php';

use Framework\Collection;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    /**
     * @dataProvider provider
     *
     * @param $key
     * @param $value
     */
    public function testGet($key, $value)
    {
        $collection = new Collection([$key => $value]);
        $this->assertEquals($value, $collection->get($key));
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     * @param $default
     */
    public function testGetDefault($key, $default)
    {
        $collection = new Collection();
        $this->assertEquals($default, $collection->get($key, $default));
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     */
    public function testGetThrowsException($key)
    {
        $collection = new Collection();
        $this->assertEquals(null, $collection->get($key));
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     * @param $value
     */
    public function testSet($key, $value)
    {
        $collection = new Collection();
        $collection->set($key, $value);
        $this->assertEquals($value, $collection->get($key));
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     * @param $value
     */
    public function testHas($key, $value)
    {
        $collection = new Collection();
        $collection->set($key, $value);
        $this->assertTrue($collection->has($key));
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     * @param $value
     */
    public function testToArray($key, $value)
    {
        $expected = [$key => $value];
        $collection = new Collection($expected);
        $this->assertEquals($expected, $collection->toArray());
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     * @param $value
     */
    public function testArrayAccessExists($key, $value)
    {
        $collection = new Collection([$key => $value]);
        $this->assertTrue(isset($collection[$key]));
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     */
    public function testArrayAccessDoesNotExist($key)
    {
        $collection = new Collection();
        $this->assertFalse(isset($collection[$key]));
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     * @param $value
     */
    public function testArrayAccessGet($key, $value)
    {
        $collection = new Collection([$key => $value]);
        $this->assertEquals($value, $collection[$key]);
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     */
    public function testArrayAccessGetNull($key)
    {
        $collection = new Collection();
        $this->assertEquals(null, $collection[$key]);
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     * @param $value
     */
    public function testArrayAccessSet($key, $value)
    {
        $collection = new Collection();
        $collection[$key] = $value;
        $this->assertEquals($value, $collection[$key]);
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     * @param $value
     */
    public function testArrayAccessUnset($key, $value)
    {
        $collection = new Collection([$key => $value]);
        unset($collection[$key]);
        $this->assertFalse(isset($collection[$key]));
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     */
    public function testArrayAccessUnsetNull($key)
    {
        $collection = new Collection();
        unset($collection[$key]);
        $this->assertFalse(isset($collection[$key]));
    }

    /**
     * @dataProvider provider
     *
     * @param $key
     * @param $value
     */
    public function testIterator($key, $value)
    {
        $collection = new Collection([$key => $value]);

        foreach($collection as $key => $value) {
            $this->assertEquals($value, $collection[$key]);
        }
    }

    public function provider()
    {
        return [[
            'key'     => 'any key',
            'value'   => 'any value',
            'default' => 'any default',
        ]];
    }
}
