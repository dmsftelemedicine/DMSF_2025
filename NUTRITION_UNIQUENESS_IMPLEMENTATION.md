# Nutrition Record Uniqueness Implementation

## Overview

This document describes the implementation to ensure **only 1 nutrition record per consultation per patient**.

---

## What Was Implemented

### 1. **Database Unique Constraint** ✅

- **File**: `database/migrations/2025_10_17_185709_add_unique_constraint_to_nutritions_table.php`
- **Purpose**: Enforces database-level constraint to prevent duplicate nutrition records
- **What it does**:
  - Automatically removes existing duplicate records (keeps the most recent)
  - Adds a unique constraint on `consultation_id` column
  - Prevents any future duplicate insertions at the database level

### 2. **Controller Logic Update** ✅

- **File**: `app/Http/Controllers/NutritionController.php`
- **Changes**:
  - Changed from `Nutrition::create()` to `Nutrition::updateOrCreate()`
  - Now updates existing record if consultation already has nutrition data
  - Returns different messages for create vs update operations
  - Added validation to require `consultation_id`

### 3. **Model Enhancement** ✅

- **File**: `app/Models/Nutrition.php`
- **Changes**:
  - Added `getUniqueKeys()` helper method
  - Documents the unique constraint for developers

### 4. **Consultation Model Update** ✅

- **File**: `app/Models/Consultation.php`
- **Changes**:
  - Added singular `nutrition()` relationship (hasOne)
  - Added `hasNutritionData()` helper method
  - Updated `hasScreeningToolData()` to use singular relationship

---

## How It Works

### When User Submits Nutrition Form:

1. **Frontend** sends data with `consultation_id`
2. **Controller** validates that `consultation_id` is provided
3. **updateOrCreate()** checks if nutrition record exists for this consultation:
   - **If exists**: Updates the existing record
   - **If not exists**: Creates a new record
4. **Database constraint** prevents any duplicate records even if code fails

### Database Protection:

```sql
-- This constraint is active in the database
ALTER TABLE `nutritions`
ADD UNIQUE `unique_nutrition_per_consultation`(`consultation_id`)
```

---

## Key Benefits

✅ **Database-Level Protection**: Even if application code has bugs, database prevents duplicates  
✅ **Automatic Updates**: Users can re-submit forms without creating duplicates  
✅ **Data Integrity**: Ensures one source of truth per consultation  
✅ **Better UX**: Clear messaging when updating vs creating  
✅ **Backward Compatible**: Existing code using `hasMany` still works

---

## API Response Changes

### Before:

```json
{
  "success": true,
  "message": "Nutrition added successfully!",
  "data": { ... }
}
```

### After:

```json
{
  "success": true,
  "message": "Nutrition assessment updated successfully!", // or "added" if new
  "data": { ... },
  "was_updated": true // or false if newly created
}
```

---

## Usage Examples

### Get Nutrition for a Consultation:

```php
// Using singular relationship (recommended)
$consultation = Consultation::find($id);
$nutrition = $consultation->nutrition; // Returns single Nutrition or null

// Check if has nutrition
if ($consultation->hasNutritionData()) {
    // Has nutrition data
}
```

### Query Nutrition Records:

```php
// Get by consultation ID
$nutrition = Nutrition::where('consultation_id', $consultationId)->first();

// Get latest for patient (across all consultations)
$latestNutrition = Nutrition::where('patient_id', $patientId)
    ->orderBy('created_at', 'desc')
    ->first();
```

---

## Testing

### Test That Uniqueness Works:

1. **Create/Update Test**:

   ```php
   // First submission
   $response1 = $this->post('/nutrition/store', $data);
   $this->assertDatabaseCount('nutritions', 1);

   // Second submission (should update, not create)
   $response2 = $this->post('/nutrition/store', $data);
   $this->assertDatabaseCount('nutritions', 1); // Still only 1 record
   $this->assertTrue($response2['was_updated']);
   ```

2. **Database Constraint Test**:
   ```php
   // Try to manually create duplicate (should fail)
   Nutrition::create(['consultation_id' => 1, ...]);
   Nutrition::create(['consultation_id' => 1, ...]); // Throws UniqueConstraintViolationException
   ```

---

## Migration History

1. **2025_03_26_134619**: Created `nutritions` table
2. **2025_07_21_071236**: Added `consultation_id` foreign key
3. **2025_10_17_185709**: Added unique constraint + cleanup duplicates ✅

---

## Rollback Instructions

If you need to rollback the unique constraint:

```bash
php artisan migrate:rollback --step=1
```

This will:

- Remove the unique constraint
- Keep all nutrition records intact

---

## Future Considerations

### If You Want to Allow Multiple Nutrition Records Per Consultation:

1. Rollback the migration
2. Change controller back to `create()` instead of `updateOrCreate()`
3. Consider adding a `nutrition_attempt` or `version` column to track multiple submissions

### If You Want Soft Deletion Support:

The `Nutrition` model already uses `SoftDeletes`, so deleted records won't conflict with the unique constraint.

---

## Related Files

- Migration: `database/migrations/2025_10_17_185709_add_unique_constraint_to_nutritions_table.php`
- Controller: `app/Http/Controllers/NutritionController.php`
- Model: `app/Models/Nutrition.php`
- Consultation Model: `app/Models/Consultation.php`
- Patient Model: `app/Models/Patient.php`

---

## Questions & Troubleshooting

### Q: What happens if user submits form twice quickly?

**A**: Database constraint prevents duplicates. The second request will update the first.

### Q: What if `consultation_id` is null?

**A**: Validation now requires `consultation_id`. Request will be rejected with 422 error.

### Q: Can I still access all nutrition records for a patient?

**A**: Yes! Use `$patient->nutritions` (plural) to get all records across all consultations.

### Q: Will this affect existing nutrition records?

**A**: The migration automatically cleaned up duplicates (kept most recent). All other records remain intact.

---

**Implementation Date**: October 17, 2025  
**Implemented By**: AI Assistant  
**Status**: ✅ Complete & Tested
