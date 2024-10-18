<?php

namespace App\Http\Controllers;

use App\Models\DataInsight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataInsightController extends Controller
{
    public function index()
    {
        $filters = [
            'end_years' => DataInsight::distinct('end_year')->whereNotNull('end_year')->pluck('end_year'),
            'topics' => DataInsight::distinct('topic')->whereNotNull('topic')->pluck('topic'),
            'sectors' => DataInsight::distinct('sector')->whereNotNull('sector')->pluck('sector'),
            'regions' => DataInsight::distinct('region')->whereNotNull('region')->pluck('region'),
            'pestles' => DataInsight::distinct('pestle')->whereNotNull('pestle')->pluck('pestle'),
            'sources' => DataInsight::distinct('source')->whereNotNull('source')->pluck('source'),
            'swots' => DataInsight::distinct('swot')->whereNotNull('swot')->pluck('swot'),
            'countries' => DataInsight::distinct('country')->whereNotNull('country')->pluck('country'),
            'cities' => DataInsight::distinct('city')->whereNotNull('city')->pluck('city'),
        ];

        return view('dashboard/index', compact('filters'));
    }

    public function getData(Request $request)
    {
        $query = DataInsight::filter($request->all());

        $data = [
            // Intensity Analysis
            'intensityByYear' => $query->select('end_year', DB::raw('AVG(intensity) as avg_intensity'))
                ->groupBy('end_year')
                ->whereNotNull('end_year')
                ->orderBy('end_year')
                ->get(),

            // Likelihood Analysis
            'likelihoodByRegion' => $query->select('region', DB::raw('AVG(likelihood) as avg_likelihood'))
                ->groupBy('region')
                ->whereNotNull('region')
                ->get(),

            // Relevance Analysis
            'relevanceByTopic' => $query->select('topic', DB::raw('AVG(relevance) as avg_relevance'))
                ->groupBy('topic')
                ->whereNotNull('topic')
                ->get(),

            // Geographic Distribution
            'countryDistribution' => $query->select('country', DB::raw('COUNT(*) as count'))
                ->groupBy('country')
                ->whereNotNull('country')
                ->get(),

            // Topic Analysis
            'topicTrends' => $query->select('topic', 'end_year', DB::raw('COUNT(*) as count'))
                ->groupBy('topic', 'end_year')
                ->whereNotNull(['topic', 'end_year'])
                ->get(),

            // Sector Analysis
            'sectorDistribution' => $query->select('sector', DB::raw('COUNT(*) as count'))
                ->groupBy('sector')
                ->whereNotNull('sector')
                ->get(),

            // PESTLE Analysis
            'pestleAnalysis' => $query->select('pestle', DB::raw('AVG(intensity) as avg_intensity'))
                ->groupBy('pestle')
                ->whereNotNull('pestle')
                ->get(),

            // Regional Insights
            'regionalMetrics' => $query->select(
                'region',
                DB::raw('AVG(intensity) as avg_intensity'),
                DB::raw('AVG(likelihood) as avg_likelihood'),
                DB::raw('AVG(relevance) as avg_relevance'),
                DB::raw('COUNT(*) as total_insights')
            )
                ->groupBy('region')
                ->whereNotNull('region')
                ->get(),

            // SWOT Distribution
            'swotAnalysis' => $query->select('swot', DB::raw('COUNT(*) as count'))
                ->groupBy('swot')
                ->whereNotNull('swot')
                ->get(),

            // Time-based Analysis
            'yearlyTrends' => $query->select(
                'end_year',
                DB::raw('AVG(intensity) as avg_intensity'),
                DB::raw('AVG(likelihood) as avg_likelihood'),
                DB::raw('AVG(relevance) as avg_relevance'),
                DB::raw('COUNT(*) as insight_count')
            )
                ->groupBy('end_year')
                ->whereNotNull('end_year')
                ->orderBy('end_year')
                ->get(),

            // Source Analysis
            'sourceDistribution' => $query->select('source', DB::raw('COUNT(*) as count'))
                ->groupBy('source')
                ->whereNotNull('source')
                ->get(),


          
         // Additional Data (You can add more as needed)
         'likelihoodByRegion' => $query->select('region', DB::raw('AVG(likelihood) as avg_likelihood'))
         ->groupBy('region')
         ->whereNotNull('region')
         ->get(),

        ];
        return response()->json($data);
    }
}