<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->q ?? null;
        $pageIndex = $request->q ?? 0;
        $pageSize = $request->pageSize ?? 3;
        $sortBy = $request->sortBy ?? 'name';
        $sortDirection = $request->sortDirection ?? 'ASC';

        $getProjects = Project::orderBy($sortBy, $sortDirection);

        if ($q) {
            $getProjects->where('name', 'like', '%', $q, '%');
        }

        $getProjects->paginate($pageSize);
        return $getProjects->get();
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
            return ('You do not have the permissoin to create a Task');
        }

        $request->validate([
            'name' => 'required',
        ]);

        $newProject = Project::create($request->all());

        if ($newProject) {
            return response()->json([

                'message' => 'Success',
                'projectData' => $newProject,

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
        $getProjects = Project::find($id);
        return $getProjects;
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
        $updateProject = Project::where('id', $id)->update($request->all());

        if ($updateProject) {
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
        $deleteProject = Project::where('id', $id)->delete();
        if ($deleteProject) {
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
