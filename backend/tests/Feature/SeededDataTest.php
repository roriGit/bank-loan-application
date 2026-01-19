<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserPersonal;
use App\Models\Application;

class SeededDataTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function seeded_users_have_personal_info_and_applications()
    {
        // Run the seeders
        $this->seed();

        // Check that users exist
        $this->assertTrue(User::count() > 0, 'No users found in database');

        // Loop through users and check relationships
        User::all()->each(function ($user) {

            // Each user should have personal info
            $this->assertInstanceOf(UserPersonal::class, $user->personalInfo, 
                "User {$user->id} has no personal info");

            // Each user should have at least one application
            $this->assertTrue($user->applications->count() > 0, 
                "User {$user->id} has no applications");

            // Check each application
            $user->applications->each(function ($app) {

                // loan_type is valid
                $validLoanTypes = ['personal','home','auto','business','mortgage','student','gold'];
                $this->assertContains($app->loan_type, $validLoanTypes, "Application {$app->id} has invalid loan_type");

                // amount is numeric and positive
                $this->assertIsFloat($app->loan_amount, "Application {$app->id} amount is not an integer");
                $this->assertGreaterThan(0, $app->loan_amount, "Application {$app->id} amount must be > 0");

                // status is valid
                $this->assertContains($app->status, ['pending', 'approved', 'rejected'],
                    "Application {$app->id} has invalid status");
            });
        });
    }
}
