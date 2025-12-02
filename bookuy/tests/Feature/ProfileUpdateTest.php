<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_update_profile_and_data_is_saved_to_database()
    {
        $user = User::factory()->create([
            'username' => 'Old Name',  // Updated to match class diagram
            'email' => 'old@example.com',
            'gender' => null,
            'semester' => null,
            'description' => null,
            'no_telp' => null,  // Updated to match class diagram
            'role' => 'user',
        ]);

        $this->actingAs($user);

        // Update profile (without image to avoid GD dependency)
        $response = $this->patch(route('profile.update'), [
            'name' => 'Updated Name',
            'email' => 'old@example.com', // Keep same email
            'gender' => 'Male',
            'semester' => 5,
            'description' => 'This is my updated bio',
            'phone_number' => '+6281234567890',
            'role' => 'seller',
        ]);

        $response->assertRedirect(route('profile.edit'));
        $response->assertSessionHas('status', 'profile-updated');

        // Verify data is actually saved in database
        $user->refresh();
        
        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('old@example.com', $user->email);
        $this->assertEquals('Male', $user->gender);
        $this->assertEquals(5, $user->semester);
        $this->assertEquals('This is my updated bio', $user->description);
        $this->assertEquals('+6281234567890', $user->phone_number);
        $this->assertEquals('seller', $user->role);
    }

    /** @test */
    public function profile_picture_is_optional()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->patch(route('profile.update'), [
            'name' => 'Test User',
            'email' => $user->email,
            'gender' => 'Female',
            'semester' => 3,
        ]);

        $response->assertRedirect(route('profile.edit'));
        
        $user->refresh();
        $this->assertEquals('Female', $user->gender);
        $this->assertEquals(3, $user->semester);
        $this->assertNull($user->profile_picture);
    }

    /** @test */
    public function user_can_update_all_fields_independently()
    {
        $user = User::factory()->create([
            'username' => 'Test User',  // Updated to match class diagram
            'gender' => 'Male',
            'semester' => 1,
            'description' => 'Old bio',
            'no_telp' => '081111111111',  // Updated to match class diagram
            'role' => 'user',
        ]);
        
        $this->actingAs($user);
        
        // Update only name
        $this->patch(route('profile.update'), [
            'name' => 'New Name',
            'email' => $user->email,
        ]);
        
        $user->refresh();
        $this->assertEquals('New Name', $user->name);
        $this->assertEquals('Male', $user->gender); // Other fields unchanged
        
        // Update only role
        $this->patch(route('profile.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'role' => 'seller',
        ]);
        
        $user->refresh();
        $this->assertEquals('seller', $user->role);
        $this->assertEquals('New Name', $user->name); // Previous changes persist
    }

    /** @test */
    public function role_validation_works_correctly()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Valid roles
        foreach (['user', 'seller', 'admin'] as $role) {
            $response = $this->patch(route('profile.update'), [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $role,
            ]);
            
            $response->assertRedirect(route('profile.edit'));
            $user->refresh();
            $this->assertEquals($role, $user->role);
        }

        // Invalid role should fail validation
        $response = $this->patch(route('profile.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'role' => 'invalid_role',
        ]);
        
        $response->assertSessionHasErrors('role');
    }

    /** @test */
    public function user_can_upload_profile_picture()
    {
        Storage::fake('public');
        
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $file = UploadedFile::fake()->image('profile.jpg', 500, 500)->size(1024); // 1MB
        
        $response = $this->patch(route('profile.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'profile_picture' => $file,
        ]);
        
        $response->assertRedirect(route('profile.edit'));
        $response->assertSessionHas('status', 'profile-updated');
        
        $user->refresh();
        
        // Verify file was stored
        $this->assertNotNull($user->profile_picture);
        Storage::disk('public')->assertExists($user->profile_picture);
        $this->assertStringContainsString('profile-pictures/', $user->profile_picture);
    }

    /** @test */
    public function old_profile_picture_is_deleted_when_uploading_new_one()
    {
        Storage::fake('public');
        
        $user = User::factory()->create([
            'profile_picture' => 'profile-pictures/old-picture.jpg'
        ]);
        
        // Create the old file
        Storage::disk('public')->put('profile-pictures/old-picture.jpg', 'old content');
        
        $this->actingAs($user);
        
        $newFile = UploadedFile::fake()->image('new-profile.jpg');
        
        $response = $this->patch(route('profile.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'profile_picture' => $newFile,
        ]);
        
        $response->assertRedirect(route('profile.edit'));
        
        // Old file should be deleted
        Storage::disk('public')->assertMissing('profile-pictures/old-picture.jpg');
        
        // New file should exist
        $user->refresh();
        Storage::disk('public')->assertExists($user->profile_picture);
    }
}
