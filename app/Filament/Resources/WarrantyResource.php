<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WarrantyResource\Pages;
use App\Filament\Resources\WarrantyResource\RelationManagers;
use App\Models\Warranty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WarrantyResource extends Resource
{
    protected static ?string $model = Warranty::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('owner_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('co_owner_id')
                    ->numeric(),
                Forms\Components\Select::make('roofer_id')
                    ->relationship('roofer', 'name'),
                Forms\Components\Select::make('builder_id')
                    ->relationship('builder', 'name'),
                Forms\Components\Select::make('contractor_id')
                    ->relationship('contractor', 'name'),
                Forms\Components\TextInput::make('hoa')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('warranty_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('install_date')
                    ->required(),
                Forms\Components\TextInput::make('tile_profile')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tile_color')
                    ->maxLength(255),
                Forms\Components\TextInput::make('is_approved')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('owner.full_name'),
                Tables\Columns\TextColumn::make('coOwner.full_name')
                    ->label('Co-owner')
                    ->numeric(),
                Tables\Columns\TextColumn::make('roofer.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('builder.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contractor.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('hoa')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('warranty_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('install_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tile_profile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tile_color')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('pending_hoa')
                    ->label('Pending HOA')
                    ->query(fn (Builder $query): Builder => $query->where('is_approved', false)->where('hoa', true)),

                Tables\Filters\Filter::make('pending_standard')
                    ->label('Pending Standard')
                    ->query(fn (Builder $query): Builder => $query->where('is_approved', false)->where('hoa', false))
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
            'index' => Pages\ListWarranties::route('/'),
            'create' => Pages\CreateWarranty::route('/create'),
            'edit' => Pages\EditWarranty::route('/{record}/edit'),
        ];
    }
}
