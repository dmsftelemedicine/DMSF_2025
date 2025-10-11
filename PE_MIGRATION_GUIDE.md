# Physical Examination Refactoring - Migration Guide

## Overview

This refactoring transforms the Physical Examination section from jQuery-based, inline code to a modern, data-driven, component-based architecture using vanilla JavaScript.

## What Changed

### ✅ Benefits

- **Reduced DOM weight**: Detail inputs are created lazily only when checkboxes are checked
- **No jQuery dependency**: Pure vanilla JavaScript with event delegation
- **Reusable components**: Single source of truth for all PE sections
- **Better maintainability**: Schema-driven approach makes updates easier
- **Same UX**: Visual appearance and behavior remain identical
- **Accessibility**: Bootstrap 5 tooltips and proper ARIA support

### 📁 New Files Created

1. **`app/Support/PeSchema.php`**

   - Single source of truth for all PE section data
   - Contains `generalSurvey()`, `fingerNails()`, etc.
   - Easy to extend for new sections

2. **`resources/views/components/pe/section.blade.php`**

   - Reusable section component
   - Renders header with "Check All Normal" / "Uncheck All" buttons
   - Loops through rows from schema

3. **`resources/views/components/pe/row.blade.php`**

   - Reusable row component
   - Handles Normal/Abnormal checkboxes
   - Lazy-loads detail inputs via `<template>` tags
   - Server-side rehydration for validation errors (`old()`)

4. **`resources/js/pe.js`**
   - Vanilla JavaScript module
   - Event delegation for efficient DOM handling
   - Manages checkbox toggling and detail input creation
   - Bootstrap tooltip initialization

### 🔄 Modified Files

1. **`resources/js/app.js`**
   - Added import for `pe.js` module

## Data Structure Changes

### Old Format (Numeric Keys)

```php
general_survey[0][normal] = 1
general_survey[0][abnormal][Restless / Agitated] = 1
general_survey[0][abnormal_detail][Restless / Agitated] = "some text"
general_survey[0][abnormal_other] = "other text"
```

### New Format (Semantic Keys)

```php
pe[general_survey][demeanor_body_habitus][normal] = 1
pe[general_survey][demeanor_body_habitus][abnormal][] = restless_agitated
pe[general_survey][demeanor_body_habitus][detail][restless_agitated] = "some text"
pe[general_survey][demeanor_body_habitus][other] = 1
pe[general_survey][demeanor_body_habitus][other_text] = "other text"
```

### Benefits of New Format

- ✅ Semantic keys (`demeanor_body_habitus` vs `0`)
- ✅ Consistent across all sections
- ✅ Works with `old()` and model binding
- ✅ Easier to debug and maintain

## Migration Steps

### Step 1: Extend PeSchema for All Sections

Add methods for each PE section in `app/Support/PeSchema.php`:

```php
public static function skinHair(): array
{
    return [
        'key' => 'skin_hair',
        'title' => 'Skin & Hair Examination',
        'rows' => [
            [
                'key' => 'skin_color',
                'title' => 'Skin Color',
                'normal_label' => 'Even tone, appropriate for ethnicity',
                'options' => [
                    ['key'=>'pallor','label'=>'Pallor','needs_detail'=>true],
                    ['key'=>'cyanosis','label'=>'Cyanosis','needs_detail'=>true],
                    ['key'=>'jaundice','label'=>'Jaundice','needs_detail'=>true],
                    ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                ],
            ],
            // ... more rows
        ],
    ];
}
```

### Step 2: Update Each View File

Replace old code with component:

```blade
@php
    use App\Support\PeSchema;
    $section = PeSchema::skinHair();
    $values  = old('pe.skin_hair', data_get($existingSkinHair ?? $skinHairData ?? [], '', []));
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />
```

### Step 3: Update Controller to Handle New Format

Update your controller to handle the new data structure:

