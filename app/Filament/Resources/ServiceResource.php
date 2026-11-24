<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers\CasesRelationManager;
use App\Filament\Support\MediaUpload;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Услуги';
    protected static ?string $modelLabel = 'Услуга';
    protected static ?string $pluralModelLabel = 'Услуги';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_category_id')
                    ->label('Категория')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('name')
                    ->label('Название услуги')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Слаг (URL)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('Базовая цена')
                    ->numeric()
                    ->prefix('₽'),
                Forms\Components\TextInput::make('unit')
                    ->label('Ед. измерения')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Сортировка')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('Активна')
                    ->default(true),
                MediaUpload::field(
                    name: 'media_cover',
                    collection: 'cover',
                    directory: 'cover',
                    label: 'Обложка услуги (превью)',
                )->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label('Краткое описание')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('preparation')
                    ->label('Подготовка к процедуре')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('execution')
                    ->label('Способ выполнения')
                    ->columnSpanFull(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['media', 'category.media', 'category.parent.media']);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_preview')
                    ->label('Превью')
                    ->disk('public')
                    ->height(48)
                    ->width(64)
                    ->extraImgAttributes(['class' => 'rounded object-cover'])
                    ->checkFileExistence(false)
                    ->getStateUsing(static function (Service $record): ?string {
                        return MediaUpload::getRecordPreviewState($record, 'cover')
                            ?? ($record->category ? MediaUpload::getRecordPreviewState($record->category, 'cover') : null)
                            ?? ($record->category?->parent ? MediaUpload::getRecordPreviewState($record->category->parent, 'cover') : null);
                    }),
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Категория')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->money('rub')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активна')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Статус активности'),
                Tables\Filters\SelectFilter::make('service_category_id')
                    ->label('Категория')
                    ->relationship('category', 'name'),
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
            CasesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
