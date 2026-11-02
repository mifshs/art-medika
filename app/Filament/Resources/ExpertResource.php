<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpertResource\Pages;
use App\Models\Expert;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ExpertResource extends Resource
{
    protected static ?string $model = Expert::class;

    protected static ?string $modelLabel = 'Специалист';
    protected static ?string $pluralModelLabel = 'Специалисты';
    protected static ?string $navigationLabel = 'Специалисты';
    protected static ?string $navigationGroup = 'Клиника';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('ФИО')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),

                                Forms\Components\TextInput::make('slug')
                                    ->label('URL (slug)')
                                    ->required()
                                    ->unique(Expert::class, 'slug', ignoreRecord: true)
                                    ->maxLength(255),
                            ]),

                        Forms\Components\Select::make('department_id')
                            ->label('Отделение')
                            ->relationship('department', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Forms\Components\Textarea::make('position')
                            ->label('Должность и подробное описание')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Показатели и стаж')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('experience_since')
                                    ->label('Практика с года (напр. 2002)')
                                    ->maxLength(10),

                                Forms\Components\TextInput::make('operations_count')
                                    ->label('Стаж работы в клинике / операций')
                                    ->numeric()
                                    ->default(null),

                                Forms\Components\TextInput::make('positive_percent')
                                    ->label('Положительных отзывов (%)')
                                    ->numeric()
                                    ->suffix('%')
                                    ->default(null),
                            ]),

                        Forms\Components\TagsInput::make('activities')
                            ->label('Направления деятельности')
                            ->placeholder('Добавить направление...')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Публикация')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Порядок сортировки')
                                    ->required()
                                    ->numeric()
                                    ->default(0),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Отображать на сайте')
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('ФИО')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('department.name')
                    ->label('Отделение')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('experience_since')
                    ->label('Стаж с')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('department_id')
                    ->label('Отделение')
                    ->relationship('department', 'name'),
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
            'index' => Pages\ListExperts::route('/'),
            'create' => Pages\CreateExpert::route('/create'),
            'edit' => Pages\EditExpert::route('/{record}/edit'),
        ];
    }
}
