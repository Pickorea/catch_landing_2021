<?php

namespace App\Http\Requests\Landing;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Species;

class UpdateSpeciesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('landing.edit');
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules(): array
    {
        return Species::$rules;
    }
}
