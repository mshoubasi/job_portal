<x-layout>
    <x-nav-bar class="mb-4" :links="['My Jobs' => '#']" />
    <div class="mb-8 text-right">
        <x-link-button :href="route('my-job.create')">Add Job</x-link-button>
    </div>
    @forelse ($jobs as $job)
        <x-job-card :$job>
            <div class="text-slate-500 text-xs">
                @forelse ($job->jobApplications as $JobApplication)
                    <div class="flex justify-between mb-4 items-center">
                        <div>
                            <div>{{ $JobApplication->user->name }}</div>
                            <div>{{ $JobApplication->created_at->diffForHumans() }}</div>
                            <div class="rounded-md border px-2 py-1"><a
                                    href="{{ route('job.download', $JobApplication) }}">Download CV</a></div>
                        </div>
                        <div>
                            <div>${{ number_format($JobApplication->expected_salary) }}</div>
                            @if ($JobApplication->status == 'pending')
                                <div class="rounded-md border px-2 py-1">
                                    <form action="{{ route('job.approve', $JobApplication) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button>Approve</button>
                                    </form>
                                </div>
                            @else
                            <div class="text-green-400 rounded-md border px-2 py-1">
                                Approved
                            </div>
                            @endif

                        </div>
                    </div>

                @empty
                    <div class="mb-4">No applicants yet</div>
                @endforelse
                <div class="flex justify-between space-x-2">
                    <x-link-button href="{{ route('my-job.edit', $job) }}">Edit</x-link-button>
                    <div>
                        <form action="{{ route('my-job.destroy', $job) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button
                                onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </x-job-card>
    @empty

    @endforelse
</x-layout>
