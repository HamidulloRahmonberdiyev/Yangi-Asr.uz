<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LegislationResource\Pages;
use App\Filament\Resources\LegislationResource\RelationManagers;
use App\Models\Category;
use App\Models\Legislation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LegislationResource extends Resource
{
    protected static ?string $model = Legislation::class;

    protected static ?string $navigationGroup = 'Dashboard';

    protected static ?string $navigationLabel = 'Legislations';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

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
                            ]),
                        Forms\Components\Tabs\Tab::make('Russian')
                            ->schema([
                                Forms\Components\TextInput::make('title_ru')
                                    ->label('Title')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('English')
                            ->schema([
                                Forms\Components\TextInput::make('title_en')
                                    ->label('Title')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->persistTabInQueryString(),

                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->options(Category::all()->pluck('name_uz', 'id'))
                            ->searchable(),
                        Forms\Components\DateTimePicker::make('c_date')
                            ->native(false)
                            ->timezone('Asia/Tashkent')
                            ->required(),
                        Forms\Components\FileUpload::make('pdf_file')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('pdf_legislations'),
                        Forms\Components\FileUpload::make('doc_file')
                            ->acceptedFileTypes(['application/*'])
                            ->directory('doc_legislations'),
                        Forms\Components\FileUpload::make('excel_file')
                            ->acceptedFileTypes(['application/*'])
                            ->directory('excel_legislations'),
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
            Tables\Columns\TextColumn::make('category.name_uz')
                ->sortable(),
            Tables\Columns\TextColumn::make('title_uz')
                ->searchable(),
            Tables\Columns\TextColumn::make('c_date')
                ->label('Date'),
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
            'index' => Pages\ListLegislations::route('/'),
            'create' => Pages\CreateLegislation::route('/create'),
            'edit' => Pages\EditLegislation::route('/{record}/edit'),
        ];
    }
}
