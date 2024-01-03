<x-layout>
    <x-navbar class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job), 'Apply' => '#']" />
    <x-job-card :$job>
        <p class="mb-4 text-sm text-slate-500">{!! nl2br(e($job->description)) !!}</p>
    </x-job-card>
    <x-card>
        <h2 class="mb-4 text-lg font-medium">Your Job Application</h2>
        <form action="{{ route('jobs.application.store', $job) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <x-label for="expected_salary">Expected Salary</x-label>
                <x-text-input name="expected_salary" type="number" />
            </div>
            <div class="mb-4">
                <x-label for="cv">Upload CV</x-label>
                <x-text-input name="cv" type="file" />
            </div>
            <x-button class="w-full">Apply</x-button>
        </form>
    </x-card>
</x-layout>
