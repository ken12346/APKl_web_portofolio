<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $navigationLabel = 'Contacts';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),

            Forms\Components\Select::make('contact_type')
                ->options([
                    'email' => 'Email',
                    'whatsapp' => 'WhatsApp',
                    'linkedin' => 'LinkedIn',
                    'github' => 'GitHub',
                ])
                ->required(),

            Forms\Components\TextInput::make('contact_value')
                ->label('Contact')
                ->required()
                ->maxLength(255),

            Forms\Components\Toggle::make('is_public')
                ->label('Public')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                Tables\Columns\TextColumn::make('contact_type')
                    ->badge()
                    ->colors([
                        'primary' => 'email',
                        'success' => 'whatsapp',
                        'info' => 'linkedin',
                        'warning' => 'github',
                    ]),

                Tables\Columns\TextColumn::make('contact_value')
                    ->limit(30)
                    ->copyable(),

                Tables\Columns\IconColumn::make('is_public')
                    ->boolean()
                    ->label('Public'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('contact_type')
                    ->options([
                        'email' => 'Email',
                        'whatsapp' => 'WhatsApp',
                        'linkedin' => 'LinkedIn',
                        'github' => 'GitHub',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
