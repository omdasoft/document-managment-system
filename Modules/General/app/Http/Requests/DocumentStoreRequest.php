<?php

namespace Modules\General\Http\Requests;

use App\Enums\ModuleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class DocumentStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'metadata' => 'nullable',
            'module' => ['required', new Enum(ModuleType::class)],
            'header' => 'required',
            'body' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
