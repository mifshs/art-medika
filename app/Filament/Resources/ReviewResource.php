<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Support\MediaUpload;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationGroup = 'Заявки и отзывы';
    protected static ?string $modelLabel = 'Отзыв';
    protected static ?string $pluralModelLabel = 'Отзывы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('author_name')
                    ->label('Автор отзыва')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rating')
                    ->label('Оценка (от 1 до 5)')
                    ->numeric()
                    ->default(5)
                    ->minValue(1)
                    ->maxValue(5)
                    ->required(),
                Forms\Components\Select::make('expert_id')
                    ->label('Врач')
                    ->relationship('expert', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('service_id')
                    ->label('Услуга')
                    ->relationship('service', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('source')
                    ->label('Источник отзыва')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('published_at')
                    ->label('Дата публикации'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Опубликован')
                    ->default(true),
                MediaUpload::field(
                    name: 'media_avatar',
                    collection: 'avatar',
                    directory: 'avatar',
                    label: 'Фото автора (превью)',
                )->columnSpanFull(),
                Forms\Components\Textarea::make('history')
                    ->label('Текст отзыва')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('liked')
                    ->label('Что понравилось')
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
                MediaUpload::column('avatar_preview', 'avatar', 'Фото', circular: true),
                Tables\Columns\TextColumn::make('author_name')
                    ->label('Автор')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Оценка')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expert.name')
                    ->label('Врач'),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Дата')
                    ->date('d.m.Y')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активен')
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
