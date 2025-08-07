{{-- Main Dashboard Scripts --}}
<script>
// Global variables
let dashboardData = {};

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

// Load dashboard data
async function loadDashboardData() {
    try {
        console.log('Fetching dashboard data from /dashboard-data');
        const response = await fetch('/dashboard-data');
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        
        if (!response.ok) {
            const errorText = await response.text();
            throw new Error(`HTTP ${response.status}: ${errorText}`);
        }
        
        dashboardData = await response.json();
        
        // Check if there's an error in the response
        if (dashboardData.error) {
            throw new Error(`Server error: ${dashboardData.message}`);
        }
        
        // Hide loading state
        document.getElementById('dashboard-loading').style.display = 'none';
        
        // Show dashboard content
        document.getElementById('dashboard-content').style.display = 'block';
        
        // Wait a moment for the DOM to be visible before initializing charts
        setTimeout(() => {
            initializeAllCharts();
        }, 100);
        
    } catch (error) {
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
    }
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
    }
}

// Load dashboard when page is ready
document.addEventListener('DOMContentLoaded', function() {
    loadDashboardData();
});

// CSS for active tab styling
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
`;
document.head.appendChild(style);
</script>
