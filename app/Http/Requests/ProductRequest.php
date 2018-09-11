<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * @method getSlug()
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
        return [
            'title' => 'required|min:3|max:191|string',
            'context' => 'required',
            'cover' => 'nullable|image|max:2048|min:20|dimensions:min_width:50,min-height=100',
            'price' => 'required',
            'active' => 'boolean',
            'category' => [
                'nullable',
                'array',
                'exists:categories,id',
            ],
        ];
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function (Validator $validator) {
            if ($this->isMethod('post') && $this->slugExists()) {
                $validator
                    ->errors()
                    ->add('title', 'Slug by name exists on DB');
                return;
            }
        });
        return $validator;
    }

    /**
     * @return bool
     */
    protected function slugExists(): bool
    {
        $slug = Product::whereSlug($this->getSlug())->get();

        if (!empty($slug->toArray())) {
            return true;
        }
        return false;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ? string
    {
        return $this->input('title');
    }

    public function getContext(): string
    {
        return $this->input('context');
    }

    /**
     * @return UploadedFile|null
     */
    public function getCover(): ? UploadedFile
    {
        return $this->file('cover');
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->input('price');
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return (bool)$this->input('active');
    }

    /**
     * @return array
     */
    public function getCategoriesIds(): array
    {
        return $this->input('category', []);
    }
}
