<?php
/**
 * Created by PhpStorm.
 * User: todd
 * Date: 12/11/17
 * Time: 9:05 PM
 */

use Greenskies\Collection;

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
}
