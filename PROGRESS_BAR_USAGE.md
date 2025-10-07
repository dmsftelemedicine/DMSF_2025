# Progress Bar Component Usage Examples

The progress-bar component is a reusable Blade component that provides arrow-shaped progress indicators similar to those used in the First Encounter and LD Screening tools.

## Basic Usage

### Simple Arrow Progress Bar (like First Encounter)
```blade
<x-progress-bar 
    :steps="[
        ['title' => 'Informed Consent', 'subtitle' => 'Review and sign'],
        ['title' => 'Inclusion Criteria', 'subtitle' => 'Check eligibility'],
        ['title' => 'Exclusion Criteria', 'subtitle' => 'Verify disqualifying conditions']
    ]"
    :active-step="1"
    :completed-steps="[]"
    id="first-encounter-progress"
    type="arrow"
    :enable-click="true">
    
    <div class="progress-section active" id="step-1">
        <!-- Your content for step 1 -->
        <h3>Informed Consent Content</h3>
    </div>
    
    <div class="progress-section" id="step-2">
        <!-- Your content for step 2 -->
        <h3>Inclusion Criteria Content</h3>
    </div>
    
    <div class="progress-section" id="step-3">
        <!-- Your content for step 3 -->
        <h3>Exclusion Criteria Content</h3>
    </div>
</x-progress-bar>
```

### Tab-based Progress Bar (like LD Screening Tool)
```blade
<x-progress-bar 
    :steps="[
        [
            'title' => 'Nutrition', 
            'subtitle' => 'Dietary assessment',
            'target' => 'nutrition-tab',
            'number' => '1'
        ],
        [
            'title' => 'Physical Activity', 
            'subtitle' => 'Exercise evaluation',
            'target' => 'physical-activity-tab',
            'number' => '2'
        ],
        [
            'title' => 'Quality of Life', 
            'subtitle' => 'Wellness assessment',
            'target' => 'quality-life-tab',
            'number' => '3'
        ],
        [
            'title' => 'Telemedicine', 
            'subtitle' => 'Perception survey',
            'target' => 'telemedicine-tab',
            'number' => '4'
        ]
    ]"
    :active-step="1"
    :completed-steps="[]"
    id="screening-progress"
    type="tab"
    :show-nav="false">
</x-progress-bar>

<!-- Tab content goes here -->
<div class="tab-content">
    <div class="tab-pane fade show active" id="nutrition-tab">
        <!-- Nutrition form content -->
    </div>
    <div class="tab-pane fade" id="physical-activity-tab">
        <!-- Physical activity form content -->
    </div>
    <!-- etc... -->
</div>
```

## Component Properties

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `steps` | Array | `[]` | Array of step definitions with title, subtitle, target, number |
| `activeStep` | Integer | `1` | Currently active step number |
| `completedSteps` | Array | `[]` | Array of completed step numbers |
| `id` | String | `'progress-bar'` | Unique identifier for the progress bar |
| `type` | String | `'arrow'` | Type of progress bar: 'arrow' or 'tab' |
| `showNav` | Boolean | `true` | Whether to show navigation content area |
| `enableClick` | Boolean | `true` | Whether steps are clickable |
| `containerClass` | String | `''` | Additional CSS classes for container |
| `stepClass` | String | `''` | Additional CSS classes for each step |

## Step Definition Structure

Each step in the `steps` array can have the following properties:

```php
[
    'title' => 'Step Title',        // Required: Main step text
    'subtitle' => 'Step Subtitle',  // Optional: Secondary text
    'number' => '1',                // Optional: Step number display
    'target' => 'tab-id'           // Optional: Target element ID for tabs
]
```

## JavaScript API

The component provides a global `ProgressBar` object with the following methods:

### `setActiveStep(progressId, stepNumber)`
Set the active step programmatically.
```javascript
ProgressBar.setActiveStep('screening-progress', 2);
```

### `markCompleted(progressId, stepNumbers)`
Mark multiple steps as completed.
```javascript
ProgressBar.markCompleted('first-encounter-progress', [1, 2]);
```

### `getActiveStep(progressId)`
Get the currently active step number.
```javascript
const activeStep = ProgressBar.getActiveStep('screening-progress');
```

### `getCompletedSteps(progressId)`
Get array of completed step numbers.
```javascript
const completed = ProgressBar.getCompletedSteps('first-encounter-progress');
```

## Custom Events

The component dispatches a `progressStepChanged` event when a step is clicked:

```javascript
document.addEventListener('progressStepChanged', function(event) {
    console.log('Step changed:', event.detail.stepNumber);
    console.log('Progress ID:', event.detail.progressId);
    console.log('Step element:', event.detail.stepElement);
});
```

## Styling Customization

The component includes comprehensive CSS, but you can override styles:

```css
/* Custom colors */
.arrow-steps .progress-step.active {
    background-color: #your-color;
    border-color: #your-border-color;
}

.arrow-steps .progress-step.completed {
    background-color: #your-completed-color;
    border-color: #your-completed-border;
}
```

## Advanced Example with Dynamic Updates

```blade
<x-progress-bar 
    :steps="$dynamicSteps"
    :active-step="$currentStep"
    :completed-steps="$completedSteps"
    id="dynamic-progress"
    type="arrow"
    container-class="my-custom-container"
    step-class="my-custom-step">
    
    @foreach($stepContents as $index => $content)
        <div class="progress-section @if($index == 0) active @endif" id="step-{{ $index + 1 }}">
            {!! $content !!}
        </div>
    @endforeach
</x-progress-bar>

<script>
// Example: Mark step as completed when form is submitted
$('#step1-form').on('submit', function() {
    ProgressBar.markCompleted('dynamic-progress', [1]);
    ProgressBar.setActiveStep('dynamic-progress', 2);
});
</script>
```

## Integration with Existing Code

To replace existing progress bars:

1. **First Encounter**: Replace the existing HTML structure with `<x-progress-bar type="arrow">`
2. **LD Screening**: Replace the existing HTML structure with `<x-progress-bar type="tab">`
3. Update JavaScript to use the new `ProgressBar` API instead of custom implementations
4. Keep existing form validation and AJAX logic, just update the progress tracking calls

## Responsive Behavior

- Desktop: Arrow-shaped steps with overlapping design
- Mobile: Stacked vertical layout with connecting lines
- Automatically adjusts font sizes and spacing for smaller screens