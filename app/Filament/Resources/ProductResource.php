<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
  protected static ?string $model = Product::class;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('name')
          ->label('Name')
          ->required()
          ->maxLength(255)
          ->placeholder('Enter the product name'),
        Forms\Components\Select::make('status')
          ->label('Status')
          ->options([
            'activo'=> 'Activo',
            'desactivado'=> 'Desactivado',
          ]),
        Forms\Components\Select::make('categorie_id')
          ->label('Category')
          ->relationship('categorie', 'name')
          ->searchable()
          ->preload()
          ->createOptionForm([
            Forms\Components\TextInput::make('name')
            ->label('Name')
            ->maxLength(255)
            ->required(),
          ])
          ->required(),


      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name'),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime(),
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
      'index' => Pages\ListProducts::route('/'),
      'create' => Pages\CreateProduct::route('/create'),
      'edit' => Pages\EditProduct::route('/{record}/edit'),
    ];
  }
}
