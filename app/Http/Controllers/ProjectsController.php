<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Description;

use DB;
use Validator;


class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'name' => 'required|unique:projects|max:255',
                'rank' => 'required|integer',
                'date_start' => 'date',
                'date_end' => 'date',
                'descriptions.rank' => 'required|integer',
                'descriptions.text' => 'required|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        DB::beginTransaction();

        $project = new Project($request->only(['name', 'rank', 'date_start', 'date_end']));

        if (!$project->save()) {
            DB::rollback();
            return redirect()->back()->withError('Could not save project');
        }

        $descriptions = [];

        foreach ($request->get('descriptions') as $description) {
            $descriptions[] = new Description($description);
        }

        if (!$project->descriptions()->saveMany($descriptions)) {
            DB::rollback();
            return redirect()->back()->withError('Could not save description');
        }

        DB::commit();

        return redirect('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('projects.show', [
            'project' => Project::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('projects.edit', [
            'project' => Project::find($id)
        ]);
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
        $this->validate($request, [
            'name' => 'required|unique:projects|max:255',
            'rank' => 'required|integer',
            'date_start' => 'date',
            'date_end' => 'date',
            'descriptions.id' => 'integer',
            'descriptions.rank' => 'required|integer',
            'descriptions.text' => 'required|max:500'
        ]);

        DB::beginTransaction();

        $project = Project::find($id);

        if (!$project->save($request->only(['name', 'rank', 'date_start', 'date_end']))) {
            DB::rollback();
            return redirect()->back()->withError('Could not save project');
        }

        $descriptions = [];

        foreach ($request->get('descriptions') as $description) {
            if ($description['id']) {
                $descriptions[] = Description::find($description['id']);
            } else {
                $descriptions[] = new Description($description);
            }
        }

        if (!$project->descriptions()->saveMany($descriptions)) {
            DB::rollback();
            return redirect()->back()->withError('Could not save description');
        }

        DB::commit();

        return redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Project::find($id)->delete()) {
            return redirect()->back()->withError('Could not delete project');
        }
        return redirect()->back();
    }
}
