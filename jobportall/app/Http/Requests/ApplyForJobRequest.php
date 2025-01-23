<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyForJobRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->role === 'job-seeker';
    }

    public function rules()
    {
        return [
            'job_id' => 'required|exists:jobs,id',
            'cover_letter' => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'job_id.required' => 'Job ID is required.',
            'job_id.exists' => 'The job you are applying for does not exist.',
            'cover_letter.max' => 'Cover letter cannot exceed 500 characters.',
        ];
    }
}
