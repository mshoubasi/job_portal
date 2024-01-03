<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Notifications\ApprovalNotification;

class ReviewController extends Controller
{
    public function approve(JobApplication $jobApplication)
    {
        $data = [
            'message' => 'You have been approved',
            'action' => 'Click here to view the job',
            'url' => route('jobs.show', $jobApplication->job),
            'thanks' => 'Thank you for using our application'
        ];
        $jobApplication->markAsApproved();
        $jobApplication->user->notify(new ApprovalNotification($data));


        return back()->with('success', 'Done');

    }

    public function download(JobApplication $JobApplication)
    {

        $path =  storage_path('app/private/' . $JobApplication->cv_path);

        if (!is_file($path)) {
            abort(404);
        }

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . basename($path) . '"',
        ];
        return response()->download($path, basename($path), $headers);
    }
}
