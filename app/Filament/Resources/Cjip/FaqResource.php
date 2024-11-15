<?php

namespace App\Filament\Resources\Cjip;

use App\Filament\Clusters\CJIP;
use App\Filament\Resources\Cjip\FaqResource\Pages;
use App\Filament\Resources\Cjip\FaqResource\RelationManagers;
use App\Models\Cjip\Faq;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FaqResource extends Resource
{
    use Translatable;
    protected static ?string $model = Faq::class;
    protected static ?string $navigationGroup = 'Cjip';

    protected static ?string $navigationLabel = 'Faq';

    protected static ?int $navigationSort = 12;

    protected static ?string $cluster = CJIP::class;

    protected static ?string $recordTitleAttribute = 'question';
    protected static ?string $pluralLabel = 'Faq';

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
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
