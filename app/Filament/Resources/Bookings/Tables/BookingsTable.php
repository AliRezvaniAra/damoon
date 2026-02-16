<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user_email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('check_in_date')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('check_out_date')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_price')
                    ->formatStateUsing(fn ($state): string => number_format((float) $state, 2, '.', ','))
                    ->searchable()
                    ->sortable(),
                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->label('Status'),
                Filter::make('check_in_date')
                    ->form([
                        DatePicker::make('check_in_from')
                            ->label('Check-in from'),
                        DatePicker::make('check_in_until')
                            ->label('Check-in until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['check_in_from'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('check_in_date', '>=', $date),
                            )
                            ->when(
                                $data['check_in_until'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('check_in_date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if (!empty($data['check_in_from'])) {
                            $indicators['check_in_from'] = 'Check-in from ' . \Carbon\Carbon::parse($data['check_in_from'])->format('M j, Y');
                        }
                        if (!empty($data['check_in_until'])) {
                            $indicators['check_in_until'] = 'Check-in until ' . \Carbon\Carbon::parse($data['check_in_until'])->format('M j, Y');
                        }
                        return $indicators;
                    }),
                Filter::make('check_out_date')
                    ->form([
                        DatePicker::make('check_out_from')
                            ->label('Check-out from'),
                        DatePicker::make('check_out_until')
                            ->label('Check-out until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['check_out_from'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('check_out_date', '>=', $date),
                            )
                            ->when(
                                $data['check_out_until'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('check_out_date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if (!empty($data['check_out_from'])) {
                            $indicators['check_out_from'] = 'Check-out from ' . \Carbon\Carbon::parse($data['check_out_from'])->format('M j, Y');
                        }
                        if (!empty($data['check_out_until'])) {
                            $indicators['check_out_until'] = 'Check-out until ' . \Carbon\Carbon::parse($data['check_out_until'])->format('M j, Y');
                        }
                        return $indicators;
                    }),
            ]);
    }
}
