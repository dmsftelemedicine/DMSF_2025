@props([
    'steps' => [],
    'activeStep' => 1,
    'completedSteps' => [],
    'id' => 'progress-bar',
    'type' => 'arrow', // 'arrow' or 'tab'
    'showNav' => true,
    'enableClick' => true,
    'containerClass' => '',
    'stepClass' => ''
])

<div class="progress-nav {{ $containerClass }}" id="{{ $id }}-nav">
    <div class="progress-bar-container">
        <div class="arrow-steps clearfix" data-progress-type="{{ $type }}">
            @foreach($steps as $index => $step)
                @php
                    $stepNumber = $index + 1;
                    $isActive = $stepNumber == $activeStep;
                    $isCompleted = in_array($stepNumber, $completedSteps);
                    $classes = [];
                    
                    if ($type === 'tab') {
                        $classes[] = 'list-group-item list-group-item-action';
                    } else {
                        $classes[] = 'progress-step';
                    }
                    
                    if ($isActive) $classes[] = 'active';
                    if ($isCompleted) $classes[] = 'completed';
                    if ($stepClass) $classes[] = $stepClass;
                    
                    $stepClasses = implode(' ', $classes);
                @endphp
                
                @if($type === 'tab')
                    <a class="{{ $stepClasses }}" 
                       id="{{ $id }}-step-{{ $stepNumber }}" 
                       data-step="{{ $stepNumber }}"
                       @if(isset($step['target'])) 
                           data-bs-toggle="list" 
                           href="#{{ $step['target'] }}" 
                           role="tab" 
                           aria-controls="{{ $step['target'] }}"
                       @endif
                       @if(!$enableClick) style="pointer-events: none;" @endif>
                        <span>
                            @if(isset($step['number']))
                                <div class="step-number">{{ $step['number'] }}</div>
                            @endif
                            <div class="step-title">{{ $step['title'] ?? 'Step ' . $stepNumber }}</div>
                            @if(isset($step['subtitle']))
                                <div class="step-subtitle">{{ $step['subtitle'] }}</div>
                            @endif
                        </span>
                    </a>
                @else
                    <div class="{{ $stepClasses }}" 
                         data-step="{{ $stepNumber }}"
                         @if(!$enableClick) style="pointer-events: none;" @endif>
                        <span>
                            @if(isset($step['number']))
                                <div class="step-number">{{ $step['number'] }}</div>
                            @endif
                            <div class="step-title">{{ $step['title'] ?? 'Step ' . $stepNumber }}</div>
                            @if(isset($step['subtitle']))
                                <div class="step-subtitle">{{ $step['subtitle'] }}</div>
                            @endif
                        </span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

@if($showNav)
    <div class="progress-content" id="{{ $id }}-content">
        {{ $slot }}
    </div>
@endif

