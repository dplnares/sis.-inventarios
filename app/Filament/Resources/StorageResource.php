<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StorageResource\Pages;
use App\Filament\Resources\StorageResource\RelationManagers;
use App\Models\Storage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StorageResource extends Resource
{
  protected static ?string $model = Storage::class;

  protected static ?string $navigationIcon = 'storage';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('name')
          ->label('Nombre')
          ->required(),
        Forms\Components\TextInput::make('location')
          ->label('Ubicación')
          ->required(),
        Forms\Components\Select::make('status')
          ->options([
            'activo' => 'Activo',
            'desactivado' => 'Desactivado',
          ])
          ->label('Estado')
          ->required(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->searchable(),
        Tables\Columns\TextColumn::make('location')
          ->searchable(),
        Tables\Columns\TextColumn::make('status')
          ->badge()
          ->color(fn(string $state): string => match ($state) {
            'activo' => 'success',
            'desactivado' => 'danger',
            default => 'warning',
          },),
      ])
      ->filters([
        Tables\Filters\SelectFilter::make('status')
          ->options([
            'activo' => 'Activo',
            'desactivado' => 'Desactivado',
          ]),
        
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
      'index' => Pages\ListStorages::route('/'),
      'create' => Pages\CreateStorage::route('/create'),
      'edit' => Pages\EditStorage::route('/{record}/edit'),
    ];
  }
}
