const chartColors = {
    primary: [
        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
        '#FF9F40', '#FF6384', '#C9CBCF', '#4BC0C0', '#FF9F40'
    ],
    backgroundOpacity: 0.2,
    borderWidth: 2
};

const commonOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            position: 'top',
            labels: {
                padding: 20,
                usePointStyle: true
            }
        },
        tooltip: {
            mode: 'index',
            intersect: false,
            padding: 10,
            backgroundColor: 'rgba(0,0,0,0.8)',
            titleColor: '#ffffff',
            bodyColor: '#ffffff',
            borderColor: '#ffffff',
            borderWidth: 1
        }
    }
};

const chartConfigs = {
    intensityTrends: {
        type: 'line',
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: {
                    display: true,
                    text: 'Intensity Trends Over Time',
                    padding: 20
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Year'
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Intensity'
                    }
                }
            }
        }
    },

    regionalDistribution: {
        type: 'bar',
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: {
                    display: true,
                    text: 'Regional Distribution of Insights'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Region'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Insights'
                    }
                }
            }
        }
    },

    topicAnalysis: {
        type: 'bubble',
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: {
                    display: true,
                    text: 'Topic Analysis (Intensity vs Relevance vs Likelihood)'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Intensity'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Relevance'
                    }
                }
            }
        }
    },

    pestleAnalysis: {
        type: 'radar',
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: {
                    display: true,
                    text: 'PESTLE Analysis Overview'
                }
            },
            scales: {
                r: {
                    beginAtZero: true,
                    ticks: {
                        callback: (value) => Math.round(value * 10) / 10
                    }
                }
            }
        }
    },

    sectorDistribution: {
        type: 'doughnut',
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: {
                    display: true,
                    text: 'Sector Distribution'
                }
            },
            cutout: '50%'
        }
    },

    likelihoodTrends: {
        type: 'line',
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: {
                    display: true,
                    text: 'Likelihood Trends Over Time'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Year'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Likelihood'
                    }
                }
            }
        }
    },

    countryHeatmap: {
        type: 'choropleth',
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: {
                    display: true,
                    text: 'Global Distribution of Insights'
                }
            },
            scales: {
                color: {
                    type: 'sequential',
                    scheme: 'Blues'
                }
            }
        }
    },

    relevanceByTopic: {
        type: 'horizontalBar',
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: {
                    display: true,
                    text: 'Relevance by Topic'
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Average Relevance'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Topic'
                    }
                }
            }
        }
    },

    swotAnalysis: {
        type: 'polarArea',
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: {
                    display: true,
                    text: 'SWOT Analysis Distribution'
                }
            },
            scales: {
                r: {
                    beginAtZero: true,
                    ticks: {
                        callback: (value) => Math.round(value)
                    }
                }
            }
        }
    },

    yearlyComparison: {
        type: 'bar',
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: {
                    display: true,
                    text: 'Yearly Comparison (Intensity, Likelihood, Relevance)'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Year'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Value'
                    }
                }
            }
        }
    }
};

// Helper functions for chart creation and updates
const chartHelpers = {
    createChart(canvasId, config, data) {
        const ctx = document.getElementById(canvasId).getContext('2d');
        return new Chart(ctx, {
            type: config.type,
            data: data,
            options: config.options
        });
    },

    updateChartData(chart, newData) {
        chart.data = newData;
        chart.update();
    },

    getRandomColors(count) {
        return Array.from({ length: count }, (_, i) => chartColors.primary[i % chartColors.primary.length]);
    },

    createDataset(label, data, index = 0) {
        return {
            label,
            data,
            backgroundColor: this.getRandomColors(1)[0] + chartColors.backgroundOpacity,
            borderColor: this.getRandomColors(1)[0],
            borderWidth: chartColors.borderWidth
        };
    }
};

// Export the configurations and helpers
export { chartConfigs, chartHelpers, chartColors };

// Usage example:
/*
import { chartConfigs, chartHelpers } from './chart-config.js';

// Create a new chart
const intensityChart = chartHelpers.createChart('intensityChart', 
    chartConfigs.intensityTrends, 
    {
        labels: [],
        datasets: []
    }
);

// Update chart data
chartHelpers.updateChartData(intensityChart, {
    labels: ['2020', '2021', '2022'],
    datasets: [{
        label: 'Intensity',
        data: [45, 52, 48],
        ...chartHelpers.createDataset('Intensity').backgroundColor
    }]
});
*/