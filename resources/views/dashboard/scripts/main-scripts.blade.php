{{-- Main Dashboard Scripts --}}
<script>
// Global variables
let dashboardData = {};
let currentDateRange = {
    start: null,
    end: null,
    type: 'currentYear'
};

// Tab switching functionality
function switchTab(tabId) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
        btn.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab
    document.getElementById(tabId).classList.remove('hidden');
    
    // Add active class to clicked button
    const activeBtn = document.getElementById(tabId + '-btn');
    activeBtn.classList.add('active', 'border-blue-500', 'text-blue-600');
    activeBtn.classList.remove('border-transparent', 'text-gray-500');
}

// Date range functionality
function setDateRange(rangeType) {
    const today = new Date();
    let startDate, endDate, displayText;
    
    switch(rangeType) {
        case 'currentMonth':
            startDate = new Date(today.getFullYear(), today.getMonth(), 1);
            endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            displayText = `Current Month (${today.toLocaleDateString('en-US', { month: 'long', year: 'numeric' })})`;
            break;
        case 'last3Months':
            startDate = new Date(today.getFullYear(), today.getMonth() - 2, 1);
            endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            displayText = 'Last 3 Months';
            break;
        case 'lastYear':
            startDate = new Date(today.getFullYear() - 1, 0, 1);
            endDate = new Date(today.getFullYear() - 1, 11, 31);
            displayText = `Last Year (${today.getFullYear() - 1})`;
            break;
        case 'currentYear':
        default:
            startDate = new Date(today.getFullYear(), 0, 2); // why do you even have to be index 0, 2 for jan 1??
            endDate = new Date(today.getFullYear(), 11, 31);
            displayText = `Current Year (${today.getFullYear()})`;
            break;
    }
    
    // Update global state
    currentDateRange = {
        start: formatDate(startDate),
        end: formatDate(endDate),
        type: rangeType
    };
    
    // Update date inputs
    document.getElementById('startDate').value = currentDateRange.start;
    document.getElementById('endDate').value = currentDateRange.end;
    
    // Update display text
    document.getElementById('currentDateRange').textContent = displayText;
    
    // Update button states
    updateDateFilterButtons(rangeType);
    
    // Reload dashboard data with new date range
    loadDashboardData();
}

function applyCustomDateRange() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    
    if (!startDate || !endDate) {
        alert('Please select both start and end dates');
        return;
    }
    
    if (new Date(startDate) > new Date(endDate)) {
        alert('Start date cannot be after end date');
        return;
    }
    
    // Update global state
    currentDateRange = {
        start: startDate,
        end: endDate,
        type: 'custom'
    };
    
    // Update display text
    const startFormatted = new Date(startDate).toLocaleDateString('en-US', { 
        month: 'short', day: 'numeric', year: 'numeric' 
    });
    const endFormatted = new Date(endDate).toLocaleDateString('en-US', { 
        month: 'short', day: 'numeric', year: 'numeric' 
    });
    document.getElementById('currentDateRange').textContent = `Custom Range (${startFormatted} - ${endFormatted})`;
    
    // Update button states
    updateDateFilterButtons('custom');
    
    // Reload dashboard data with new date range
    loadDashboardData();
}

function updateDateFilterButtons(activeType) {
    // Remove active class from all buttons
    document.querySelectorAll('.date-filter-btn').forEach(btn => {
        btn.classList.remove('active', 'bg-blue-500', 'text-white');
        btn.classList.add('bg-gray-100', 'hover:bg-gray-200', 'text-gray-700');
    });
    
    // Add active class to selected button (if not custom)
    if (activeType !== 'custom') {
        const buttons = {
            'currentMonth': 0,
            'last3Months': 1,
            'currentYear': 2,
            'lastYear': 3
        };
        
        const activeIndex = buttons[activeType];
        if (activeIndex !== undefined) {
            const activeBtn = document.querySelectorAll('.date-filter-btn')[activeIndex];
            if (activeBtn) {
                activeBtn.classList.add('active', 'bg-blue-500', 'text-white');
                activeBtn.classList.remove('bg-gray-100', 'hover:bg-gray-200', 'text-gray-700');
            }
        }
    }
}

function formatDate(date) {
    return date.toISOString().split('T')[0];
}

