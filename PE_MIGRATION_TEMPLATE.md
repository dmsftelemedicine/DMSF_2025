# Quick Migration Template

Use this template to quickly migrate other PE sections.

## Step 1: Add Schema Method

In `app/Support/PeSchema.php`, add:

```php
public static function sectionName(): array
{
    return [
        'key' => 'section_key',  // e.g., 'skin_hair', 'finger_nails'
        'title' => 'Section Title',  // e.g., 'Skin & Hair Examination'
        'rows' => [
            [
                'key' => 'row_key',
                'title' => 'Row Title',
                'normal_label' => 'Normal description',
                'options' => [
                    ['key'=>'option_1','label'=>'Option 1','help'=>'Optional tooltip','needs_detail'=>true],
                    ['key'=>'option_2','label'=>'Option 2','needs_detail'=>true],
                    ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                ],
            ],
            // Add more rows...
        ],
    ];
}
```

## Step 2: Convert Existing Data Structure

For `fingerNails.blade.php`:

### Before:

```php
$fingerNailsNormalValues = [
    [
        'normal' => 'Pink & smooth',
        'abnormal' => ['Pale', 'Cyanotic', 'Clubbing', 'Other'],
    ],
    [
        'normal' => 'Capillary refill time of <2 seconds',
        'abnormal' => ['Other'],
    ],
];
```

### After (in PeSchema.php):

```php
public static function fingerNails(): array
{
    return [
        'key' => 'finger_nails',
        'title' => 'Finger & Nails Examination',
        'rows' => [
            [
                'key' => 'appearance',
                'title' => 'Appearance',
                'normal_label' => 'Pink & smooth',
                'options' => [
                    ['key'=>'pale','label'=>'Pale','needs_detail'=>true],
                    ['key'=>'cyanotic','label'=>'Cyanotic','needs_detail'=>true],
                    ['key'=>'clubbing','label'=>'Clubbing','needs_detail'=>true],
                    ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                ],
            ],
            [
                'key' => 'capillary_refill',
                'title' => 'Capillary Refill',
                'normal_label' => 'Capillary refill time of <2 seconds',
                'options' => [
                    ['key'=>'delayed','label'=>'Delayed (>2 seconds)','needs_detail'=>true],
                    ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
                ],
            ],
        ],
    ];
}
```

## Step 3: Update Blade File

Replace entire content of `fingerNails.blade.php` with:

```blade
@php
    use App\Support\PeSchema;
    $section = PeSchema::fingerNails();
    $values  = old('pe.finger_nails', data_get($existingFingerNails ?? $fingerNailsData ?? [], '', []));
@endphp

<x-pe.section :section="$section" :values="$values" namePrefix="pe" />
```

## Conversion Checklist

For each section:

- [ ] Copy existing `$xxxCategories` or `$xxxNormalValues` array
- [ ] Create new method in `PeSchema.php`
- [ ] Convert array structure to new format:
  - [ ] Add `key` (snake_case)
  - [ ] Add `title`
  - [ ] Convert `category` → `title` for rows
  - [ ] Convert `normal` → `normal_label`
  - [ ] Convert `abnormal` array items to objects with `key`, `label`, `needs_detail`
  - [ ] Add `help` text where tooltips existed
  - [ ] Mark "Other" options with `is_other: true`
- [ ] Replace blade file content with component usage
- [ ] Test functionality:
  - [ ] Check All Normal
  - [ ] Uncheck All
  - [ ] Detail inputs appear/disappear
  - [ ] Tooltips work
  - [ ] Form validation state restoration

## Example Conversions

### Head Categories

```php
// OLD
[
    'category' => 'Head',
    'normal' => 'Normal skull shape & contour',
    'abnormal' => [
        'Macrocephaly',
        'Microcephaly',
        'Other',
    ],
]

// NEW
[
    'key' => 'head',
    'title' => 'Head',
    'normal_label' => 'Normal skull shape & contour',
    'options' => [
        ['key'=>'macrocephaly','label'=>'Macrocephaly','needs_detail'=>true],
        ['key'=>'microcephaly','label'=>'Microcephaly','needs_detail'=>true],
        ['key'=>'other','label'=>'Other','is_other'=>true,'needs_detail'=>true],
    ],
]
```

### With Tooltips

```php
// OLD (from generalSurvey.blade.php)
@if($abnormal === 'Restless / Agitated')
    <span data-bs-toggle="tooltip" title="Anxiety, pain, delirium, stimulant intoxication">
        <i class="fas fa-info-circle text-info ms-1"></i>
    </span>
@endif

// NEW (in PeSchema)
['key'=>'restless_agitated','label'=>'Restless / Agitated','help'=>'Anxiety, pain, delirium, stimulant intoxication','needs_detail'=>true]
```

## Section Name Mapping

| Blade File                 | Schema Method     | Key              |
| -------------------------- | ----------------- | ---------------- |
| generalSurvey.blade.php    | generalSurvey()   | general_survey   |
| skinHair.blade.php         | skinHair()        | skin_hair        |
| fingerNails.blade.php      | fingerNails()     | finger_nails     |
| head.blade.php             | head()            | head             |
| neck.blade.php             | neck()            | neck             |
| ear.blade.php              | ear()             | ear              |
| backandposture.blade.php   | backPosture()     | back_posture     |
| thoraxandlungs.blade.php   | thoraxLungs()     | thorax_lungs     |
| cardiacexam.blade.php      | cardiacExam()     | cardiac_exam     |
| breastandaxillae.blade.php | breastAxillae()   | breast_axillae   |
| malegenitalie.blade.php    | maleGenitalia()   | male_genitalia   |
| femalegenitalia.blade.php  | femaleGenitalia() | female_genitalia |
| extremities.blade.php      | extremities()     | extremities      |
| nervoussystem.blade.php    | nervousSystem()   | nervous_system   |

## Notes

- Always use **snake_case** for keys
- Set `needs_detail: true` for options that should show text input
- Set `is_other: true` only for "Other" options
- Add `help` text for tooltips (optional)
- Test each section after migration
