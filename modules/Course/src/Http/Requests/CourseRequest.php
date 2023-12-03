<?php

namespace Modules\Course\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route()->user;
        // check xem có phải là update dữ liệu hay là thêm
        // nếu update thì phải tránh báo lỗi khi trùng với chính nó:  `unique:users,email,'.$user->id`
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'parent_id' => ['required','integer']
        ];
        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => __('category::validation.required'),
            'integer' => __('category::validation.integer')
        ];
    }

    function attributes()
    {
        return [
            'name' => __('category::validation.attributes.name'),
            'slug' => __('category::validation.attributes.slug'),
            'parent_id' => __('category::validation.attributes.parent_id'),
        ];
    }
}
