<?php

namespace Arbory\AdminLog\Admin\Form;

use Arbory\Base\Admin\Form\Fields\AbstractField;
use Arbory\Base\Html\Elements\Element;

class Serialization extends AbstractField
{
    public function render(): Element
    {
        return (new SerializationRenderer($this))->render();
    }
}
