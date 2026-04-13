<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    /**
     * FORM (Create & Edit)
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->searchable()
                ->required()
                ->unique(ignoreRecord: true), // 1 user = 1 about

            Forms\Components\Textarea::make('description')
                ->rows(3)
                ->nullable(),

            Forms\Components\Textarea::make('professional_vision')
                ->label('Professional Vision')
                ->rows(3)
                ->nullable(),

            Forms\Components\Textarea::make('mission')
                ->rows(3)
                ->nullable(),

            Forms\Components\TextInput::make('location')
                ->maxLength(255)
                ->nullable(),

            Forms\Components\DatePicker::make('date_of_birth')
                ->nullable(),
        ]);
    }

    /**
     * TABLE (List data)
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                Tables\Columns\TextColumn::make('location')
                    ->searchable(),

                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /**
     * Pages
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
