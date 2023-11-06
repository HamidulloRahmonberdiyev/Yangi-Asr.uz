<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Legislation;
use App\Models\Post;
use App\Models\Undergraduate;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class PostOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $views_count_posts = Post::all()->pluck('views_count')->sum();

        return [
            Stat::make('Number of posts', Post::all()->count())
                ->description("The number of views of posts: $views_count_posts ")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Number of undergraduates', Undergraduate::all()->count())
                ->description("Total number of of undergraduates")
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Number of legislations', Legislation::all()->count())
                ->description("Total number of of legislations")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
        ];
    }
}
