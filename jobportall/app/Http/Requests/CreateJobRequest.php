<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobRequest extends FormRequest
{
    public function authorize()
    {
        // Only allow authenticated users to post jobs (employers)
        return auth()->check() && auth()->user()->role === 'employer';
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Job title is required.',
            'description.required' => 'Job description is required.',
            'category_id.required' => 'Job category is required.',
            'category_id.exists' => 'The selected category does not exist.',
        ];
    }
}
