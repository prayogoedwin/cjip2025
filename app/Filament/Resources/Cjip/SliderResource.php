<?php

namespace App\Filament\Resources\Cjip;

use App\Filament\Resources\Cjip\SliderResource\Pages;
use App\Filament\Resources\Cjip\SliderResource\RelationManagers;
use App\Models\Cjip\Slider;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SliderResource extends Resource
{
    use Translatable;

    protected static ?string $model = Slider::class;
    protected static ?string $navigationGroup = 'Cjip';

    protected static ?int $navigationSort = 30;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    FileUpload::make('foto')
                        ->label('Image')->directory('slider/' . Auth::user()->name . '/' . Carbon::now()->year)
                        ->enableOpen()
                        ->enableDownload()
                        ->imageCropAspectRatio('16:9'),
                    // ->modalSize('2xl')
                    // ->zoomable(true)
                    // ->enableZoomButtons()
                    // ->enableAspectRatioFreeMode()
                    // ->modalHeading("Crop Background Image"),
                    TextInput::make('title'),
                    Textarea::make('desc')->label('Description'),
                    Repeater::make('button')
                        ->schema([
                            TextInput::make('btn_name')->label('Button Name '),
                            TextInput::make('btn_link')->label('Button Link'),
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->wrap()->searchable()->sortable(),
                TextColumn::make('desc')->wrap()->searchable()->sortable()->label('Description'),
                ImageColumn::make('foto')->searchable()->sortable()->label('Images'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
