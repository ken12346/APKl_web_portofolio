<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

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
                ->required(),

            Forms\Components\TextInput::make('position_title')
                ->label('Position')
                ->maxLength(255),

            Forms\Components\TextInput::make('organization_name')
                ->label('Company / Organization')
                ->maxLength(255),

            Forms\Components\DatePicker::make('start_date'),

            Forms\Components\DatePicker::make('end_date')
                ->disabled(fn($get) => $get('is_current')),

            Forms\Components\Toggle::make('is_current')
                ->label('Still Working Here')
                ->reactive(),

            Forms\Components\Textarea::make('description')
                ->rows(3)
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

                Tables\Columns\TextColumn::make('position_title')
                    ->label('Position')
                    ->searchable(),

                Tables\Columns\TextColumn::make('organization_name')
                    ->label('Company')
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->date(),

                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->formatStateUsing(
                        fn($state, $record) =>
                        $record->is_current ? 'Present' : $state
                    ),

                Tables\Columns\IconColumn::make('is_current')
                    ->boolean()
                    ->label('Active'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_current')
                    ->label('Status')
                    ->trueLabel('Still Working')
                    ->falseLabel('Not Working'),
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
