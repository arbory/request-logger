<?php

namespace Arbory\AdminLog\Admin\Form;

use Arbory\Base\Admin\Form\Fields\Renderer\BaseRenderer;
use Arbory\Base\Html\Elements\Element;
use Arbory\Base\Html\Html;

class SerializationRenderer extends BaseRenderer
{
    /**
     * @return Element
     */
    protected function getInput(): Element
    {
        $content = unserialize($this->field->getValue());

        return Html::div(
            Html::pre(
                Html::code(print_r($content, true))->addAttributes([
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

    /**
     * @return Element
     */
    public function render(): Element
    {
        $input = $this->getInput();
        $label = Html::label($this->field->getLabel());

        return $this->buildField($label, $input);
    }

    /**
     * @param array|null $style
     * @return string
     */
    public function getStyle(?array $style = []): string
    {
        $return = '';

        foreach ($style as $rule => $value) {
            $return .= implode(': ', [$rule, $value]) . ';';
        }

        return $return;
    }
}
