<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogSettingResource\Pages;
use App\Filament\Resources\BlogSettingResource\RelationManagers;
use App\Filament\Traits\HasFilamentTranslation;
use App\Models\BlogSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogSettingResource extends Resource
{
    use HasFilamentTranslation;

    protected static ?string $model = BlogSetting::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('default_post_image')
                ->label('filament/blog_setting.common.default_post_image')
                ->placeholder('filament/blog_setting.placeholder.default_post_image')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
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
            'edit' => Pages\EditBlogSetting::route('/{record}/edit'),
        ];
    }
}
