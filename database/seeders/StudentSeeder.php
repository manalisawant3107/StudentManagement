<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'course' => 'Computer Science',
                'gender' => 'Male',
                'dob' => '2000-05-15',
                'phone' => '9876543210',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'course' => 'Information Technology',
                'gender' => 'Female',
                'dob' => '1999-09-22',
                'phone' => '9876543211',
            ]
        ]);
    }
}