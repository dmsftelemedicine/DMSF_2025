{{-- Consultation and Prescription Charts Configuration --}}
<script>
// Consultation and Prescription Charts Configuration
const consultationCharts = {
    // Monthly Consultations Chart
    initConsultationsChart: function(data) {
        try {
            const ctx = document.getElementById('consultationsChart');
            if (!ctx) {
                return;
            }
            new Chart(ctx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: data.consultationTrends?.months || [],
                    datasets: [{
                        label: 'Consultations',
                        data: data.consultationTrends?.counts || [],
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            display: true,
                            title: {
                                display: true,
                                text: 'Number of Consultations',
                                font: { size: 10 }
                            },
                            ticks: { font: { size: 9 } }
                        },
                        x: { 
                            display: true,
                            title: {
                                display: true,
                                text: 'Month',
                                font: { size: 10 }
                            },
                            ticks: { font: { size: 9 } }
                        }
                    },
                    plugins: {
                        legend: { 
                            display: true,
                            position: 'top',
                            labels: { font: { size: 10 } }
                        }
                    }
                }
            });
        } catch (error) {
        }
    },

    // Prescriptions Chart
    initPrescriptionsChart: function(data) {
        try {
            const ctx = document.getElementById('prescriptionsChart');
            if (!ctx) {
                return;
            }
            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['With Prescription', 'Without Prescription'],
                    datasets: [{
                        label: 'Consultations',
                        data: [
                            data.withPrescription || 0,
                            data.withoutPrescription || 0
                        ],
                        backgroundColor: ['#3B82F6', '#E5E7EB'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { 
                                boxWidth: 12, 
                                fontSize: 10,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });
        } catch (error) {
        }
    },

    // Diagnostic Requests Chart
    initDiagnosticsChart: function(data) {
        try {
            const ctx = document.getElementById('diagnosticsChart');
            if (!ctx) {
                return;
            }
            
            // Show monthly diagnostic requests as a line chart
            const diagnosticTrends = data.diagnosticTrends || {};
            
            new Chart(ctx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: diagnosticTrends.months || [],
                    datasets: [{
                        label: 'Diagnostic Requests',
                        data: diagnosticTrends.counts || [],
                        borderColor: '#F59E0B',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            display: true,
                            title: {
                                display: true,
                                text: 'Number of Requests',
                                font: { size: 10 }
                            },
                            ticks: { 
                                font: { size: 9 },
                                stepSize: 1
                            }
                        },
                        x: { 
                            display: true,
                            title: {
                                display: true,
                                text: 'Month',
                                font: { size: 10 }
                            },
                            ticks: { font: { size: 9 } }
                        }
                    },
                    plugins: {
                        legend: { 
                            display: true,
                            position: 'top',
                            labels: { font: { size: 10 } }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error initializing Diagnostics Chart:', error);
        }
    },

    // Prescription Distribution Chart (larger view)
    initPrescriptionDistributionChart: function(data) {
        try {
            const ctx = document.getElementById('prescriptionDistributionChart');
            if (!ctx) {
                return;
            }
            new Chart(ctx.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: ['With Prescription', 'Without Prescription'],
                    datasets: [{
                        label: 'Consultations',
                        data: [
                            data.withPrescription || 0,
                            data.withoutPrescription || 0
                        ],
                        backgroundColor: ['#3B82F6', '#E5E7EB'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { 
                                boxWidth: 16, 
                                fontSize: 12,
                                font: { size: 12 }
                            }
                        }
                    }
                }
            });
        } catch (error) {
        }
    },

    // Diagnostic Types Chart (larger view)
    initDiagnosticTypesChart: function(data) {
        try {
            const ctx = document.getElementById('diagnosticTypesChart');
            if (!ctx) {
                return;
            }
            
            // Use diagnostic types data if available, otherwise fall back to basic data
            const diagnosticTypes = data.diagnosticTypes || {};
            const hasTypesData = Object.keys(diagnosticTypes).length > 0;
            
            if (hasTypesData) {
                // Show breakdown by diagnostic types
                new Chart(ctx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: Object.keys(diagnosticTypes),
                        datasets: [{
                            label: 'Diagnostic Requests',
                            data: Object.values(diagnosticTypes),
                            backgroundColor: [
                                '#EF4444', // Hematology - Red
                                '#F59E0B', // Clinical Microscopy - Amber
                                '#10B981', // Blood Chemistry - Green
                                '#3B82F6', // Microbiology - Blue
                                '#8B5CF6', // Immunology/Serology - Purple
                                '#EC4899', // Stool Tests - Pink
                                '#06B6D4', // Blood Typing/BSMP - Cyan
                                '#6B7280'  // Others - Gray
                            ],
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { 
                                beginAtZero: true,
                                grid: { display: false },
                                title: {
                                    display: true,
                                    text: 'Number of Requests',
                                    font: { size: 10 }
                                },
                                ticks: { 
                                    font: { size: 9 },
                                    stepSize: 1
                                }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { 
                                    font: { size: 9 },
                                    maxRotation: 45,
                                    minRotation: 45
                                }
                            }
                        },
                        plugins: {
                            legend: { 
                                display: true,
                                position: 'top',
                                labels: { font: { size: 10 } }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + context.parsed.y + ' requests';
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                // Fall back to basic with/without diagnostics data
                new Chart(ctx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['With Diagnostics', 'Without Diagnostics'],
                        datasets: [{
                            label: 'Consultations',
                            data: [
                                data.withDiagnostics || 0,
                                data.withoutDiagnostics || 0
                            ],
                            backgroundColor: ['#F59E0B', '#E5E7EB'],
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { 
                                beginAtZero: true,
                                grid: { display: false },
                                title: {
                                    display: true,
                                    text: 'Number of Consultations',
                                    font: { size: 10 }
                                },
                                ticks: { font: { size: 9 } }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 9 } }
                            }
                        },
                        plugins: {
                            legend: { 
                                display: true,
                                position: 'top',
                                labels: { font: { size: 10 } }
                            }
                        }
                    }
                });
            }
        } catch (error) {
            console.error('Error initializing Diagnostic Types Chart:', error);
        }
    },

    // Initialize all consultation and prescription charts
    initAll: function(dashboardData) {
        this.initConsultationsChart(dashboardData);
        this.initPrescriptionsChart(dashboardData);
        this.initDiagnosticsChart(dashboardData);
        this.initPrescriptionDistributionChart(dashboardData);
        this.initDiagnosticTypesChart(dashboardData);
    }
};
</script>
