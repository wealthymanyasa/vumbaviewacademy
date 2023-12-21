<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusLevyCreateRequest extends FormRequest
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
        return [
            'amount' => ['required'],
            'bill_type' => ['required'],
            'academic_year' => ['required'],
            'term' => ['required'],
            'balance',
            'student_id' => ['required'],
            'date_of_payment' => ['required'],
        ];
    }
}
