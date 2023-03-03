<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getTasks = Task::all();
        return $getTasks;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!in_array($request->user()->Role(), 'PRODUCT_OWNER')) {
            return back()->with('error', 'You do not have the permissoin to create a Task');
        }

        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'project_id' => 'required',
            'user_id' => 'required',
        ]);

        //Autogenerate ID for the UUID
        $request['id'] = Str::uuid();

        //Required that on new task
        $request['status'] = 'NOT_STARTED';
        $newTask = Task::create($request->all());

        if ($newTask) {
            return response()->json([
                'message' => 'Success',
                'taskData' => $newTask,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getTasks = Task::find($id);
        return $getTasks;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!in_array($request->user()->Role(), 'PRODUCT_OWNER')) {
            return back()->with('error', 'You do not have the permissoin to create a Task');
        }

        $getUserTasks = Task::find('user_id', auth()->user()->id());
        
        //Confirm that only the user with related task is the one editting
        if (!in_array($getUserTasks->id, $id)) {
            return back()->with('error', 'You do not have the permissoin to edit this Task');
        }

        $validStatuses = array('NOT_STARTED', 'IN_PROGRESS', 'READY_FOR_TEST', 'COMPLETED');

        $request->validate([
            'title' => 'required',
            'status' => 'required', Rule::in($validStatuses),
            'project_id' => 'required',
            'user_id' => 'required',
        ]);

        $updateTask = Task::where('id', $id)->update($request->all());

        if ($updateTask) {
            return response()->json([
                'message' => 'Success',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteTask = Task::where('id', $id)->delete();
        if ($deleteTask) {
            return response()->json([
                'message' => 'Success',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed',
            ], 400);
        }
    }
}
