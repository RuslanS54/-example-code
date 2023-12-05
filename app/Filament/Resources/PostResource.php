<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Traits\HasFilamentTranslation;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    use HasFilamentTranslation;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('filament/post.common.title'))
                            ->placeholder(__('filament/post.placeholder.title'))
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\Textarea::make('text')
                            ->label(__('filament/post.common.text'))
                            ->placeholder(__('filament/post.placeholder.text'))
                            ->maxLength(5000)
                            ->required(),
                        Forms\Components\FileUpload::make('image')
                            ->label(__('filament/post.common.image'))
                            ->placeholder(__('filament/post.placeholder.image'))
                            ->required(),
                        Forms\Components\TextInput::make('slug')
                            ->label(__('filament/post.common.slug'))
                            ->placeholder(__('filament/post.placeholder.slug'))
                            ->maxLength(255)
                            ->hiddenOn('create')
                            ->required(),
                        Forms\Components\Select::make('tags')
                            ->label(__('filament/post.common.tag'))
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->searchable(),
                        Forms\Components\Placeholder::make('view')
                            ->label(__('filament/post.common.view'))
                            ->hiddenOn('create'),
                        Forms\Components\Toggle::make('is_published')
                            ->label(__('filament/post.common.is_published'))
                            ->default(false)
                            ->required(),
                        Forms\Components\TextInput::make('time_reading')
                            ->label(__('filament/post.common.time_reading'))
                            ->placeholder(__('filament/post.placeholder.time_reading'))
                            ->integer()
                            ->minValue(0)
                            ->maxLength(255)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament/post.common.title'))
                    ->label(__('filament/post.placeholder.title')),
                Tables\Columns\ToggleColumn::make('is_published')
                    ->label(__('filament/post.common.is_published'))
                    ->default(false),
                TextColumn::make('time_reading')
                    ->label(__('filament/post.common.time_reading'))
                    ->label(__('filament/post.placeholder.time_reading'))
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament.sort.posts');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament/navigation.blog');
    }

}
