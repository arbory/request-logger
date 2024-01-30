<?php

namespace Arbory\AdminLog\Admin\Form;

use Arbory\Base\Admin\Form\Fields\FieldInterface;
use Arbory\Base\Admin\Form\Fields\Renderer\GenericRenderer;
use Arbory\Base\Html\Elements\Element;
use Arbory\Base\Html\Html;

class SerializationRenderer extends GenericRenderer
{
    public function __construct(FieldInterface $field)
    {
        $this->field = $field;
    }

    protected function getInput(): Element
    {
        $content = unserialize($this->field->getValue());

        return Html::div(
            new Element(
                'pre',
                (new Element('code', print_r($content, true)))->addAttributes([
                    'style' => $this->getStyle([
                        'white-space' => 'pre-wrap'
                    ])
                ])
            )
        )->addAttributes([
            'style' => $this->getStyle([
                'line-height' => '1.2',
                'font-size' => '12px',
                'background-color' => '#f8f8f8',
                'border' => '1px solid #d4d4d4',
                'margin' => 0,
                'padding' => '0 12px',
            ])
        ]);
    }

    public function render(): Element
    {
        return $this->getInput();
    }

    public function getStyle(?array $style = []): string
    {
        $return = '';

        foreach ($style as $rule => $value) {
            $return .= implode(': ', [$rule, $value]) . ';';
        }

        return $return;
    }
}
