<?php

namespace Tests\Feature\Uploads;

use App\Models\ComprehensiveHistoryAttachment;
use App\Models\LaboratoryResult;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $otherUser;
    protected $patient;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->clinician()->create();
        $this->otherUser = User::factory()->clinician()->create();
        $this->patient = Patient::factory()->create();
        
        Storage::fake('local');
    }

    /** @test */
    public function file_upload_validates_allowed_mimetypes()
    {
        $this->actingAs($this->user);

        // Test allowed file types
        $allowedFiles = [
            'document.pdf' => 'application/pdf',
            'image.jpg' => 'image/jpeg',
            'image.png' => 'image/png',
            'spreadsheet.xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        foreach ($allowedFiles as $filename => $mimetype) {
            $file = UploadedFile::fake()->create($filename, 100, $mimetype);

            $response = $this->post("/patients/{$this->patient->id}/comprehensive-history/attachments", [
                'file' => $file,
                'description' => 'Test file upload',
            ]);

            $response->assertStatus(302, "File {$filename} should be allowed");
            
            // Verify file was stored
            $this->assertDatabaseHas('comprehensive_history_attachments', [
                'original_filename' => $filename,
            ]);
        }
    }

    /** @test */
    public function file_upload_rejects_disallowed_mimetypes()
    {
        $this->actingAs($this->user);

        // Test disallowed file types
        $disallowedFiles = [
            'script.exe' => 'application/x-executable',
            'virus.bat' => 'application/x-bat',
            'script.js' => 'application/javascript',
            'archive.zip' => 'application/zip',
        ];

        foreach ($disallowedFiles as $filename => $mimetype) {
            $file = UploadedFile::fake()->create($filename, 100, $mimetype);

            $response = $this->post("/patients/{$this->patient->id}/comprehensive-history/attachments", [
                'file' => $file,
                'description' => 'Test malicious file',
            ]);

            $response->assertStatus(422, "File {$filename} should be rejected");
            $response->assertJsonValidationErrors(['file']);
            
            // Verify file was not stored
            $this->assertDatabaseMissing('comprehensive_history_attachments', [
                'original_filename' => $filename,
            ]);
        }
    }

    /** @test */
    public function file_upload_enforces_size_cap()
    {
        $this->actingAs($this->user);

        // Create file larger than size limit (assuming 5MB limit)
        $largeFile = UploadedFile::fake()->create('large_document.pdf', 6000); // 6MB

        $response = $this->post("/patients/{$this->patient->id}/comprehensive-history/attachments", [
            'file' => $largeFile,
            'description' => 'Large file test',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['file']);
        
        // Verify large file was not stored
        $this->assertDatabaseMissing('comprehensive_history_attachments', [
            'original_filename' => 'large_document.pdf',
        ]);
    }

    /** @test */
    public function file_upload_stores_files_privately()
    {
        $this->actingAs($this->user);

        $file = UploadedFile::fake()->create('test_document.pdf', 100, 'application/pdf');

        $response = $this->post("/patients/{$this->patient->id}/comprehensive-history/attachments", [
            'file' => $file,
            'description' => 'Private storage test',
        ]);

        $response->assertStatus(302);
        
        // Verify file is stored
        $attachment = ComprehensiveHistoryAttachment::latest()->first();
        $this->assertNotNull($attachment);
        
        // Verify file path indicates private storage
        $this->assertStringContainsString('private', $attachment->file_path);
        
        // Verify file exists in storage
        Storage::disk('local')->assertExists($attachment->file_path);
    }

    /** @test */
    public function unauthorized_users_cannot_download_files()
    {
        $this->actingAs($this->user);

        // Upload file as authorized user
        $file = UploadedFile::fake()->create('confidential.pdf', 100, 'application/pdf');

        $this->post("/patients/{$this->patient->id}/comprehensive-history/attachments", [
            'file' => $file,
            'description' => 'Confidential document',
        ]);

        $attachment = ComprehensiveHistoryAttachment::latest()->first();

        // Try to download as unauthorized user
        $this->actingAs($this->otherUser);
        
        $response = $this->get("/patients/{$this->patient->id}/comprehensive-history/attachments/{$attachment->id}/download");

        $response->assertStatus(403); // Forbidden
    }

    /** @test */
    public function authorized_users_can_download_files()
    {
        $this->actingAs($this->user);

        $file = UploadedFile::fake()->create('authorized_download.pdf', 100, 'application/pdf');

        $this->post("/patients/{$this->patient->id}/comprehensive-history/attachments", [
            'file' => $file,
            'description' => 'Authorized download test',
        ]);

        $attachment = ComprehensiveHistoryAttachment::latest()->first();

        $response = $this->get("/patients/{$this->patient->id}/comprehensive-history/attachments/{$attachment->id}/download");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
        $response->assertHeader('Content-Disposition');
    }

    /** @test */
    public function unauthenticated_users_cannot_download_files()
    {
        $this->actingAs($this->user);

        // Upload file
        $file = UploadedFile::fake()->create('protected.pdf', 100, 'application/pdf');

        $this->post("/patients/{$this->patient->id}/comprehensive-history/attachments", [
            'file' => $file,
            'description' => 'Protected file',
        ]);

        $attachment = ComprehensiveHistoryAttachment::latest()->first();

        // Logout and try to access
        auth()->logout();

        $response = $this->get("/patients/{$this->patient->id}/comprehensive-history/attachments/{$attachment->id}/download");

        $response->assertStatus(302); // Redirect to login
        $response->assertRedirect('/login');
    }

    /** @test */
    public function file_upload_validates_file_existence()
    {
        $this->actingAs($this->user);

        $response = $this->post("/patients/{$this->patient->id}/comprehensive-history/attachments", [
            'description' => 'Missing file test',
            // No file provided
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['file']);
    }

    /** @test */
    public function laboratory_result_image_upload_works()
    {
        $this->actingAs($this->user);

        $image = UploadedFile::fake()->image('lab_result.jpg', 800, 600);

        $response = $this->post("/patients/{$this->patient->id}/laboratory/upload", [
            'file' => $image,
            'test_type' => 'Blood Chemistry',
            'description' => 'Lab result image',
        ]);

        $response->assertStatus(302);
        
        // Verify laboratory result was created
        $this->assertDatabaseHas('laboratory_results', [
            'patient_id' => $this->patient->id,
            'test_type' => 'Blood Chemistry',
        ]);

        $labResult = LaboratoryResult::latest()->first();
        $this->assertNotNull($labResult->image_path);
        
        // Verify image is stored
        Storage::disk('local')->assertExists($labResult->image_path);
    }

    /** @test */
    public function file_upload_generates_unique_filenames()
    {
        $this->actingAs($this->user);

        // Upload same filename twice
        $file1 = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');
        $file2 = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $this->post("/patients/{$this->patient->id}/comprehensive-history/attachments", [
            'file' => $file1,
            'description' => 'First document',
        ]);

        $this->post("/patients/{$this->patient->id}/comprehensive-history/attachments", [
            'file' => $file2,
            'description' => 'Second document',
        ]);

        $attachments = ComprehensiveHistoryAttachment::all();
        $this->assertEquals(2, $attachments->count());
        
        // Verify different storage paths despite same original filename
        $this->assertNotEquals($attachments[0]->file_path, $attachments[1]->file_path);
        $this->assertEquals('document.pdf', $attachments[0]->original_filename);
        $this->assertEquals('document.pdf', $attachments[1]->original_filename);
    }

    /** @test */
    public function file_deletion_removes_physical_file()
    {
        $this->actingAs($this->user);

        $file = UploadedFile::fake()->create('to_delete.pdf', 100, 'application/pdf');

        $this->post("/patients/{$this->patient->id}/comprehensive-history/attachments", [
            'file' => $file,
            'description' => 'File to delete',
        ]);

        $attachment = ComprehensiveHistoryAttachment::latest()->first();
        $filePath = $attachment->file_path;

        // Verify file exists
        Storage::disk('local')->assertExists($filePath);

        // Delete attachment
        $response = $this->delete("/patients/{$this->patient->id}/comprehensive-history/attachments/{$attachment->id}");

        $response->assertStatus(200);
        
        // Verify database record is deleted
        $this->assertDatabaseMissing('comprehensive_history_attachments', [
            'id' => $attachment->id,
        ]);

        // Verify physical file is deleted
        Storage::disk('local')->assertMissing($filePath);
    }
}