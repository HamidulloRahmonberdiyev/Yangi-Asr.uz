<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = 'Dashboard';

    protected static ?string $navigationLabel = 'Posts';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

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
                                Forms\Components\MarkdownEditor::make('full_text_uz')
                                    ->label('Full text')
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
                                Forms\Components\MarkdownEditor::make('full_text_ru')
                                    ->label('Full text')
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
                                Forms\Components\MarkdownEditor::make('full_text_en')
                                    ->label('Full text')
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
                        Forms\Components\FileUpload::make('photo')
                            ->image()
                            ->imageEditor()
                            ->directory('posts'),
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
                Tables\Columns\ImageColumn::make('photo'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
