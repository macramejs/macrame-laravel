<?php

namespace Tests\Ui;

use Illuminate\Testing\AssertableJsonString;
use Macrame\Contracts\Ui\Component;
use Macrame\Form\Fields\Checkboxes;
use PHPUnit\Framework\TestCase;

class FieldCheckboxesTest extends TestCase
{
    public function testOptions()
    {
        $field = new Checkboxes('foo', ['bar' => 'Bar']);
        $this->assertEquals(['bar' => 'Bar'], $field->options);
    }

    public function testRendering()
    {
        $field = new Checkboxes('foo', ['bar' => 'Bar']);
        $this->assertInstanceOf(Component::class, $component = $field->getComponent());
        $props = new AssertableJsonString($component->getProps());
        $props->assertFragment([
            'attribute' => 'foo',
            'options'   => ['bar' => 'Bar'],
        ]);
        $this->assertArrayHasKey('checkboxComponent', $props->json);
        $this->assertInstanceOf(Component::class, $props['checkboxComponent']);
    }
}
