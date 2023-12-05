<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Filament\Traits\HasFilamentTranslation;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource
{
    use HasFilamentTranslation;

    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-4';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label(__('filament/comment.common.user'))
                            ->placeholder(__('filament/comment.placeholder.user'))
                        ->relationship('user', 'name'),
                        Forms\Components\Select::make('post_id')
                            ->label(__('filament/comment.common.post'))
                            ->placeholder(__('filament/comment.placeholder.post'))
                            ->relationship('post', 'title'),
                        Forms\Components\TextInput::make('text')
                            ->label(__('filament/comment.common.text'))
                            ->placeholder(__('filament/comment.placeholder.text'))
                            ->maxLength(1000),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('filament/comment.common.user')),
                Tables\Columns\TextColumn::make('post.title')
                    ->label(__('filament/comment.common.post')),
                Tables\Columns\TextColumn::make('text')
                    ->label(__('filament/comment.common.text'))
                    ->size(100),
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament.sort.comments');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament/navigation.blog');
    }

}
