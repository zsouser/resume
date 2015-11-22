<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
use Auth;
use App\Resume;
use App\Http\Controllers\Traits\PdfTrait;
use App\Job;
use App\Project;
use App\Education;
use App\Skill;
use App\Description;

class ResumeController extends Controller
{
    use PdfTrait;

    private function getOptions($admin = false) {
        return [
            'objective' => Description::whereNull('job_id')
                            ->whereNull('project_id')
                            ->orderBy('rank', 'asc')
                            ->get(),
            'jobs' => Job::with('descriptions')
                            ->orderBy('rank', 'asc')
                            ->get(),
            'projects' => Project::with('descriptions')
                            ->orderBy('rank', 'asc')
                            ->get(),
            'education' => Education::orderBy('rank', 'asc')
                            ->get(),
            'skills' => Skill::orderBy('name', 'asc')
                            ->get()
        ];
    }

    private function getAdminOptions() {
        return [
            'objective' => Description::whereNull('job_id')
                            ->whereNull('project_id')
                            ->orderBy('rank', 'asc')
                            ->withTrashed()
                            ->get(),
            'jobs'      => Job::with('descriptions')
                            ->orderBy('rank', 'asc')
                            ->withTrashed()
                            ->get(),
            'projects'  => Project::with('descriptions')
                            ->orderBy('rank', 'asc')
                            ->withTrashed()
                            ->get(),
            'education' => Education::orderBy('rank', 'asc')
                            ->get(),
            'skills'    => Skill::orderBy('name', 'asc')
                            ->withTrashed()
                            ->get()
        ];
    }
    
    /**
     * Display the resume view.
     *
     * @return \Illuminate\View
     */
    public function index()
    {
        return view('resume.index', $this->getOptions());
    }

    public function admin() 
    {
        return view('resume.admin', $this->getAdminOptions());
    }

    public function pdf()
    {
        return PDF::loadView('resume.pdf', $this->getOptions())->download();
    }
}
