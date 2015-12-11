<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Credential;
use App\Organization;

class CredentialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('credential.index', [
            'credential' => Credential::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('credential.edit', [
            'credential' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $credential = new Credential;
            $credential->organization = $request->get('organization');
            $credential->credential = $request->get('credential');
            $credential->date_start = $request->get('date_start');
            $credential->date_end = $request->get('date_end');

            $credential->save(); 

            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->withError('Save failed');
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
        try {
            return view('credential.show', [
                'credential' => Credential::findOrFail($id)
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Could not locate credential.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            return view('credential.edit', [
                'credential' => Credential::findOrFail($id),
                'organizations' => Organization::all()
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Could not locate credential.');
        }
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
        try {
            $credential = Credential::findOrFail($id);
            $credential->organization = $request->get('organization');
            $credential->credential = $request->get('credential');
            $credential->date_start = $request->get('date_start');
            $credential->date_end = $request->get('date_end');

            $credential->save(); 

            return redirect('index');
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->withError('Save failed');
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
        try {
            Credntial::findOrFail($id)->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->withError('Deletion failed');
        }
    }
}
