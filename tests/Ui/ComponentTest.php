<?php

namespace Tests\Ui;

use Macrame\Contracts\Ui\Component as ComponentContract;
use Macrame\Ui\Component;
use PHPUnit\Framework\TestCase;

class ComponentTest extends TestCase
{
    public function testSetName()
    {
        $component = new Component('');
        $this->assertSame($component, $component->setName('foo'));
        $this->assertSame('foo', $component->getName());
    }

    public function testProp()
    {
        $component = new Component('');
        $component->prop('foo', 'bar');
        $this->assertSame('bar', $component->getProp('foo'));
    }

    public function testBind()
    {
        $component = new Component('');
        $this->assertSame($component, $component->bind(['foo' => 'bar']));
        $this->assertSame('bar', $component->getProp('foo'));
    }

    public function testToArray()
    {
        $component = new Component('foo');
        $component->bind(['bar' => 'baz']);
        $this->assertEquals([
            'props' => ['bar' => 'baz'],
            'name' => 'foo',
        ], $component->toArray());
    }

    public function testToJson()
    {
        $component = new Component('foo');
        $component->bind(['bar' => 'baz']);
        $this->assertEquals(json_encode($component->toArray()), $component->toJson());
    }

    public function testItImplementsContract()
    {
        $component = new Component('');
        $this->assertInstanceOf(ComponentContract::class, $component);
    }

    public function testPropsArrayIsRendered()
    {
        $component = new Component('foo');
        $component->prop('bar', new Component('baz'));

        $this->assertEquals([
            'name' => 'foo',
            'props' => [
                'bar' => [
                    'name' => 'baz',
                    'props' => [],
                ],
            ],
        ], $component->toArray());
    }
}
