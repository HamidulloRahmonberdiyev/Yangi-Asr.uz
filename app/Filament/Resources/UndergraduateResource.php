<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UndergraduateResource\Pages;
use App\Filament\Resources\UndergraduateResource\RelationManagers;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Undergraduate;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UndergraduateResource extends Resource
{
    protected static ?string $model = Undergraduate::class;

    protected static ?string $navigationGroup = 'Dashboard';

    protected static ?string $navigationLabel = 'Undergraduates';

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Tabs::make('Label')
                ->columnSpanFull()
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Uzbek')
                        ->schema([
                            Forms\Components\TextInput::make('title_uz')
                                ->label('Title')
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('text_uz')
                                ->label('Text')
                                ->rows(4)
                                ->columnSpanFull(),
                            Forms\Components\MarkdownEditor::make('duration_uz')
                                ->label('Duration')
                                ->columnSpanFull(),
                        ]),
                    Forms\Components\Tabs\Tab::make('Russian')
                        ->schema([
                            Forms\Components\TextInput::make('title_ru')
                                ->label('Title')
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('text_ru')
                                ->label('Text')
                                ->rows(4)
                                ->columnSpanFull(),
                            Forms\Components\MarkdownEditor::make('duration_ru')
                                ->label('Duration')
                                ->columnSpanFull(),
                        ]),
                    Forms\Components\Tabs\Tab::make('English')
                        ->schema([
                            Forms\Components\TextInput::make('title_en')
                                ->label('Title')
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('text_en')
                                ->label('Text')
                                ->rows(4)
                                ->columnSpanFull(),
                            Forms\Components\MarkdownEditor::make('duration_en')
                                ->label('Duration')
                                ->columnSpanFull(),
                        ]),
                ])
                ->persistTabInQueryString(),

            Forms\Components\Section::make('')
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('User')
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\Select::make('category_id')
                        ->label('Category')
                        ->options(Category::all()->pluck('name_uz', 'id'))
                        ->searchable(),
                    Forms\Components\Select::make('tag_id')
                        ->label('Tag')
                        ->options(Tag::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\FileUpload::make('video')
                        ->moveFiles()
                        ->directory('videos'),
                    Forms\Components\TextInput::make('contract_amount')
                        ->required(),
                    Forms\Components\TextInput::make('course_type')
                        ->required(),
                    Forms\Components\Toggle::make('status')
                        ->label('Status')
                        ->default(0),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                ->sortable(),
            Tables\Columns\TextColumn::make('category.name_uz')
                ->sortable(),
            Tables\Columns\TextColumn::make('tag.name')
                ->sortable(),
            Tables\Columns\TextColumn::make('title_uz')
                ->searchable(),
            Tables\Columns\TextColumn::make('contract_amount'),
            Tables\Columns\TextColumn::make('course_type'),
            Tables\Columns\ToggleColumn::make('status')
                ->sortable(),
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
            'index' => Pages\ListUndergraduates::route('/'),
            'create' => Pages\CreateUndergraduate::route('/create'),
            'edit' => Pages\EditUndergraduate::route('/{record}/edit'),
        ];
    }    
}
