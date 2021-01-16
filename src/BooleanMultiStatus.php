<?php

namespace Jankapusta\NovaBooleanMultiStatusField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class BooleanMultiStatus extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-boolean-multi-status-field';


    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists($requestAttribute)) {
            $model->{$attribute} = json_decode($request[$requestAttribute], true);
        }
    }

    public function showKeysAsTooltips($value = true)
    {
        return $this->withMeta([
            'showKeysAsTooltips' => $value,
        ]);
    }

    public function width($value)
    {
        return $this->withMeta([
            'width' => $value,
        ]);
    }
}
