<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Visit extends Model
{
    protected $table = 'visits';

    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_url',
        'referrer',
        'session_id',
        'request_data',
        'visited_at'
    ];

    protected $casts = [
        'request_data' => 'array',
        'visited_at' => 'datetime'
    ];

    /**
     * Get total visits count
     */
    public static function getTotalVisits()
    {
        return self::count();
    }

    /**
     * Get unique visitors count
     */
    public static function getUniqueVisitors()
    {
        return self::distinct('ip_address')->count('ip_address');
    }

    /**
     * Get visits count for today
     */
    public static function getTodayVisits()
    {
        return self::whereDate('visited_at', Carbon::today())->count();
    }

    /**
     * Get visits count for this month
     */
    public static function getMonthlyVisits()
    {
        return self::whereMonth('visited_at', Carbon::now()->month)
                  ->whereYear('visited_at', Carbon::now()->year)
                  ->count();
    }

    /**
     * Get most visited pages
     */
    public static function getTopPages($limit = 10)
    {
        return self::select('page_url', \DB::raw('count(*) as visits'))
                  ->groupBy('page_url')
                  ->orderBy('visits', 'desc')
                  ->limit($limit)
                  ->get();
    }

    /**
     * Get visits by date for the last N days
     */
    public static function getVisitsByDate($days = 30)
    {
        return self::select(\DB::raw('DATE(visited_at) as date'), \DB::raw('count(*) as visits'))
                  ->where('visited_at', '>=', Carbon::now()->subDays($days))
                  ->groupBy('date')
                  ->orderBy('date')
                  ->get();
    }
}
