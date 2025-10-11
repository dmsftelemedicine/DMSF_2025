#!/usr/bin/env php
<?php

/**
 * Physical Examination Component Verification Script
 * 
 * Run this script to verify all PE components are correctly installed.
 * 
 * Usage: php verify-pe-setup.php
 */

$baseDir = __DIR__;
$errors = [];
$warnings = [];
$success = [];

echo "\n";
echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║  Physical Examination Component Verification                   ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n";
echo "\n";

// Check required files
$requiredFiles = [
    'app/Support/PeSchema.php' => 'Schema definition file',
    'resources/views/components/pe/section.blade.php' => 'Section component',
    'resources/views/components/pe/row.blade.php' => 'Row component',
    'resources/js/pe.js' => 'JavaScript module',
];

echo "Checking required files...\n";
foreach ($requiredFiles as $file => $description) {
    $path = "$baseDir/$file";
    if (file_exists($path)) {
        $success[] = "✓ $description: $file";
    } else {
        $errors[] = "✗ Missing $description: $file";
    }
}

// Check documentation files
$docFiles = [
    'PE_README.md' => 'Main README',
    'PE_REFACTOR_SUMMARY.md' => 'Refactor summary',
    'MIGRATION_GUIDE_PE.md' => 'Migration guide',
    'PE_MIGRATION_TEMPLATE.md' => 'Migration template',
];

echo "\nChecking documentation...\n";
foreach ($docFiles as $file => $description) {
    $path = "$baseDir/$file";
    if (file_exists($path)) {
        $success[] = "✓ $description: $file";
    } else {
        $warnings[] = "⚠ Missing $description: $file";
    }
}

// Check test file
echo "\nChecking test files...\n";
if (file_exists("$baseDir/public/pe-test.html")) {
    $success[] = "✓ Test page: public/pe-test.html";
} else {
    $warnings[] = "⚠ Missing test page: public/pe-test.html";
}

// Check app.js integration
echo "\nChecking JavaScript integration...\n";
$appJs = "$baseDir/resources/js/app.js";
if (file_exists($appJs)) {
    $content = file_get_contents($appJs);
    if (strpos($content, 'import { initPe }') !== false || strpos($content, "import { initPe }") !== false) {
        $success[] = "✓ pe.js imported in app.js";
    } else {
        $warnings[] = "⚠ pe.js not imported in app.js - add: import { initPe } from './pe.js';";
    }
} else {
    $errors[] = "✗ Missing resources/js/app.js";
}

// Check PeSchema class
echo "\nChecking PeSchema class...\n";
$schemaFile = "$baseDir/app/Support/PeSchema.php";
if (file_exists($schemaFile)) {
    $content = file_get_contents($schemaFile);
    
    if (strpos($content, 'namespace App\Support') !== false) {
        $success[] = "✓ PeSchema namespace correct";
    } else {
        $errors[] = "✗ PeSchema namespace incorrect";
    }
    
    if (strpos($content, 'public static function generalSurvey()') !== false) {
        $success[] = "✓ generalSurvey() method exists";
    } else {
        $errors[] = "✗ Missing generalSurvey() method";
    }
    
    // Count methods (sections)
    preg_match_all('/public static function (\w+)\(\)/', $content, $matches);
    $methodCount = count($matches[1]);
    if ($methodCount > 0) {
        $success[] = "✓ Found $methodCount PE section(s) defined";
        if ($methodCount < 14) {
            $warnings[] = "⚠ Only $methodCount/14 sections migrated";
        }
    }
}

// Check component files
echo "\nChecking Blade components...\n";
$sectionComponent = "$baseDir/resources/views/components/pe/section.blade.php";
$rowComponent = "$baseDir/resources/views/components/pe/row.blade.php";

if (file_exists($sectionComponent)) {
    $content = file_get_contents($sectionComponent);
    if (strpos($content, 'data-pe-section') !== false) {
        $success[] = "✓ Section component has data-pe-section attribute";
    } else {
        $errors[] = "✗ Section component missing data-pe-section attribute";
    }
    
    if (strpos($content, 'data-pe-action="check-all-normal"') !== false) {
        $success[] = "✓ Section component has Check All Normal button";
    } else {
        $errors[] = "✗ Section component missing Check All Normal button";
    }
}

if (file_exists($rowComponent)) {
    $content = file_get_contents($rowComponent);
    if (strpos($content, 'data-pe-row') !== false) {
        $success[] = "✓ Row component has data-pe-row attribute";
    } else {
        $errors[] = "✗ Row component missing data-pe-row attribute";
    }
    
    if (strpos($content, 'data-pe-detail-template') !== false) {
        $success[] = "✓ Row component has detail template (lazy loading)";
    } else {
        $errors[] = "✗ Row component missing detail template";
    }
}

// Check pe.js
echo "\nChecking JavaScript module...\n";
$peJs = "$baseDir/resources/js/pe.js";
if (file_exists($peJs)) {
    $content = file_get_contents($peJs);
    
    if (strpos($content, 'export function initPe()') !== false) {
        $success[] = "✓ initPe() function exported";
    } else {
        $errors[] = "✗ Missing export function initPe()";
    }
    
    if (strpos($content, 'addEventListener') !== false) {
        $success[] = "✓ Using vanilla JS event delegation";
    }
    
    if (strpos($content, 'jQuery') === false && strpos($content, '$') === false) {
        $success[] = "✓ No jQuery dependency";
    } else {
        $warnings[] = "⚠ May contain jQuery code";
    }
}

// Print results
echo "\n";
echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║  Results                                                       ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n";
echo "\n";

if (!empty($success)) {
    echo "✅ SUCCESS (" . count($success) . "):\n";
    foreach ($success as $msg) {
        echo "   $msg\n";
    }
    echo "\n";
}

if (!empty($warnings)) {
    echo "⚠️  WARNINGS (" . count($warnings) . "):\n";
    foreach ($warnings as $msg) {
        echo "   $msg\n";
    }
    echo "\n";
}

if (!empty($errors)) {
    echo "❌ ERRORS (" . count($errors) . "):\n";
    foreach ($errors as $msg) {
        echo "   $msg\n";
    }
    echo "\n";
}

// Summary
echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║  Summary                                                       ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n";
echo "\n";

$total = count($success) + count($warnings) + count($errors);
$percentage = $total > 0 ? round((count($success) / $total) * 100) : 0;

echo "Total Checks: $total\n";
echo "Passed: " . count($success) . " ($percentage%)\n";
echo "Warnings: " . count($warnings) . "\n";
echo "Errors: " . count($errors) . "\n";
echo "\n";

if (empty($errors)) {
    echo "✅ Installation verified! You can now:\n";
    echo "   1. Test in browser: http://your-app.test/pe-test.html\n";
    echo "   2. Read PE_README.md for usage instructions\n";
    echo "   3. Start migrating sections using PE_MIGRATION_TEMPLATE.md\n";
    echo "\n";
    exit(0);
} else {
    echo "❌ Installation incomplete. Please fix the errors above.\n";
    echo "\n";
    exit(1);
}
