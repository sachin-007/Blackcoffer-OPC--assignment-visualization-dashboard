<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataInsight extends Model
{
    protected $table = 'data';


    // Define fillable fields to allow mass assignment
    protected $fillable = [
        'end_year', 'citylng', 'citylat', 'intensity', 'sector', 'topic',
        'insight', 'swot', 'url', 'region', 'impact', 'added', 'published',
        'start_year', 'city', 'country', 'relevance', 'pestle', 'source', 
        'title', 'likelihood'
    ];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['end_year'] ?? false, function($query, $year) {
            $query->where('end_year', $year);
        });

        $query->when($filters['topic'] ?? false, function($query, $topic) {
            $query->where('topic', 'LIKE', "%{$topic}%");
        });

        $query->when($filters['sector'] ?? false, function($query, $sector) {
            $query->where('sector', $sector);
        });

        $query->when($filters['region'] ?? false, function($query, $region) {
            $query->where('region', $region);
        });

        $query->when($filters['pestle'] ?? false, function($query, $pestle) {
            $query->where('pestle', $pestle);
        });

        $query->when($filters['source'] ?? false, function($query, $source) {
            $query->where('source', $source);
        });

        $query->when($filters['swot'] ?? false, function($query, $swot) {
            $query->where('swot', $swot);
        });

        $query->when($filters['country'] ?? false, function($query, $country) {
            $query->where('country', $country);
        });

        $query->when($filters['city'] ?? false, function($query, $city) {
            $query->where('city', $city);
        });

        return $query;
    }
}
