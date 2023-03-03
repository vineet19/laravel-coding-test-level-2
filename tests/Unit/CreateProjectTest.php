<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
// use Tests\TestCase;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;

class CreateProjectTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testProjectCreation()
    {
        $admin = User::find('055dbce4-5c04-4fe5-ae54-6608c3f0f8ec'); //Some Admin User for the middlewares role permissions
        $project = Project::factory()->raw();
        $newProject = $this->actingAs($admin)->post('/api/project', $project);

        $newTasks = Task::factory()->count(2)->make([
            'project_id' => $project['id'],
            'status' => 'NOT_STARTED'
        ])->count(2);

        $this->assertStatus(201);
    }
}
