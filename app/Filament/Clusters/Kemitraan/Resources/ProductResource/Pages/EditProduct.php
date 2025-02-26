<?php

namespace App\Filament\Clusters\Kemitraan\Resources\ProductResource\Pages;

use App\Filament\Clusters\Kemitraan\Resources\ProductResource;
use App\Models\Kemitraan\Product;
use App\Models\Kemitraan\ProductGallery;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    // Menambahkan properti untuk menyimpan data gambar
    public $productGalleries = [];
    public $galleryProduct = [];
    public $image = [];

    public $product_id, $name, $is_active, $description, $image_cover;

    public function mount($record): void
    {
        $data = Product::with('galleryProduct')->find($record);
        parent::mount($record);
        $this->image = $data->galleryProduct->pluck('image')
            ->flatten()
            ->map(function ($imagePath) {
                return Storage::url($imagePath);
            })->flatten()
            ->toArray();
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
