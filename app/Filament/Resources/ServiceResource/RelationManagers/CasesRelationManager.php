<?php

namespace App\Filament\Resources\ServiceResource\RelationManagers;

use App\Filament\Support\MediaUpload;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CasesRelationManager extends RelationManager
{
    protected static string $relationship = 'cases';

    protected static ?string $title = 'Кейсы и фото «До / После»';
    protected static ?string $modelLabel = 'Кейс';
    protected static ?string $pluralModelLabel = 'Кейсы';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kind')
                    ->label('Тип кейса')
                    ->options([
                        'type'   => 'Вид процедуры',
                        'result' => 'Результат «До / После»',
                    ])
                    ->default('result')
                    ->required(),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Порядок сортировки')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('title')
                    ->label('Название')
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->rows(3)
                    ->columnSpanFull(),
                MediaUpload::field(
                    name: 'media_before',
                    collection: 'before',
                    directory: 'gallery',
                    label: 'Фото «До»',
                ),
                MediaUpload::field(
                    name: 'media_after',
                    collection: 'after',
                    directory: 'gallery',
                    label: 'Фото «После»',
                ),
                MediaUpload::field(
                    name: 'media_result',
                    collection: 'result',
                    directory: 'gallery',
                    label: 'Фото результата (одно фото)',
                )->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with('media'))
            ->recordTitle(fn ($record): string => $record->title ?: ('Кейс #' . $record->id))
            ->columns([
                MediaUpload::column('before_preview', 'before', 'Фото «До»'),
                MediaUpload::column('after_preview', 'after', 'Фото «После»'),
                MediaUpload::column('result_preview', 'result', 'Результат'),
                Tables\Columns\TextColumn::make('kind')
                    ->label('Тип')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'type'   => 'Вид процедуры',
                        'result' => 'Результат',
                        default  => $state,
                    }),
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->placeholder('—')
                    ->limit(40),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
