<?php

namespace Tests\Ui;

use Macrame\Form\Fields\Select;
use PHPUnit\Framework\TestCase;
use Macrame\Contracts\Ui\Component;
use Illuminate\Testing\AssertableJsonString;

class FieldSelectTest extends TestCase
{
    public function testOptions()
    {
        $field = new Select('foo', ['bar' => 'Bar']);
        $this->assertEquals(['bar' => 'Bar'], $field->options);
    }

    public function testRendering()
    {
        $field = new Select('foo', ['bar' => 'Bar']);
        $this->assertInstanceOf(Component::class, $component = $field->getComponent());
        $props = new AssertableJsonString($component->getProps());
        $props->assertFragment([
            'attribute' => 'foo',
        ]);
        $this->assertArrayHasKey('selectComponent', $props->json);
        $this->assertInstanceOf(Component::class, $props['selectComponent']);
        $props = new AssertableJsonString($props['selectComponent']->getProps());
        $props->assertFragment([
            'options' => ['bar' => 'Bar'],
        ]);
    }
}
