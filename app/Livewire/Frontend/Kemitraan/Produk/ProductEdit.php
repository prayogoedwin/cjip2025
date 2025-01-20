<?php

namespace App\Livewire\Frontend\Kemitraan\Produk;

use App\Models\Kemitraan\Product;
use App\Models\Kemitraan\ProductGallery;
use Closure;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;

class ProductEdit extends Component implements HasForms
{
    use InteractsWithForms;

    use WithFileUploads;

    public Product $product;
    public ProductGallery $galeriProduct;

    public $name, $product_id, $is_active, $description, $slug;
    public $image_cover;
    public $image;
    public function mount($id): void
    {
        $data = Product::with('galleryProduct')->find($id);
        // dd($data);

        $this->product_id = $data->id;
        $this->name = $data->name;
        $this->is_active = $data->is_active == 1;
        $this->description = $data->description;
        $this->slug = $data->slug;

        if (is_array($data->image_cover) || is_object($data->image_cover)) {
            $this->image_cover = $data->image_cover;
        } else {
            $this->image_cover = [$data->image_cover];
        }

        $this->image = $data->galleryProduct->pluck('image')->flatten()->toArray();

        // dd($this->image);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('Nama Produk')
                ->required()
                ->placeholder('Masukan Nama Produk')
                ->reactive()
                ->afterStateUpdated(function (Closure $set, $state) {
                    $set('slug', Str::slug($state));
                }),
            TextInput::make('slug')->required()->hidden(),
            MarkdownEditor::make('description')
                ->label('Deskripsi')
                ->required()
                ->placeholder('Masukan Deskripsi Produk'),
            FileUpload::make('image_cover')
                ->image()
                ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])
                ->disk('public')
                ->directory('kemitraan/product/cover')
                ->required()
                ->maxSize(2048)
                ->hint('*file maksimal 2 MB')
                ->preserveFilenames()
                ->label('Sampul Produk'),

            FileUpload::make('image')
                ->image()
                ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])
                ->disk('public')
                ->directory('kemitraan/product/gallery')
                ->required()
                ->preserveFilenames()
                ->maxFiles(5)
                ->multiple()
                ->hint('*maksimal 5 gambar')
                ->label('Galeri Produk'),
            Toggle::make('is_active')->default(false)->label('Status')
                ->onIcon('heroicon-s-check-circle')
                ->offIcon('heroicon-s-x-circle')
                ->onColor('success')
                ->offColor('danger'),
        ];
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            // Delete related product gallery images
            $productGallery = ProductGallery::where('product_id', $product->id)->get();
            foreach ($productGallery as $galleryItem) {
                Storage::disk('public')->delete($galleryItem->image);
                $galleryItem->delete();
            }

            // Delete the product cover image
            Storage::disk('public')->delete($product->image_cover);

            // Delete related comments
            $product->comment()->delete();

            // Delete related interested users
            $product->productMinat()->delete();

            // Finally, delete the product itself
            $product->delete();
        }
        session()->flash('message', 'Data saved successfully!');
        Log::info('Product stored, redirecting...');
        return redirect()->route('product.me');
    }

    public function deleteImage($id)
    {
        $image = ProductGallery::where('id', $id)->first();
        if ($image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }
    }
    public function store()
    {
        $user = auth()->user();

        $product = Product::find($this->product_id);

        $product->update([
            'user_id' => $user->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'image_cover' => $this->form->getState()['image_cover'],
            'is_active' => $this->is_active,
        ]);

        $image = ProductGallery::where('product_id', $this->product_id);

        $image->update([
            'image' => $this->form->getState()['image'],
        ]);

        session()->flash('message', 'Data saved successfully!');
        Log::info('Product stored, redirecting...');
        return redirect()->route('product.me');
    }

    public function render()
    {
        return view('livewire.frontend.kemitraan.produk.product-edit')->layout('components.layouts.master');
    }
}