// Load dashboard data
async function loadDashboardData() {
    try {
        // Show loading state
        const dashboardContent = document.getElementById('dashboard-content');
        if (dashboardContent) {
            dashboardContent.style.opacity = '0.5';
        }
        
        // Build URL with date range parameters
        let url = '/dashboard-data';
        const params = new URLSearchParams();
        
        if (currentDateRange.start && currentDateRange.end) {
            params.append('start_date', currentDateRange.start);
            params.append('end_date', currentDateRange.end);
        }
        if (currentDateRange.type) {
            params.append('date_range', currentDateRange.type);
        }
        
        if (params.toString()) {
            url += '?' + params.toString();
        }
        
        console.log('Fetching dashboard data from:', url);
        const response = await fetch(url);
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            const errorText = await response.text();
            throw new Error(`HTTP ${response.status}: ${errorText}`);
        }
        
        dashboardData = await response.json();
        
        // Check if there's an error in the response
        if (dashboardData.error) {
            throw new Error(`Server error: ${dashboardData.message}`);
        }
        
        // Update KPI cards with new data
        updateKPICards();
        
        // Hide loading state
        document.getElementById('dashboard-loading').style.display = 'none';
        
        // Show dashboard content
        document.getElementById('dashboard-content').style.display = 'block';
        dashboardContent.style.opacity = '1';
        
        // Wait a moment for the DOM to be visible before initializing charts
        setTimeout(() => {
            initializeAllCharts();
        }, 100);
        
    } catch (error) {
        console.error('Dashboard loading error:', error);
        document.getElementById('dashboard-loading').innerHTML = `
            <div class="text-center text-red-600">
                <i class="fas fa-exclamation-triangle text-2xl"></i>
                <p class="mt-2">Failed to load dashboard data</p>
                <p class="mt-1 text-sm">${error.message}</p>
                <button onclick="loadDashboardData()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Retry
                </button>
            </div>
        `;
        
        // Reset dashboard content opacity
        const dashboardContent = document.getElementById('dashboard-content');
        if (dashboardContent) {
            dashboardContent.style.opacity = '1';
        }
    }
}

function updateKPICards() {
    // Update KPI card values with new data
    const updates = [
        { selector: '[data-kpi="totalPatients"]', value: dashboardData.totalPatients || 0 },
        { selector: '[data-kpi="totalConsultations"]', value: dashboardData.totalConsultations || 0 },
        { selector: '[data-kpi="newPatientsThisMonth"]', value: dashboardData.newPatientsThisMonth || 0 },
        { selector: '[data-kpi="consultationsThisMonth"]', value: dashboardData.consultationsThisMonth || 0 }
    ];
    
    updates.forEach(update => {
        const element = document.querySelector(update.selector);
        if (element) {
            // Animate the number change
            animateNumber(element, parseInt(element.textContent) || 0, update.value);
        }
    });
}

function animateNumber(element, start, end) {
    const duration = 500; // Animation duration in ms
    const startTime = performance.now();
    
    function updateNumber(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        // Easing function (ease out)
        const easeOut = 1 - Math.pow(1 - progress, 3);
        const current = Math.round(start + (end - start) * easeOut);
        
        element.textContent = current.toLocaleString();
        
        if (progress < 1) {
            requestAnimationFrame(updateNumber);
        }
    }
    
    requestAnimationFrame(updateNumber);
}

// Initialize all charts
function initializeAllCharts() {
    try {
        // Check if Chart.js is loaded
        if (typeof Chart === 'undefined') {
            return;
        }

        // Initialize demographic charts if on patient tab
        if (typeof demographicsCharts !== 'undefined') {
            demographicsCharts.initAll(dashboardData);
        }
        
        // Initialize consultation charts if on consultation tab
        if (typeof consultationCharts !== 'undefined') {
            consultationCharts.initAll(dashboardData);
        }
    } catch (error) {
        console.error('Chart initialization error:', error);
    }
}

// Load dashboard when page is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize date inputs with current year as default
    setDateRange('currentYear');
});

// CSS for active tab styling and date filter buttons
const style = document.createElement('style');
style.textContent = `
    .tab-button.active {
        border-color: #3B82F6 !important;
        color: #3B82F6 !important;
    }
    .tab-button {
        border-color: transparent;
        color: #6B7280;
        transition: all 0.2s ease;
    }
    .tab-button:hover {
        color: #374151;
        border-color: #D1D5DB;
    }
    
    .date-filter-btn.active {
        background-color: #3B82F6 !important;
        color: white !important;
    }
    .date-filter-btn.active:hover {
        background-color: #2563EB !important;
    }
    
    #dashboard-content {
        transition: opacity 0.3s ease;
    }
`;
document.head.appendChild(style);
</script>
