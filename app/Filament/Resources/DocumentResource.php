<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $modelLabel = 'Документ';
    protected static ?string $pluralModelLabel = 'Документы';
    protected static ?string $navigationLabel = 'Документы';
    protected static ?string $navigationGroup = 'Клиника';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Информация о документе')
                    ->schema([
                        Forms\Components\Select::make('category')
                            ->label('Категория документа')
                            ->options([
                                'Организационные документы' => 'Организационные документы',
                                'Нормативно-правовые документы' => 'Нормативно-правовые документы',
                                'Другие документы' => 'Другие документы',
                            ])
                            ->searchable()
                            ->createOptionUsing(fn (string $custom) => $custom)
                            ->required(),

                        Forms\Components\TextInput::make('title')
                            ->label('Название документа')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('file_url')
                            ->label('Файл документа (PDF, DOC, DOCX, изображения)')
                            ->disk('public')
                            ->directory('documents')
                            ->preserveFilenames()
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('published_at')
                                    ->label('Дата документа')
                                    ->default(now()),

                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Порядок сортировки')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category')
                    ->label('Категория')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Название документа')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('file_url')
                    ->label('Файл')
                    ->limit(30),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Дата')
                    ->date('d.m.Y')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Категория')
                    ->options([
                        'Организационные документы' => 'Организационные документы',
                        'Нормативно-правовые документы' => 'Нормативно-правовые документы',
                        'Другие документы' => 'Другие документы',
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