<style>
    .clearfix:after {
        clear: both;
        content: "";
        display: block;
        height: 0;
    }

    .progress-nav {
        margin: 1rem 2rem;
        padding: 0 1rem;
        max-width: 1200px;
        font-family: 'Lato', sans-serif;
    }

    .progress-bar-container {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        position: relative;
        margin: 1.5rem 0;
        max-width: 100%;
        overflow: hidden;
    }

    .arrow-steps {
        display: flex;
        justify-content: flex-start;
        gap: 0;
        margin: 0;
        width: 100%;
        flex-direction: row;
        flex-wrap: nowrap;
    }

    /* Progress Step Styling (for div-based steps) */
    .arrow-steps .progress-step {
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        color: #666;
        cursor: pointer;
        margin: 0;
        margin-right: -25px;
        padding: 15px 35px 15px 35px;
        min-width: 180px;
        position: relative;
        background-color: #FFFFFF;
        border: 1px solid #BFBFBF;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none; 
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        z-index: 2;
    }

    /* List Group Item Styling (for tab-based steps) */
    .arrow-steps .list-group-item {
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        color: #666;
        cursor: pointer;
        margin: 0;
        margin-right: -25px;
        padding: 15px 35px 15px 35px;
        min-width: 180px;
        flex: 1;
        position: relative;
        background-color: #FFFFFF;
        border: 1px solid #BFBFBF;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none; 
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50px;
        text-decoration: none;
        max-width: 250px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        z-index: 2;
    }

    /* Modern clip-path approach for clean arrow shapes */
    .arrow-steps .progress-step,
    .arrow-steps .list-group-item {
        clip-path: polygon(0 0, calc(100% - 25px) 0, 100% 50%, calc(100% - 25px) 100%, 0 100%, 25px 50%);
    }

    .arrow-steps .progress-step:first-child,
    .arrow-steps .list-group-item:first-child {
        clip-path: polygon(0 0, calc(100% - 25px) 0, 100% 50%, calc(100% - 25px) 100%, 0 100%, 0 50%);
    }

    .arrow-steps .progress-step:last-child,
    .arrow-steps .list-group-item:last-child {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%, 25px 50%);
    }

    /* Text Styling */
    .arrow-steps .progress-step span,
    .arrow-steps .list-group-item span {
        display: block;
        position: relative;
    }

    .arrow-steps .step-number {
        font-weight: 700;
        font-size: 12px;
        margin-bottom: 2px;
        opacity: 0.9;
    }

    .arrow-steps .step-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 2px;
    }

    .arrow-steps .step-subtitle {
        font-size: 11px;
        opacity: 0.8;
        font-weight: 400;
    }

    /* Active State */
    .arrow-steps .progress-step.active,
    .arrow-steps .list-group-item.active {
        color: #fff;
        background-color: #236477;
        border: 1px solid #173042;
    }

    /* Completed State */
    .arrow-steps .progress-step.completed,
    .arrow-steps .list-group-item.completed {
        color: #7CAD3E;
        background-color: #EBFCD6;
        border: 1px solid #7CAD3E;
    }

    /* Active state takes priority over completed state */
    .arrow-steps .progress-step.completed.active,
    .arrow-steps .list-group-item.active.completed {
        color: #fff;
        background-color: #236477;
        border: 1px solid #173042;
    }

    /* Hover Effects */
    .arrow-steps .progress-step:hover:not(.active),
    .arrow-steps .list-group-item:hover:not(.active) {
        background-color: #f8f9fa;
        border-color: #236477;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    /* Handle single step case */
    .arrow-steps .progress-step:only-child,
    .arrow-steps .list-group-item:only-child {
        min-width: 300px;
    }

    /* Handle two steps case */
    .arrow-steps:has(.progress-step:nth-child(2):last-child) .progress-step,
    .arrow-steps:has(.list-group-item:nth-child(2):last-child) .list-group-item {
        min-width: 250px;
    }

    /* Progress Content */
    .progress-content {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 2rem;
        margin-top: 2rem;
    }

    .progress-section {
        display: none;
    }

    .progress-section.active {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .progress-nav {
            margin: 1rem 0.5rem;
            padding: 0 0.5rem;
        }
        
        .arrow-steps {
            flex-direction: column;
        }
        
        .arrow-steps .progress-step,
        .arrow-steps .list-group-item {
            margin-bottom: 5px;
            margin-right: 0;
            min-width: 200px;
            max-width: none;
            position: relative;
        }
        
        .arrow-steps .progress-step:after,
        .arrow-steps .progress-step:before,
        .arrow-steps .list-group-item:after,
        .arrow-steps .list-group-item:before {
            display: none;
        }
        
        /* Add vertical connector for mobile */
        .arrow-steps .progress-step:not(:last-child)::before,
        .arrow-steps .list-group-item:not(:last-child)::before {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -2px;
            transform: translateX(-50%);
            width: 2px;
            height: 24px;
            background: #0891b2;
            z-index: 1;
        }
        
        /* Reset clip-path for mobile */
        .arrow-steps .progress-step,
        .arrow-steps .list-group-item,
        .arrow-steps .progress-step:first-child,
        .arrow-steps .list-group-item:first-child,
        .arrow-steps .progress-step:last-child,
        .arrow-steps .list-group-item:last-child {
            clip-path: none;
            border-radius: 6px;
        }
    }

    @media (max-width: 480px) {
        .arrow-steps .step-title {
            font-size: 12px;
        }
        
        .arrow-steps .step-subtitle {
            font-size: 10px;
        }
        
        .arrow-steps .step-number {
            font-size: 11px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize progress bar functionality
    const progressBars = document.querySelectorAll('[id$="-nav"]');
    
    progressBars.forEach(progressBar => {
        const progressId = progressBar.id.replace('-nav', '');
        const steps = progressBar.querySelectorAll('[data-step]');
        const content = document.getElementById(progressId + '-content');
        
        // Add click handlers to steps
        steps.forEach(step => {
            step.addEventListener('click', function() {
                const stepNumber = parseInt(this.getAttribute('data-step'));
                const isClickable = this.style.pointerEvents !== 'none';
                
                if (!isClickable) return;
                
                // Update active step
                updateActiveStep(progressBar, stepNumber);
                
                // Show corresponding content if available
                if (content) {
                    showStepContent(content, stepNumber);
                }
                
                // Trigger custom event
                const event = new CustomEvent('progressStepChanged', {
                    detail: { 
                        progressId: progressId,
                        stepNumber: stepNumber,
                        stepElement: this
                    }
                });
                document.dispatchEvent(event);
                
                // Smooth scroll to content
                if (content) {
                    content.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'start' 
                    });
                }
            });
        });
    });
    
    function updateActiveStep(progressBar, stepNumber) {
        const steps = progressBar.querySelectorAll('[data-step]');
        
        steps.forEach(step => {
            const currentStepNumber = parseInt(step.getAttribute('data-step'));
            step.classList.remove('active');
            
            if (currentStepNumber === stepNumber) {
                step.classList.add('active');
            }
        });
    }
    
    function showStepContent(contentContainer, stepNumber) {
        const sections = contentContainer.querySelectorAll('.progress-section');
        
        sections.forEach(section => {
            section.classList.remove('active');
        });
        
        const targetSection = contentContainer.querySelector(`#step-${stepNumber}, .progress-section[data-step="${stepNumber}"]`);
        if (targetSection) {
            targetSection.classList.add('active');
        }
    }
    
    // Utility functions for external use
    window.ProgressBar = {
        setActiveStep: function(progressId, stepNumber) {
            const progressBar = document.getElementById(progressId + '-nav');
            if (progressBar) {
                updateActiveStep(progressBar, stepNumber);
                const content = document.getElementById(progressId + '-content');
                if (content) {
                    showStepContent(content, stepNumber);
                }
            }
        },
        
        markCompleted: function(progressId, stepNumbers) {
            const progressBar = document.getElementById(progressId + '-nav');
            if (!progressBar) return;
            
            const steps = progressBar.querySelectorAll('[data-step]');
            steps.forEach(step => {
                const stepNumber = parseInt(step.getAttribute('data-step'));
                if (stepNumbers.includes(stepNumber)) {
                    step.classList.add('completed');
                } else {
                    step.classList.remove('completed');
                }
            });
        },
        
        getActiveStep: function(progressId) {
            const progressBar = document.getElementById(progressId + '-nav');
            if (!progressBar) return null;
            
            const activeStep = progressBar.querySelector('.active[data-step]');
            return activeStep ? parseInt(activeStep.getAttribute('data-step')) : null;
        },
        
        getCompletedSteps: function(progressId) {
            const progressBar = document.getElementById(progressId + '-nav');
            if (!progressBar) return [];
            
            const completedSteps = progressBar.querySelectorAll('.completed[data-step]');
            return Array.from(completedSteps).map(step => parseInt(step.getAttribute('data-step')));
        }
    };
});
</script>