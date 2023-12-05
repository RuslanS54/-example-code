<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers;
use App\Filament\Traits\HasFilamentTranslation;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TagResource extends Resource
{
    use HasFilamentTranslation;

    protected static ?string $model = Tag::class;

    protected static ?string $navigationIcon = 'heroicon-o-hashtag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('filament/tag.common.name'))
                                    ->placeholder(__('filament/tag.placeholder.name'))
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\TextInput::make('order')
                                    ->label(__('filament/tag.common.order'))
                                    ->placeholder(__('filament/tag.placeholder.order'))
                                    ->integer()
                                    ->minValue(0)
                                    ->default(fn() => Tag::query()->max('order') ?? 0)
                                    ->required(),
                                Forms\Components\TextInput::make('slug')
                                    ->label(__('filament/tag.common.slug'))
                                    ->placeholder(__('filament/tag.placeholder.slug'))
                                    ->maxLength(255)
                                    ->hiddenOn('create')
                                    ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament/tag.common.name')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListTags::route('/'),
            'create' => Pages\CreateTag::route('/create'),
            'edit' => Pages\EditTag::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament.sort.tags');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament/navigation.blog');
    }

}
