<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobsController extends Controller
{
    public function create()
    {
        return Inertia::render('Jobs/Create');
    }

    public function store(JobRequest $request)
    {
        Job::create($request->validated());

        return redirect(route('jobs.index'), 303);
    }

    public function index(Request $request)
    {
        return Inertia::render('Jobs/Index', [
            'jobs' => Job::latest()
                ->when($request->has('email'), fn ($query) => $query->forEmail($request->email))
                ->get()
                ->map(fn (Job $job) => $job->only([
                    'id',
                    'contact_name',
                    'contact_phone',
                    'contact_email',
                    'location',
                    'details',
                ])),
            'email' => $request->email,
        ]);
    }

    public function edit(Job $job)
    {
        return Inertia::render('Jobs/Edit', [
            'job' => $job->only([
                'id',
                'contact_name',
                'contact_phone',
                'contact_email',
                'location',
                'details',
            ]),
        ]);
    }

    public function update(JobRequest $request, Job $job)
    {
        $job->update($request->validated());

        return redirect(route('jobs.index'), 303);
    }
}
