<?php
// database/seeders/StakeholderSeeder.php
namespace Database\Seeders;

use App\Models\Stakeholder;
use Illuminate\Database\Seeder;

class StakeholderSeeder extends Seeder
{
    public function run(): void
    {
        $stakeholders = [
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@example.com',
                'phone' => '+1234567890',
                'company_name' => 'Tech Solutions Inc.',
                'designation' => 'Project Manager',
                'type' => 'internal',
                'category' => 'primary',
                'engagement_level' => 5,
                'influence_level' => 'high',
                'status' => 'active'
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.j@clientcorp.com',
                'phone' => '+0987654321',
                'company_name' => 'Client Corporation',
                'designation' => 'Director of Operations',
                'type' => 'client',
                'category' => 'decision_maker',
                'engagement_level' => 4,
                'influence_level' => 'critical',
                'status' => 'active'
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Chen',
                'email' => 'michael.chen@vendor.com',
                'phone' => '+1122334455',
                'company_name' => 'Quality Vendors Ltd.',
                'designation' => 'Account Manager',
                'type' => 'vendor',
                'category' => 'supplier',
                'engagement_level' => 3,
                'influence_level' => 'medium',
                'status' => 'active'
            ]
        ];

        foreach ($stakeholders as $stakeholder) {
            Stakeholder::create($stakeholder);
        }
    }
}
