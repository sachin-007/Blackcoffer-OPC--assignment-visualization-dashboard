import { chartConfigs, chartHelpers } from './chart-config.js';

class DashboardCharts {
    constructor() {
        this.charts = {};
        this.initializeCharts();
        this.setupEventListeners();
    }

    initializeCharts() {
        // Initialize all charts
        const chartIds = {
            intensityTrends: 'intensityTrendsChart',
            regionalDistribution: 'regionalDistributionChart',
            topicAnalysis: 'topicAnalysisChart',
            pestleAnalysis: 'pestleAnalysisChart',
            sectorDistribution: 'sectorDistributionChart',
            likelihoodTrends: 'likelihoodTrendsChart',
            relevanceByTopic: 'relevanceByTopicChart',
            swotAnalysis: 'swotAnalysisChart',
            yearlyComparison: 'yearlyComparisonChart'
        };

        Object.entries(chartIds).forEach(([configKey, elementId]) => {
            const element = document.getElementById(elementId);
            if (element) {
                this.charts[configKey] = chartHelpers.createChart(
                    elementId,
                    chartConfigs[configKey],
                    {
                        labels: [],
                        datasets: []
                    }
                );
            }
        });
    }

    setupEventListeners() {
        // Set up filter change listeners
        document.querySelectorAll('.filter').forEach(filter => {
            filter.addEventListener('change', () => this.fetchData());
        });
    }

    fetchData() {
        const filters = {
            end_year: document.getElementById('end_year').value,
            topic: document.getElementById('topic').value,
            sector: document.getElementById('sector').value,
            region: document.getElementById('region').value,
            pestle: document.getElementById('pestle').value,
            source: document.getElementById('source').value,
            country: document.getElementById('country').value,
            swot: document.getElementById('swot').value
        };

        fetch('/api/dashboard-data?' + new URLSearchParams(filters))
            .then(response => response.json())
            .then(data => this.updateCharts(data))
            .catch(error => console.error('Error fetching data:', error));
    }

    updateCharts(data) {
        // Update Intensity Trends
        if (this.charts.intensityTrends) {
            chartHelpers.updateChartData(this.charts.intensityTrends, {
                labels: data.intensityByYear.map(item => item.end_year),
                datasets: [chartHelpers.createDataset('Intensity', 
                    data.intensityByYear.map(item => item.avg_intensity))]
            });
        }

        // Update Regional Distribution
        if (this.charts.regionalDistribution) {
            const regions = data.regionalMetrics;
            chartHelpers.updateChartData(this.charts.regionalDistribution, {
                labels: regions.map(item => item.region),
                datasets: [{
                    label: 'Insights Count',
                    data: regions.map(item => item.total_insights),
                    backgroundColor: chartHelpers.getRandomColors(regions.length)
                }]
            });
        }

        // Update other charts similarly...
        // Add update logic for each chart type using the data
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.dashboardCharts = new DashboardCharts();
});