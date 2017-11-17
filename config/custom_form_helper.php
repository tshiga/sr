<?php
return [
    'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
    // Input group wrapper for checkboxes created via control().
    'checkboxFormGroup' => '{{label}}',
    // Wrapper container for checkboxes.
    'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',

    'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}><span class="selection_text"><span>{{text}}</span></span></label>',

    // Radio input element,
    'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
    // Wrapping container for radio input/label,
    'radioWrapper' => '{{label}}',
];

