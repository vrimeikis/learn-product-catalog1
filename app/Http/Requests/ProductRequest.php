<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class ProductRequest
 * @package App\Http\Requests
 */
class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ['title' => 'required|min:3|max:191|string', 'cover' => 'nullable|image|max:2048|min:20|dimensions:min_width:50,min-height=100', 'price' => 'required', 'active' => 'boolean',


        ];
    }
    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return (bool)$this->input('active');
    }
}
