<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Projects';

    /**
     * FORM
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')

                ->required(),

            Forms\Components\TextInput::make('project_title')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('project_type')
                ->placeholder('Web App / Mobile App')
                ->nullable(),

            Forms\Components\TextInput::make('client_name')
                ->nullable(),

            Forms\Components\TextInput::make('role')
                ->placeholder('Frontend / Backend')
                ->nullable(),

            Forms\Components\DatePicker::make('start_date'),

            Forms\Components\Toggle::make('is_ongoing')
                ->label('Ongoing Project')
                ->reactive(),

            Forms\Components\DatePicker::make('end_date')
                ->disabled(fn($get) => $get('is_ongoing'))
                ->nullable(),

            Forms\Components\Textarea::make('description')
                ->rows(3)
                ->nullable(),

            Forms\Components\TagsInput::make('technologies')
                ->placeholder('Laravel, Vue, MySQL')
                ->nullable(),

            Forms\Components\TextInput::make('project_url')
                ->url()
                ->nullable(),

            Forms\Components\TextInput::make('github_url')
                ->url()
                ->nullable(),

            Forms\Components\FileUpload::make('thumbnail')
                ->image()
                ->directory('projects')
                ->nullable(),
        ]);
    }

    /**
     * TABLE
     */
    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('start_date', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Image')
                    ->square(),

                Tables\Columns\TextColumn::make('project_title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('project_type')
                    ->badge(),

                Tables\Columns\TextColumn::make('role')
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->date(),

                Tables\Columns\TextColumn::make('end_date')
                    ->formatStateUsing(
                        fn($state, $record) =>
                        $record->is_ongoing ? 'Ongoing' : ($state?->format('d M Y'))
                    ),

                Tables\Columns\IconColumn::make('is_ongoing')
                    ->boolean()
                    ->label('Active'),

                Tables\Columns\TextColumn::make('project_url')
                    ->limit(20)
                    ->url(fn($record) => $record->project_url)
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('github_url')
                    ->limit(20)
                    ->url(fn($record) => $record->github_url)
                    ->openUrlInNewTab(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_ongoing')
                    ->label('Status')
                    ->trueLabel('Ongoing')
                    ->falseLabel('Finished'),
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
     * PAGES
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
