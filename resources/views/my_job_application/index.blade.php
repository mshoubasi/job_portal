<x-layout>
    <x-navbar class="mb-4" :links="['My Job Applications' => '#']" />
    @forelse ($applications as $application)
        <x-job-card :job="$application->job">
            <div class="flex items-center justify-between text-xs text-slate-500">
                <div>
                    <div>
                        Apllied {{ $application->created_at->diffForHumans() }}
                    </div>
                    <div>
                        Other : {{ Str::plural('Applicant', $application->job->job_applications_count - 1) }}
                        {{ $application->job->job_applications_count - 1 }}
                    </div>
                    <div>
                        Expected Salary {{ number_format($application->expected_salary) }}
                    </div>
                </div>
                <div>
                    <form action="{{ route('my-applications.destroy', $application) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Cancel</x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
    <x-card>
        <div>
            No Job Applications
        </div>
    </x-card>
    @endforelse
</x-layout>
