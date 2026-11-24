<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages;
use App\Filament\Support\MediaUpload;
use App\Models\Promotion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Медицинский центр';
    protected static ?string $modelLabel = 'Акция';
    protected static ?string $pluralModelLabel = 'Акции';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Заголовок акции')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Слаг (URL)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('service_id')
                    ->label('Связанная услуга')
                    ->relationship('service', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('discount_percent')
                    ->label('Скидка (%)')
                    ->numeric(),
                Forms\Components\DatePicker::make('valid_until')
                    ->label('Действует до'),
                Forms\Components\DatePicker::make('published_at')
                    ->label('Дата публикации'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Активна')
                    ->default(true),
                MediaUpload::field(
                    name: 'media_cover',
                    collection: 'cover',
                    directory: 'cover',
                    label: 'Обложка акции (превью)',
                )->columnSpanFull(),
                Forms\Components\Textarea::make('excerpt')
                    ->label('Краткое описание')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->label('Полный текст акции')
                    ->columnSpanFull(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('media');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                MediaUpload::column('cover_preview', 'cover', 'Превью'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Услуга')
                    ->limit(30),
                Tables\Columns\TextColumn::make('discount_percent')
                    ->label('Скидка')
                    ->suffix('%')
                    ->sortable(),
                Tables\Columns\TextColumn::make('valid_until')
                    ->label('Срок действия')
                    ->date('d.m.Y')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активна')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Статус активности'),
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
            'index' => Pages\ListPromotions::route('/'),
            'create' => Pages\CreatePromotion::route('/create'),
            'edit' => Pages\EditPromotion::route('/{record}/edit'),
        ];
    }
}
