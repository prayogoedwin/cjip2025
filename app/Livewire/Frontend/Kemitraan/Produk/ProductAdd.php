<?php

namespace App\Livewire\Frontend\Kemitraan\Produk;

use App\Models\Kemitraan\Product;
use App\Models\Kemitraan\ProductGallery;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Facades\Log;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;

class ProductAdd extends Component implements HasForms
{
    use InteractsWithForms, WithFileUploads;
    public Product $product;
    public ?array $data = [];
    public ProductGallery $galeriProduct;

    public $name,
        $user_id,
        $slug,
        $is_active = false,
        $image_cover,
        $image,
        $description;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Produk')
                    ->required()
                    ->placeholder('Masukan Nama Produk')
                    ->reactive()
                    ->afterStateUpdated(fn($set, ?string $state) => $set('slug', Str::slug($state))),
                Hidden::make('slug')
                    ->label('Slug Produk')
                    ->required(),
                MarkdownEditor::make('description')
                    ->label('Deskripsi')
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'heading',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'table',
                        'underline',
                        'undo',
                        'fullscreen',
                        'justify',
                    ])
                    ->placeholder('Masukan Deskripsi Produk'),
                FileUpload::make('image_cover')
                    ->label('Sampul Produk')
                    ->image()
                    ->required()
                    ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])
                    ->disk('public')
                    ->directory('kemitraan/product/cover')
                    ->maxSize(2048)
                    ->hint('*file maksimal 2 MB')
                    ->preserveFilenames(),
                FileUpload::make('image')
                    ->label('Galeri Produk')
                    ->image()
                    ->required()
                    ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])
                    ->disk('public')
                    ->directory('kemitraan/product/gallery')
                    ->maxSize(2048)
                    ->maxFiles(5)
                    ->multiple()
                    ->hint('*maksimal 5 gambar')
                    ->preserveFilenames(),
                Toggle::make('is_active')
                    ->label('Status')
                    ->default(false)
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-s-check-circle')
                    ->offIcon('heroicon-s-x-circle'),
            ])->statePath('data');
    }

    public function create()
    {
        $user = auth()->user();
        $data = Product::create([
            'user_id' => $user->id,
            'name' => $this->form->getState()['name'],
            'slug' => $this->form->getState()['slug'],
            'description' => $this->form->getState()['description'],
            'image_cover' => $this->form->getState()['image_cover'],
            'is_active' => $this->form->getState()['is_active'],
        ]);

        $galeriProduct = ProductGallery::create([
            'product_id' => $data->id,
            'image' => $this->form->getState()['image'],
        ]);

        session()->flash('message', 'Data saved successfully!');
        Log::info('Product stored, redirecting...');
        return redirect()->route('product.me');
    }

    public function render()
    {
        return view('livewire.frontend.kemitraan.produk.product-add')
            ->layout('components.layouts.master');
    }
}
