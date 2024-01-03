<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;

class MyJobApplicationController extends Controller
{
    public function index()
    {
        return view('my_job_application.index', ['applications' => auth()->user()->jobApplications()
            ->with(['job.employer', 'job' => fn ($query) => $query->withCount('jobApplications')])
            ->latest()
            ->get()]);
    }

    public function destroy(JobApplication $myApplication)
    {
        $myApplication->delete();

        return redirect()->back()->with('success', 'Job Application Deleted');
    }
}
