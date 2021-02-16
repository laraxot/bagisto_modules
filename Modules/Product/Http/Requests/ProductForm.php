<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Repositories\ProductAttributeValueRepository;
use Modules\Product\Models\ProductAttributeValue;

class ProductForm extends FormRequest
{
    /**
     * ProductRepository object
     *
     * @var \Modules\Product\Repositories\ProductRepository
     */
    protected $productRepository;

    /**
     * ProductAttributeValueRepository object
     *
     * @var \Modules\Product\Repositories\ProductAttributeValueRepository
     */
    protected $productAttributeValueRepository;

    /**
     * @var array
     */
    protected $rules;

    /**
     * Create a new form request instance.
     *
     * @param  \Modules\Product\Repositories\ProductRepository  $productRepository
     * @param  \Modules\Product\Repositories\ProductAttributeValueRepository $productAttributeValueRepository
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductAttributeValueRepository $productAttributeValueRepository
    )
    {
        $this->productRepository = $productRepository;

        $this->productAttributeValueRepository = $productAttributeValueRepository;
    }

    /**
     * Determine if the product is authorized to make this request.
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
        $product = $this->productRepository->find($this->id);

        $maxVideoFileSize = (core()->getConfigData('catalog.products.attribute.file_attribute_upload_size')) ? core()->getConfigData('catalog.products.attribute.file_attribute_upload_size') : '2048' ;

        $this->rules = array_merge($product->getTypeInstance()->getTypeValidationRules(), [
            'sku'                => ['required', 'unique:products,sku,' . $this->id, new \Modules\Core\Contracts\Validations\Slug],
            'images.*'           => 'nullable|mimes:bmp,jpeg,jpg,png,webp',
            'videos.*'           => "nullable|mimes:mov,mp4|max:$maxVideoFileSize",
            'special_price_from' => 'nullable|date',
            'special_price_to'   => 'nullable|date|after_or_equal:special_price_from',
            'special_price'      => ['nullable', new \Modules\Core\Contracts\Validations\Decimal, 'lt:price'],
        ]);

        foreach ($product->getEditableAttributes() as $attribute) {
            if ($attribute->code == 'sku' || $attribute->type == 'boolean') {
                continue;
            }

            $validations = [];

            if (! isset($this->rules[$attribute->code])) {
                array_push($validations, $attribute->is_required ? 'required' : 'nullable');
            } else {
                $validations = $this->rules[$attribute->code];
            }

            if ($attribute->type == 'text' && $attribute->validation) {
                array_push($validations,
                    $attribute->validation == 'decimal'
                    ? new \Modules\Core\Contracts\Validations\Decimal
                    : $attribute->validation
                );
            }

            if ($attribute->type == 'price') {
                array_push($validations, new \Modules\Core\Contracts\Validations\Decimal);
            }

            if ($attribute->is_unique) {
                array_push($validations, function ($field, $value, $fail) use ($attribute) {
                    $column = ProductAttributeValue::$attributeTypeFields[$attribute->type];

                    if (! $this->productAttributeValueRepository->isValueUnique($this->id, $attribute->id, $column, request($attribute->code))) {
                        $fail('The :attribute has already been taken.');
                    }
                });
            }

            $this->rules[$attribute->code] = $validations;
        }

        return $this->rules;
    }

    /**
     * Custom message for validation
     *
     * @return array
    */
    public function messages()
    {
        return [
            'variants.*.sku.unique' => 'The sku has already been taken.',
        ];
    }
}