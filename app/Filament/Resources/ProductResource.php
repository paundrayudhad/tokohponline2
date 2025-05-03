<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Product Information')
                ->schema([
                    Forms\Components\Select::make('brand_id')
                        ->label('Brand')
                        ->options(Brand::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),

                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, $set) => $set('slug', Str::slug($state))),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    Forms\Components\Textarea::make('description')
                        ->required()
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Forms\Components\Section::make('Specifications')
                ->schema([
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\TextInput::make('specs.chipset')->label('Chipset')->required(),
                        Forms\Components\TextInput::make('specs.display')->label('Display')->required(),
                        Forms\Components\TextInput::make('specs.battery')->label('Battery Capacity')->required()->suffix('mAh'),
                    ]),
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\TextInput::make('specs.os')->label('Operating System')->default('Android'),
                        Forms\Components\TextInput::make('specs.resolution')->label('Resolution'),
                        Forms\Components\TextInput::make('specs.refresh_rate')->label('Refresh Rate')->suffix('Hz'),
                    ]),
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\TextInput::make('specs.main_camera')->label('Main Camera'),
                        Forms\Components\TextInput::make('specs.front_camera')->label('Front Camera'),
                        Forms\Components\TextInput::make('specs.weight')->label('Weight')->suffix('g'),
                    ]),
                ])
                ->collapsible()
                ->collapsed(),

            Forms\Components\Section::make('Product Variations')
                ->schema([
                    Forms\Components\Repeater::make('variations')
                        ->schema([
                            Forms\Components\TextInput::make('ram')->label('RAM (GB)')->numeric()->required(),
                            Forms\Components\TextInput::make('storage')->label('Storage (GB)')->numeric()->required(),
                            Forms\Components\TextInput::make('price')->label('Harga')->numeric()->required()->prefix('Rp'),
                        ])
                        ->columns(3)
                        ->columnSpanFull()
                        ->label('Available Variations')
                        ->reactive()
                        ->hidden(fn (callable $get) => $get('is_preorder')), // Sembunyikan kalau preorder aktif
                ])
                ->collapsible()
                ->collapsed(),

            Forms\Components\Section::make('Media')
                ->schema([
                    Forms\Components\FileUpload::make('image')->image()->directory('products')->required(),
                    Forms\Components\FileUpload::make('gallery')->image()->directory('products/gallery')->multiple()->reorderable(),
                ]),

            Forms\Components\Section::make('Status')
                ->schema([
                    Forms\Components\Toggle::make('is_preorder')
                        ->label('Preorder')
                        ->default(false)
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            if ($state) {
                                $set('variations', []); // Jika preorder aktif, kosongkan variations
                            }
                        }),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')->size(50)->label(''),
            Tables\Columns\TextColumn::make('brand.name')->sortable()->searchable()->label('Brand'),
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->label('Product Name')
                ->description(fn(Product $record) => $record->specs['chipset'] ?? ''),
            Tables\Columns\TextColumn::make('specs.display')->label('Display')->wrap()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('specs.battery')
                ->label('Battery')
                ->formatStateUsing(fn($state) => $state ? "{$state} mAh" : '')
                ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('variations')
                ->label('Variations')
                ->formatStateUsing(function ($state) {
                    // Handle empty state
                    if (empty($state)) return '-';

                    // Decode JSON string to array
                    $variations = json_decode('['.$state.']', true);

                    // Jika decode gagal
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return 'Invalid data format';
                    }

                    // Process variations
                    return collect($variations)->map(function ($item) {
                        $ram = $item['ram'] ?? '?';
                        $storage = $item['storage'] ?? '?';
                        $price = isset($item['price']) ? 'Rp '.number_format((int)$item['price'], 0, ',', '.') : '?';

                        return "{$ram}GB/{$storage}GB - {$price}";
                    })->implode('<br>');
                })
                ->html()
                ->searchable()
                ->sortable(),

            Tables\Columns\IconColumn::make('is_preorder')->boolean()->label('Preorder'),
            Tables\Columns\IconColumn::make('is_active')->boolean()->label('Active'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('brand')
                ->relationship('brand', 'name')
                ->label('Filter by Brand'),

            Tables\Filters\Filter::make('preorder')
                ->query(fn($query) => $query->where('is_preorder', true))
                ->label('Preorder Only'),

            Tables\Filters\Filter::make('active')
                ->query(fn($query) => $query->where('is_active', true))
                ->label('Active Only'),

            Tables\Filters\SelectFilter::make('ram')
                ->label('Filter by RAM')
                ->options(fn() => Product::all()
                    ->flatMap(fn($product) => collect($product->variations ?: [])->pluck('ram'))
                    ->filter()
                    ->unique()
                    ->sort()
                    ->mapWithKeys(fn($ram) => [$ram => "{$ram} GB"])
                    ->toArray()
                )
                ->query(function (Builder $query, array $data) {
                    if (!empty($data['value'])) {
                        $query->whereJsonContains('variations', [['ram' => (int)$data['value']]]);
                    }
                }),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\ViewAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
