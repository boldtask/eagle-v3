<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaticPageResource\Pages;
use App\Filament\Resources\StaticPageResource\RelationManagers;
use App\Models\State;
use App\Models\StaticPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StaticPageResource extends Resource
{
    protected static ?string $model = StaticPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('auto_approve')
                    ->required()
                    ->default(1),
                Forms\Components\Textarea::make('standard_warranty')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('hoa_warranty')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('florida_standard_warranty')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('florida_hoa_warranty')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('standard_2022_warranty')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('florida_standard_2022_warranty')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('hoa_2022_warranty')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('florida_hoa_2022_warranty')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('auto_approve')
                    ->boolean(),
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
            'index' => Pages\ListStaticPages::route('/'),
            'create' => Pages\CreateStaticPage::route('/create'),
            'edit' => Pages\EditStaticPage::route('/{record}/edit'),
        ];
    }
}
