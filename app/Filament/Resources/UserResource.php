<?php

namespace App\Filament\Resources;

use App\Enum\UserRolesEnum;
use App\Enums\SpatiePermissionsRolesEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Traits\HasFilamentTranslation;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    use HasFilamentTranslation;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')
                        ->label(__('filament/user.common.name'))
                        ->placeholder(__('filament/user.placeholder.name'))
                        ->afterStateHydrated(function (TextInput $component, $state) {
                            $component->state(trim($state));
                        })
                        ->maxLength(255)
                        ->required(),
                    TextInput::make('email')
                        ->label(__('filament/user.common.email'))
                        ->unique(ignoreRecord: true)
                        ->placeholder(__('filament/user.placeholder.email'))
                        ->afterStateHydrated(function (TextInput $component, $state) {
                            $component->state(trim($state));
                        })
                        ->email()
                        ->maxLength(255)
                        ->required(),
                ]),
                Forms\Components\Select::make('roles')
                    ->label(__('filament/user.common.role'))
                    ->relationship('roles', 'name')
                    ->placeholder(__('filament/user.placeholder.role'))
                    ->required()
                    ->options(Role::query()
                        ->get(['id', 'name'])
                        ->mapWithKeys(function ($item, int $key) {
                            return [$item['id'] => UserRolesEnum::localization()[$item['name']]];
                        })),
                TextInput::make('password')
                    ->label(__('filament/user.common.password'))
                    ->placeholder(__('filament/user.placeholder.password'))
                    ->password()
                    ->rules(['confirmed'])
                    ->confirmed()
                    ->maxLength(255),
                TextInput::make('password_confirmation')
                    ->label(__('filament/user.common.password_confirmation'))
                    ->placeholder(__('filament/user.placeholder.password_confirmation'))
                    ->password()
                    ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament/user.common.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('filament/user.common.email'))
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament.sort.users');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('filament/navigation.blog');
    }


}
