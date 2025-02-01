<?php

namespace App\Livewire\Forms;

use App\Enum\VariantProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product = null;

    public $code = '';

    public $name = '';

    public $image;

    public $variant = '';

    public $price = '';

    public $expired_day = '';

    public function setProduct(Product $product)
    {

        $this->product = $product;

        $this->code = $product->code;

        $this->name = $product->name;

        $this->image = $product->image;

        $this->variant = $product->variant;

        $this->price = $product->price;

        $this->expired_day = $product->expired_day;
    }

    protected function rules()
    {
        $imageRule = $this->image instanceof TemporaryUploadedFile
            ? 'image|mimes:jpeg,png,jpg|max:2048'  // Validasi hanya jika gambar baru diunggah
            : ($this->product && $this->product->exists
                ? 'nullable'  // Saat update, gambar boleh kosong
                : 'required|image|mimes:jpeg,png,jpg|max:2048');  // Saat create, gambar wajib

        return [
            'code' => [
                'required',
                Rule::unique('products', 'code')->ignore($this->product),
            ],
            'name' => 'required',
            'image' => $imageRule,
            'variant' => [
                'required',
                new Enum(VariantProduct::class),
            ],
            'price' => 'required|numeric|min:0',
            'expired_day' => 'required|numeric|min:0',
        ];
    }

    public function store()
    {
        $this->validate();

        $fileName = time().'.'.strtolower($this->image->getClientOriginalExtension());
        $this->image->storeAs('images', $fileName, 'public');

        Product::create([
            'code' => $this->code,
            'name' => $this->name,
            'image' => $fileName,
            'variant' => $this->variant,
            'price' => $this->price,
            'expired_day' => $this->expired_day,
        ]);
    }

    public function update()
    {
        $this->validate();

        if ($this->product->image !== $this->image) {
            $fileName = time().'.'.strtolower($this->image->getClientOriginalExtension());
            $this->image->storeAs('images', $fileName, 'public');

            $oldImage = $this->product->image;
            if ($oldImage && Storage::disk('public')->exists('images/'.$oldImage)) {
                Storage::disk('public')->delete('images/'.$oldImage);
            }

            $this->product->image = $fileName;
        } else {
            $fileName = $this->product->image;
        }

        $this->product->update([
            'code' => $this->code,
            'name' => $this->name,
            'image' => $fileName,
            'variant' => $this->variant,
            'price' => $this->price,
            'expired_day' => $this->expired_day,
        ]);

        $this->resetValidation();
    }

    public function destroy($id)
    {
        $product = Product::find($id)->first();

        if ($product) {
            $filePath = '/images/'.$product->image;
            if ($product->image && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return $product->delete();
        }

        return false;
    }
}
