<?php

namespace App\Filament\Resources\Hotels\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RoomsRelationManager extends RelationManager
{
    protected static string $relationship = 'rooms';

    protected static ?string $title = 'Rooms';

    protected static ?string $recordTitleAttribute = 'room_number';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('room_number')
                    ->required()
                    ->maxLength(255)
                    ->label('Room number'),
                TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->minValue(1),
                TextInput::make('price_per_night')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix('$'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('room_number')
            ->columns([
                TextColumn::make('room_number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('capacity')
                    ->sortable(),
                TextColumn::make('price_per_night')
                    ->money()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
