@extends('layouts.app')

@section('styles')
<style>
.filter-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}
.chart-container {
    position: relative;
    height: 400px;
    margin-bottom: 20px;
}
.card {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Filters Section -->
    <div class="filter-section">
        <h4>Filters</h4>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label>End Year</label>
                <select id="end_year" class="form-control filter">
                    <option value="">All Years</option>
                    @foreach($filters['end_years'] as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Topic</label>
                <select id="topic" class="form-control filter">
                    <option value="">All Topics</option>
                    @foreach($filters['topics'] as $topic)
                        <option value="{{ $topic }}">{{ $topic }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Sector</label>
                <select id="sector" class="form-control filter">
                    <option value="">All Sectors</option>
                    @foreach($filters['sectors'] as $sector)
                        <option value="{{ $sector }}">{{ $sector }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Region</label>
                <select id="region" class="form-control filter">
                    <option value="">All Regions</option>
                    @foreach($filters['regions'] as $region)
                        <option value="{{ $region }}">{{ $region }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label>PESTLE</label>
                <select id="pestle" class="form-control filter">
                    <option value="">All PESTLE</option>
                    @foreach($filters['pestles'] as $pestle)
                        <option value="{{ $pestle }}">{{ $pestle }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Source</label>
                <select id="source" class="form-control filter">
                    <option value="">All Sources</option>
                    @foreach($filters['sources'] as $source)
                        <option value="{{ $source }}">{{ $source }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Country</label>
                <select id="country" class="form-control filter">
                    <option value="">All Countries</option>
                    @foreach($filters['countries'] as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>SWOT</label>
                <select id="swot" class="form-control filter">
                    <option value="">All SWOT</option>
                    @foreach($filters['swots'] as $swot)
                        <option value="{{ $swot }}">{{ $swot }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="row">
        <!-- Intensity Trends -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Intensity Trends Over Time</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="intensityTrendsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Regional Distribution -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Regional Distribution</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="regionalDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Topic Analysis -->
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Topic Analysis</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="topicAnalysisChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- PESTLE Analysis -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>PESTLE Analysis</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="pestleAnalysisChart"></canvas>
                    </div>
                </div>
            </div>
        </div>


<!-- Likelihood vs Relevance -->
<div class="col-md-12 mb-4">
    <div class="card">
        <div class="card-header">
            <h5>Likelihood vs Relevance Analysis</h5>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="likelihoodRelevanceChart"></canvas>
            </div>
        </div>
    </div>
</div>


    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let charts = {};
const chartColors = [
    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
    '#FF9F40', '#FF6384', '#C9CBCF', '#4BC0C0', '#FF9F40'
];

function initializeCharts() {
    // Initialize Intensity Trends Chart
    charts.intensityTrendsChart = new Chart(
        document.getElementById('intensityTrendsChart').getContext('2d'),
        {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Average Intensity',
                    borderColor: chartColors[0],
                    fill: false,
                    data: []
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Intensity Trends Over Time'
                    }
                }
            }
        }
    );

    // Initialize Regional Distribution Chart
    charts.regionalDistributionChart = new Chart(
        document.getElementById('regionalDistributionChart').getContext('2d'),
        {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Insights Count',
                    backgroundColor: chartColors,
                    data: []
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        }
    );

    // Initialize other charts similarly...

    // Initialize Topic Analysis Chart
charts.topicAnalysisChart = new Chart(
    document.getElementById('topicAnalysisChart').getContext('2d'),
    {
        type: 'bar',
        data: {
            labels: [], // This will hold the topic names
            datasets: [{
                label: 'Count of Insights',
                backgroundColor: chartColors,
                data: [] // This will hold the count of insights for each topic
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Topic Analysis'
                }
            }
        }
    }
);

// Initialize PESTLE Analysis Chart
charts.pestleAnalysisChart = new Chart(
    document.getElementById('pestleAnalysisChart').getContext('2d'),
    {
        type: 'pie',
        data: {
            labels: [], // This will hold the PESTLE categories
            datasets: [{
                label: 'PESTLE Distribution',
                backgroundColor: chartColors,
                data: [] // This will hold the distribution for each PESTLE category
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'PESTLE Analysis'
                }
            }
        }
    }
);

// Initialize Likelihood vs Relevance Chart
charts.likelihoodRelevanceChart = new Chart(document.getElementById('likelihoodRelevanceChart'), {
    type: 'bubble', // Use bubble chart for two-dimensional metrics
    data: {
        datasets: [{
            label: 'Regions',
            data: [], // Will be filled dynamically
            backgroundColor: '#ff6384'
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: { title: { display: true, text: 'Avg Likelihood' } },
            y: { title: { display: true, text: 'Avg Relevance' } }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const region = context.raw.region;
                        const x = context.raw.x;
                        const y = context.raw.y;
                        return `Region: ${region}, Likelihood: ${x}, Relevance: ${y}`;
                    }
                }
            }
        }
    }
});



}

function updateCharts(data) {
    // Update Intensity Trends Chart
    charts.intensityTrendsChart.data.labels = data.intensityByYear.map(item => item.end_year);
    charts.intensityTrendsChart.data.datasets[0].data = data.intensityByYear.map(item => item.avg_intensity);
    charts.intensityTrendsChart.update();

    // Update Regional Distribution Chart
    charts.regionalDistributionChart.data.labels = data.regionalMetrics.map(item => item.region);
    charts.regionalDistributionChart.data.datasets[0].data = data.regionalMetrics.map(item => item.total_insights);
    charts.regionalDistributionChart.update();

    // Update other charts...
     // Update Topic Analysis Chart
     charts.topicAnalysisChart.data.labels = data.topicTrends.map(item => item.topic);
    charts.topicAnalysisChart.data.datasets[0].data = data.topicTrends.map(item => item.count);
    charts.topicAnalysisChart.update();

    // Update PESTLE Analysis Chart
    charts.pestleAnalysisChart.data.labels = data.pestleAnalysis.map(item => item.pestle);
    charts.pestleAnalysisChart.data.datasets[0].data = data.pestleAnalysis.map(item => item.count);
    charts.pestleAnalysisChart.update();

// Update Likelihood vs Relevance Chart
charts.likelihoodRelevanceChart.data.datasets[0].data = data.regionalMetrics.map(item => ({
    x: item.avg_likelihood,
    y: item.avg_relevance,
    region: item.region
}));
charts.likelihoodRelevanceChart.update();




    
    
// // new 
//     // Update Relevance Trends Chart
//     charts.relevanceTrendsChart.data.labels = data.relevanceOverTime.map(item => item.end_year);
//     charts.relevanceTrendsChart.data.datasets[0].data = data.relevanceOverTime.map(item => item.avg_relevance);
//     charts.relevanceTrendsChart.update();

//     // Update Regional Distribution Chart
//     charts.regionalDistributionChart.data.labels = data.regionDistribution.map(item => item.region);
//     charts.regionalDistributionChart.data.datasets[0].data = data.regionDistribution.map(item => item.count);
//     charts.regionalDistributionChart.update();

//     // Update Sector Distribution Chart
//     charts.sectorDistributionChart.data.labels = data.sectorDistribution.map(item => item.sector);
//     charts.sectorDistributionChart.data.datasets[0].data = data.sectorDistribution.map(item => item.count);
//     charts.sectorDistributionChart.update();

//     // Update Topic Analysis Chart
//     charts.topicAnalysisChart.data.labels = data.topicDistribution.map(item => item.topic);
//     charts.topicAnalysisChart.data.datasets[0].data = data.topicDistribution.map(item => item.count);
//     charts.topicAnalysisChart.update();

//     // Update PESTLE Analysis Chart
//     charts.pestleAnalysisChart.data.labels = data.pestleAnalysis.map(item => item.pestle);
//     charts.pestleAnalysisChart.data.datasets[0].data = data.pestleAnalysis.map(item => item.count);
//     charts.pestleAnalysisChart.update();

//     // Update Likelihood vs Relevance Chart
//     charts.likelihoodRelevanceChart.data.datasets[0].data = data.likelihoodRelevance.map(item => ({
//         x: item.likelihood,
//         y: item.relevance
//     }));
//     charts.likelihoodRelevanceChart.update();


}


function fetchData() {
    const filters = {
        end_year: $('#end_year').val(),
        topic: $('#topic').val(),
        sector: $('#sector').val(),
        region: $('#region').val(),
        pestle: $('#pestle').val(),
        source: $('#source').val(),
        country: $('#country').val(),
        swot: $('#swot').val()
    };

    $.ajax({
        url: '/api/dashboard-data',
        data: filters,
        success: function(response) {
            updateCharts(response);
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}

$(document).ready(function() {
    initializeCharts();
    fetchData();

    $('.filter').on('change', fetchData);
});
</script>
@endsection



{{-- 

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Filters</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <select id="end_year" class="form-control filter">
                                <option value="">Select End Year</option>
                                @foreach($filters['end_years'] as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <select id="topic" class="form-control filter">
                                <option value="">Select Topic</option>
                                @foreach($filters['topics'] as $topic)
                                    <option value="{{ $topic }}">{{ $topic }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Add other filter dropdowns similarly -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Intensity by Year</h5>
                </div>
                <div class="card-body">
                    <canvas id="intensityChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Likelihood by Region</h5>
                </div>
                <div class="card-body">
                    <canvas id="likelihoodChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Topic Trends Over Time</h5>
                </div>
                <div class="card-body">
                    <canvas id="topicTrendsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let charts = {};

function initializeCharts() {
    charts.intensityChart = new Chart(document.getElementById('intensityChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Average Intensity',
                data: [],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        }
    });

    charts.likelihoodChart = new Chart(document.getElementById('likelihoodChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Average Likelihood',
                data: [],
                backgroundColor: 'rgb(54, 162, 235)'
            }]
        }
    });

    // Initialize other charts similarly
}

function updateCharts(data) {
    // Update Intensity Chart
    charts.intensityChart.data.labels = data.intensityByYear.map(item => item.end_year);
    charts.intensityChart.data.datasets[0].data = data.intensityByYear.map(item => item.avg_intensity);
    charts.intensityChart.update();

    // Update other charts similarly
}

function fetchData() {
    let filters = {
        end_year: $('#end_year').val(),
        topic: $('#topic').val(),
        // Add other filters
    };

    $.ajax({
        url: '/api/dashboard-data',
        data: filters,
        success: function(response) {
            updateCharts(response);
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}

$(document).ready(function() {
    initializeCharts();
    fetchData();

    $('.filter').on('change', fetchData);
});
</script>
@endsection --}}