<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReleaseNoteResource\Pages;
use App\Models\ReleaseNote;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReleaseNoteResource extends Resource
{
    protected static ?string $model = ReleaseNote::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Release Note Data')
                    ->description('Basic information about this release')
                    ->columns(2)
                    ->icon('heroicon-m-pencil-square')
                    ->schema([
                        TextInput::make('title')->autofocus()->required(),
                        Forms\Components\Toggle::make('inline')->default(false)->hint('Set true for small updates')->inline(false),
                        TextInput::make('author')->required(),
                        Forms\Components\Select::make('type')->options([
                            'release' => 'Release Note',
                            'game' => 'Game Update',
                            'ucp' => 'UCP Update',
                        ])->required()->native(false),
                        Forms\Components\Select::make('status')->options([
                            'draft' => 'Draft',
                            'published' => 'Published',
                        ])->required()->native(false),
                        TextInput::make('slug')->disabled(),
                    ]),
                Section::make('Main Image')
                    ->description('The main image shown on the release notes page (optional)')
                    ->columns(1)
                    ->icon('heroicon-o-camera')
                    ->schema([
                        Forms\Components\FileUpload::make('image')->image()->disk('public')->directory('release-notes')->nullable(),
                    ]),
                Section::make('Content')
                    ->description('The content of this release note')
                    ->columns(1)
                    ->icon('heroicon-o-document')
                    ->schema([
                        Forms\Components\RichEditor::make('description')->required()->hint('A basic introduction to the release, shown on the release notes page')->fileAttachmentsDisk('public')->fileAttachmentsDirectory('release-notes/attachments')->toolbarButtons(['bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList', 'h2', 'h3', 'blockquote', 'attachFiles']),
                        Forms\Components\RichEditor::make('content')->required()->hint('The main content of the release note')->fileAttachmentsDisk('public')->fileAttachmentsDirectory('release-notes/attachments')->toolbarButtons(['bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList', 'h2', 'h3', 'blockquote', 'codeBlock', 'attachFiles']),
                    ]),
                Section::make('Changes')
                    ->description('The changes made in this release. Write in bulletpoints for better readability.')
                    ->columns(1)
                    ->icon('heroicon-o-pencil')
                    ->schema([
                        Forms\Components\RichEditor::make('added')->hint('New features added in this release')->fileAttachmentsDisk('public')->fileAttachmentsDirectory('release-notes/attachments')->toolbarButtons(['bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList', 'attachFiles']),
                        Forms\Components\RichEditor::make('changed')->hint('Changes made to existing features')->fileAttachmentsDisk('public')->fileAttachmentsDirectory('release-notes/attachments')->toolbarButtons(['bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList', 'attachFiles']),
                        Forms\Components\RichEditor::make('fixed')->hint('Bugs fixed in this release')->fileAttachmentsDisk('public')->fileAttachmentsDirectory('release-notes/attachments')->toolbarButtons(['bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList', 'attachFiles']),
                        Forms\Components\RichEditor::make('removed')->hint('Features removed in this release')->fileAttachmentsDisk('public')->fileAttachmentsDirectory('release-notes/attachments')->toolbarButtons(['bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList', 'attachFiles']),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('author'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('published_at'),
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
            'index' => Pages\ListReleaseNotes::route('/'),
            'create' => Pages\CreateReleaseNote::route('/create'),
            'edit' => Pages\EditReleaseNote::route('/{record}/edit'),
        ];
    }
}
