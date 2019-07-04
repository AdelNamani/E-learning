<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "name"=>"required|max:50|min:5",
            "description"=>"required|max:30000|min:20",
            'photo' => 'image|mimes:jpeg,png,jpg',
            /**TODO : Validate image dimensions
             * check that :
             * https://itsolutionstuff.com/post/laravel-53-image-dimension-validation-rules-exampleexample.html
             */
        ];
    }
}
