<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Job::class);
        $filters = request()->only(['search', 'max_salary', 'min_salary', 'experience', 'category']);

        return view('job.index', ['jobs' => Job::filter($filters)->latest()->with('employer')->paginate(10)]);
    }

    public function show(Job $job)
    {
        $this->authorize('view', $job);
        return view('job.show', ['job' => $job->load('employer.jobs')]);
    }

}
