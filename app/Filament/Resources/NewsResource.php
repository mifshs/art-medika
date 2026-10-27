<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $modelLabel = 'Новость';
    protected static ?string $pluralModelLabel = 'Новости';
    protected static ?string $navigationLabel = 'Новости';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Заголовок')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Символьный код (URL slug)')
                                    ->required()
                                    ->unique(News::class, 'slug', ignoreRecord: true)
                                    ->maxLength(255),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Тип материала')
                                    ->options([
                                        'news' => 'Новость (стандартный вид)',
                                        'article' => 'Статья (широкий формат с анонсом)',
                                    ])
                                    ->default('news')
                                    ->required(),

                                Forms\Components\Select::make('content_category_id')
                                    ->label('Категория')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->nullable(),

                                Forms\Components\Select::make('expert_id')
                                    ->label('Автор / Эксперт')
                                    ->relationship('author', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->nullable(),
                            ]),

                        Forms\Components\Textarea::make('excerpt')
                            ->label('Краткий анонс (отображается в карточке)')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('content')
                            ->label('Полный текст публикации')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Публикация')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('published_at')
                                    ->label('Дата публикации')
                                    ->default(now()),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Опубликовать на сайте')
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Категория')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'article' => 'warning',
                        default => 'info',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'article' => 'Статья',
                        default => 'Новость',
                    }),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Автор')
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Дата')
                    ->date('d.m.Y')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активна')
                    ->boolean(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Тип')
                    ->options([
                        'news' => 'Новости',
                        'article' => 'Статьи',
                    ]),
                Tables\Filters\SelectFilter::make('content_category_id')
                    ->label('Категория')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активность'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
