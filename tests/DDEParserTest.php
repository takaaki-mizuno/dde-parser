<?php
namespace TakaakiMizuno\DDEParser\Tests;

use TakaakiMizuno\DDEParser\DDEParser;

class DDEParserTest extends Base
{
    public function testParseObject()
    {
        $data = '{"id":{"s":"12345"},"data_source_updated_at":{"s":"2017-07-15T05:41:27.990Z"},"data_source":{"s":"AAAA"},"price_currency":{"s":"VND"},"building_type":{"s":"House"},"country_code":{"s":"VNM"},"size":{"s":"36"},"country":{"s":"Vietnam"},"property_type":{"s":"property"},"price":{"s":"5,200,000,000"},"updated_at":{"s":"2017-07-15T05:41:27.990Z"},"images":{"l":[]}}';
        $parser = new DDEParser();
        $object = $parser->parse($data);

        $this->assertObjectHasAttribute('id', $object);
        $this->assertObjectHasAttribute('price_currency', $object);
        $this->assertObjectHasAttribute('images', $object);

        $this->assertTrue(is_array($object->images));
        $this->assertEquals('12345', $object->id);
    }

    public function testParseArray()
    {
        $data = '{"id":{"s":"12345"},"data_source_updated_at":{"s":"2017-07-15T05:41:27.990Z"},"data_source":{"s":"AAAA"},"price_currency":{"s":"VND"},"building_type":{"s":"House"},"country_code":{"s":"VNM"},"size":{"s":"36"},"country":{"s":"Vietnam"},"property_type":{"s":"property"},"price":{"s":"5,200,000,000"},"updated_at":{"s":"2017-07-15T05:41:27.990Z"},"images":{"l":[]}}';
        $parser = new DDEParser();
        $array = $parser->parse($data, true);

        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('price_currency', $array);
        $this->assertArrayHasKey('images', $array);

        $this->assertTrue(is_array($array['images']));
        $this->assertEquals('12345', $array['id']);
    }
}