```php
public function store(Request $request)
{
    // Validate
    $validated = $request->validate([
        'pe.general_survey.*.normal' => 'nullable|boolean',
        'pe.general_survey.*.abnormal' => 'nullable|array',
        'pe.general_survey.*.detail' => 'nullable|array',
        'pe.general_survey.*.other_text' => 'nullable|string',
        // ... other sections
    ]);

    // Store in database
    $model->pe_payload = $validated['pe'];
    $model->save();
}
```

### Step 4: Test Each Section

For each migrated section, test:

- ✅ Check All Normal button
- ✅ Uncheck All button
- ✅ Normal checkbox unchecks when abnormal is checked
- ✅ Detail inputs appear/disappear correctly
- ✅ "Other" text input works
- ✅ Form validation errors restore state (`old()`)
- ✅ Tooltips display on hover

## Schema Definition Reference

### Row Schema

```php
[
    'key' => 'row_key',              // snake_case identifier
    'title' => 'Display Title',      // shown in first column
    'normal_label' => 'Normal desc', // shown next to Normal checkbox
    'options' => [                   // abnormal options array
        [
            'key' => 'option_key',   // snake_case identifier
            'label' => 'Display',    // shown next to checkbox
            'help' => 'Tooltip',     // optional tooltip text
            'needs_detail' => true,  // show detail input when checked
            'is_other' => false,     // true for "Other" option
        ],
    ],
]
```

## Backward Compatibility

If you need to support old data format temporarily:

```php
// In your controller or model accessor
public function getPePayloadAttribute($value)
{
    $data = json_decode($value, true);

    // Migrate old format to new if needed
    if (isset($data['general_survey'][0])) {
        $data['general_survey'] = $this->migrateGeneralSurvey($data['general_survey']);
    }

    return $data;
}

private function migrateGeneralSurvey($old)
{
    $mapping = [
        0 => 'demeanor_body_habitus',
        1 => 'breathing',
        2 => 'level_of_alertness',
        3 => 'posture',
    ];

    $new = [];
    foreach ($old as $index => $item) {
        $key = $mapping[$index] ?? "row_$index";
        $new[$key] = $this->migrateRow($item);
    }

    return $new;
}
```

## Common Issues & Solutions

### Issue: Tooltips not showing

**Solution**: Ensure Bootstrap 5 is loaded before pe.js

### Issue: Detail inputs not appearing

**Solution**: Check browser console for JavaScript errors. Ensure `data-pe-*` attributes are present.

### Issue: "Check All Normal" not working

**Solution**: Verify the section has `data-pe-section` attribute

### Issue: Old values not restoring after validation error

**Solution**: Check that `old()` keys match the new format

## Performance Comparison

### Before

- **Initial DOM nodes**: ~150 input fields per section (even when hidden)
- **JavaScript**: jQuery + custom event handlers per checkbox
- **Maintainability**: High duplication across sections

### After

- **Initial DOM nodes**: ~40 input fields per section (only visible ones)
- **JavaScript**: Single event delegation handler for all sections
- **Maintainability**: Change schema once, all sections update

## Next Steps

1. ✅ Migrate `generalSurvey.blade.php` (DONE)
2. ⏳ Migrate remaining sections:
   - skinHair.blade.php
   - fingerNails.blade.php
   - head.blade.php
   - neck.blade.php
   - ear.blade.php
   - backandposture.blade.php
   - thoraxandlungs.blade.php
   - cardiacexam.blade.php
   - breastandaxillae.blade.php
   - malegenitalie.blade.php
   - femalegenitalia.blade.php
   - extremities.blade.php
   - nervoussystem.blade.php
3. ⏳ Update controllers to handle new data format
4. ⏳ Update database seeders/factories if needed
5. ⏳ Test complete flow end-to-end

## Questions?

If you encounter issues during migration:

1. Check browser console for JavaScript errors
2. Verify component file paths match Laravel's conventions
3. Ensure schema keys are snake_case and unique
4. Test with old() helper to ensure form state restoration works
