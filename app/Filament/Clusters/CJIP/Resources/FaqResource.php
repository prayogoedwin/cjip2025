<?php

namespace App\Filament\Clusters\CJIP\Resources;

use App\Filament\Clusters\CJIP;
use App\Filament\Clusters\CJIP\Resources\FaqResource\Pages;
use App\Filament\Clusters\CJIP\Resources\FaqResource\RelationManagers;
use App\Models\Cjip\Faq;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FaqResource extends Resource
{
    use Translatable;
    protected static ?string $model = Faq::class;

    protected static ?string $navigationGroup = 'CJIP';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'FAQ';

    protected static ?string $pluralLabel = 'FAQ';

    protected static ?string $cluster = CJIP::class;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('question'),
                    Forms\Components\RichEditor::make('answer')->label('answer')
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'codeBlock',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'undo',
                        ]),
                    Forms\Components\Select::make('jenis_id')->relationship('jenisfaqs', 'nama')->label('Jenis Faq')
                ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')->wrap()->label('Question')->searchable()->sortable(),
                TextColumn::make('answer')->wrap()->limit(250)->label('Answer')->searchable()->sortable()->toggleable(),
                TextColumn::make('jenisfaqs.nama')->wrap()->label('Jenis Faqs')->searchable()->sortable(),
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
