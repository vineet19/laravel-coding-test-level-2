<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Task;

class ChangeSelfTaskTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $statuses = array('NOT_STARTED', 'IN_PROGRESS', 'READY_FOR_TEST', 'COMPLETED');
        
        $response = Task::where('user_id', auth()->user()->id)
        ->update('status', $statuses->random());

        $this->assertTrue(true);
    }
}
