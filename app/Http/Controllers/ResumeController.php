<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
use Auth;
use App\Resume;
use App\Job;
use App\Project;
use App\Credential;
use App\Skill;
use App\Description;
use App\Objective;

class ResumeController extends Controller
{
    /**
     * Display the resume view.
     *
     * @return \Illuminate\View
     */
    public function getIndex()
    {
        return view('resume.index', [
            'objective' => Objective::active()->first(),
            'jobs'      => Job::display()->get(),
            'projects'  => Project::display()->get(),
            'credentials' => Credential::display()->get(),
            'skills'    => Skill::display()->get()
        ]);
    }

    /**
     * Serve the custom PDF
     *
     * @return PDF File
     */
    public function postPrint(Request $request)
    {
        return view('resume.pdf', [
            'phone' => true,
            'objective' => Objective::pdf($request->get('objectives'))->first(),
            'jobs'      => Job::pdf($request->get('jobs'))->get(),
            'projects'  => Project::pdf($request->get('projects'))->get(),
            'credentials' => Credential::pdf($request->get('credentials'))->get(),
            'skills'    => Skill::pdf($request->get('skills'))->get()
        ]);
    }

    /**
     * Display the options for generating a PDF
     *
     * @return \Illuminate\View
     */
    public function getPrint()
    {
        return view('resume.print', [
            'objectives' => Objective::active()->get(),
            'jobs'      => Job::display()->get(),
            'projects'  => Project::display()->get(),
            'credentials' => Credential::display()->get(),
            'skills'    => Skill::display()->get()
        ]);
    }

    /**
     * Serve the PDF version of the full resume
     *
     * @return PDF File
     */
    public function getPdf()
    {
        return view('resume.pdf', [
            'objective' => Objective::active()->first(),
            'jobs'      => Job::display()->get(),
            'projects'  => Project::display()->get(),
            'credentials' => Credential::display()->get(),
            'skills'    => Skill::display()->get()
        ]);
    }
}
