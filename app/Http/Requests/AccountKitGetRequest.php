<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountKitGetRequest extends FormRequest
{
    private const STATUS_CANCELLED = 'BAD_PARAMS';
    private const STATUS_ERROR     = 'NOT_AUTHENTICATED';
    private const STATUS_SUCCESS   = 'PARTIALLY_AUTHENTICATED';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return self::STATUS_SUCCESS === $this->request->get('status');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => [
                'required',
                Rule::in([self::STATUS_CANCELLED, self::STATUS_ERROR, self::STATUS_SUCCESS]),
            ],
            'code'  => 'required_if:status,'.self::STATUS_SUCCESS,
            'state' => 'required|string|min:3|max:255',
        ];
    }
}
