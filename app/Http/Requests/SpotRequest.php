<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpotRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'datetime_range.start' => ['sometimes', 'date', 'after_or_equal:now'],
            'datetime_range.end'   => ['sometimes', 'date', 'after:start']
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->get('start') && $this->get('end')) {
            return $this->merge([
                'datetime_range' => [
                    'start' => $this->get('start'),
                    'end'   => $this->get('end'),
                ]
            ]);
        }

        return $this;
    }
}
