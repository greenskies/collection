<?php

namespace Tests;

use Greenskies\Collection;
use Greensky\Tests\MockClass;
use Greensky\Tests\SubMockClass;
use Greensky\Tests\WrongMockClass;

class CollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testCanCount()
    {
        $Collection = new Collection(['string']);
        $count = $Collection->count();
        $this->assertEquals(1, $count);
    }

    public function testArrayAccess()
    {
        $Collection = new Collection(['string']);
        $this->assertEquals('string', $Collection[0]);
    }

    public function testCanIterate()
    {
        $Collection = new Collection([0, 1, 2]);
        $i = 0;
        foreach ($Collection as $item) {
               $this->assertEquals($i, $item);
               ++$i;
        }
    }

    public function testNewCollectionFromFile()
    {
        $collection = Collection::createFromFile('./tests/fixtures/info.log');

        $this->assertEquals(2, count($collection));
    }

    public function testCreateClassCollection()
    {
        $collection = new Collection(['class'], 'Greensky\Tests\MockClass');
        $className = get_class($collection[0]);
        $this->assertEquals('Greensky\Tests\MockClass', $className);
    }

    public function testInsertIntoClassCollection()
    {
        $collection = new Collection(['class'], 'Greensky\Tests\MockClass');
        $insertItem = new MockClass();
        $collection[] = $insertItem;
        $className = get_class($collection[1]);
        $this->assertEquals('Greensky\Tests\MockClass', $className);
    }

    public function testCantInsertWrongClassIntoCollection()
    {
        $collection = new Collection(['class'], 'Greensky\Tests\MockClass');
        $insertItem = new WrongMockClass();
        $this->expectExceptionMessage('Wrong class for collection');
        $collection[] = $insertItem;

    }

    public function testCanInsertChildClassIntoCollection()
    {
        $collection = new Collection(['class'], 'Greensky\Tests\MockClass');
        $insertItem = new SubMockClass();
        $collection[] = $insertItem;
        $className = get_class($collection[1]);
        $this->assertEquals('Greensky\Tests\SubMockClass', $className);
    }
}
