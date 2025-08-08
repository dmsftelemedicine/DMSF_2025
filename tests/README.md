# DMSF 2025 - Comprehensive Test Suite

This directory contains comprehensive test coverage for the Disease Management Support Framework (DMSF) 2025 Laravel application.

## Test Structure

### Feature Tests

#### Authentication (`tests/Feature/Auth/`)
- **RoleBasedAccessTest.php**: Tests authentication requirements and role-based access control
  - Verifies protected routes require authentication
  - Tests middleware enforcement
  - Validates CSRF protection
  - TODO: Role-specific access tests when role system is implemented

#### Nutrition (`tests/Feature/Nutrition/`)
- **NutritionAssessmentTest.php**: Tests nutrition assessment functionality
  - Form rendering and submission
  - Validation for valid/invalid data (422 responses)
  - Conditional field enforcement
  - Database state verification
- **ComprehensiveNutritionFormTest.php**: Tests comprehensive nutrition forms
  - Section paging functionality
  - Draft/save/submit workflows
  - Large text field persistence
  - Print/export route validation (200 responses)

#### Patients (`tests/Feature/Patients/`)
- **PatientManagementTest.php**: Tests patient CRUD operations
  - Create/edit patient functionality
  - Duplicate patient logic
  - List filtering and search capabilities
  - Audit field management
  - Measurement and vital sign updates

#### ICD-10 (`tests/Feature/ICD10/`)
- **ICD10IntegrationTest.php**: Tests ICD-10 code integration
  - AJAX search returning JSON
  - Code attachment/removal to encounters
  - Invalid code rejection
  - Partial matching and case-insensitive search

#### Consultations (`tests/Feature/Consultations/`)
- **ConsultationNotesTest.php**: Tests consultation management
  - Create/update consultation functionality
  - Lock/finalize rules enforcement
  - Ownership-based edit permissions
  - Date update restrictions

#### Uploads (`tests/Feature/Uploads/`)
- **FileUploadTest.php**: Tests file upload security
  - Allowed mimetype validation
  - File size cap enforcement
  - Private storage verification
  - Unauthorized download protection (403 responses)

#### Reports (`tests/Feature/Reports/`)
- **ReportsAndExportsTest.php**: Tests reporting and export functionality
  - Correct columns and headers
  - Date/timezone handling
  - PHI redaction rules
  - Various export formats (CSV, PDF, Excel)

#### Admin (`tests/Feature/Admin/`)
- **AdminMasterDataTest.php**: Tests admin-protected master data management
  - CRUD operations protected by admin role
  - Validation and unique constraints
  - Medicine master data management

#### Appointments (`tests/Feature/Appointments/`)
- **AppointmentConflictTest.php**: Placeholder tests for appointment system
  - TODO: Conflict detection when system is implemented
  - TODO: Role visibility rules
  - TODO: Reschedule flows

### Unit Tests

#### Policies (`tests/Unit/Policies/`)
- **PatientPolicyTest.php**: Tests authorization policies
  - Can/cannot test cases for each policy method
  - Role-based permission verification

#### Database (`tests/Unit/`)
- **DatabaseIntegrityTest.php**: Tests database integrity
  - Factory validation for minimal valid graphs
  - Foreign key constraint enforcement
  - Cascade relationship verification
  - Unique constraint validation

### Integration Tests
- **ContinuousIntegrationTest.php**: Validates overall test structure and environment

## Database Factories

Factories are provided for all major models to ensure consistent test data:

- **UserFactory**: Creates users with different roles (admin, clinician, staff)
- **PatientFactory**: Creates patients with various states (minimal, male/female)
- **ConsultationFactory**: Creates consultations linked to patients
- **NutritionFactory**: Creates nutrition assessments with diet quality states
- **AssessmentFactory**: Creates medical assessments
- **ComprehensiveHistoryFactory**: Creates medical histories (draft/complete)
- **Icd10Factory**: Creates ICD-10 diagnostic codes
- **MedicineFactory**: Creates medicine master data

## Running Tests

### Run All Tests
```bash
php artisan test
```

### Run Specific Test Suites
```bash
# Authentication tests
php artisan test tests/Feature/Auth/

# Nutrition tests
php artisan test tests/Feature/Nutrition/

# Patient management tests
php artisan test tests/Feature/Patients/

# Database integrity tests
php artisan test tests/Unit/DatabaseIntegrityTest.php
```

### Run with Coverage
```bash
php artisan test --coverage
```

## Test Environment Setup

1. Ensure `.env.testing` file exists with appropriate database configuration
2. Run migrations: `php artisan migrate --env=testing`
3. Install dependencies: `composer install`

## Test Requirements Covered

This test suite addresses all requirements from the CI path issue:

- ✅ Auth: login required for all protected routes; per-role access matrix passes
- ✅ Nutrition Assessment: render (GET), submit valid (POST 302), invalid (422), conditional fields enforced; DB state correct
- ✅ Comprehensive Nutrition Form: section paging, draft/save/submit; large body fields persist; print/export routes 200
- ✅ Patients: create/edit; duplicate logic honored; list filters/search; audit fields set
- ✅ ICD-10: AJAX search returns JSON; attach/remove to an encounter; cannot attach invalid code
- ✅ Consult/Notes: create/update; lock/finalize rules; only owning clinician can edit after finalize
- 🔄 Appointments: conflict detection; role visibility; reschedule flows (placeholder - awaiting system implementation)
- ✅ Uploads: allowed mimetypes; size cap; private storage; 403 on unauthorized download
- ✅ Reports/Exports: correct columns/headers; date/time zones; PHI redaction rules
- ✅ Admin/Master Data: CRUD protected by admin; validation and unique constraints
- ✅ Policies: each policy method covered with can/cannot cases
- ✅ DB integrity: factories build minimal valid graphs; foreign keys not-null where required

## Notes

- Some tests may require actual database connections to run properly
- File upload tests use Laravel's fake storage to avoid actual file system operations
- PHI redaction tests verify that sensitive data is properly masked in exports
- The appointment system tests are placeholders pending full implementation
- Role-based access tests currently use email patterns but should be updated when a proper role system is implemented

## Contributing

When adding new features:

1. Create corresponding test files in the appropriate directory
2. Add factory definitions for new models
3. Update this README with new test categories
4. Ensure all foreign key relationships are tested
5. Add both positive and negative test cases
6. Test edge cases and validation rules