<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers\FormatsRelationManager;
use App\Filament\Support\MediaUpload;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?string $navigationGroup = 'Медицинский центр';
    protected static ?string $modelLabel = 'Проект';
    protected static ?string $pluralModelLabel = 'Проекты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Название проекта')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subtitle')
                    ->label('Подзаголовок')
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Слаг (URL)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('published_at')
                    ->label('Дата публикации'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Активен')
                    ->default(true),
                MediaUpload::field(
                    name: 'media_cover',
                    collection: 'cover',
                    directory: 'cover',
                    label: 'Обложка проекта (превью)',
                )->columnSpanFull(),
                MediaUpload::field(
                    name: 'media_gallery',
                    collection: 'gallery',
                    directory: 'gallery',
                    label: 'Галерея фотографий проекта',
                    multiple: true,
                )->columnSpanFull(),
                Forms\Components\Textarea::make('excerpt')
                    ->label('Краткое описание')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('description')
                    ->label('Подробное описание')
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
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Подзаголовок')
                    ->limit(30),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Опубликован')
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
            FormatsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
