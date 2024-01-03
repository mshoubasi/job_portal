<x-layout>
    <x-navbar :links="['Jobs' => route('jobs.index')]" />

    <x-card class="mb-4 text-sm">
        <form id="filtering-form" action="{{ route('jobs.index') }}" method="GET">

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input form-id="filtering-form" name="search" value="{{ request('search') }}"
                        placeholder="Search for anything" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input form-id="filtering-form" name="min_salary" value="{{ request('min_salary') }}"
                            placeholder="to" />
                        <x-text-input form-id="filtering-form" name="max_salary" value="{{ request('max_salary') }}"
                            placeholder="from" />
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Experience</div>
                    <x-radio-input name="experience" :options="array_combine(
                        array_map('ucfirst', \App\Models\Job::$experience),
                        \App\Models\Job::$experience,
                    )" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-input name="category" :options="\App\Models\Job::$category" />
                </div>
            </div>
            <x-button class="w-full">Filter</x-button>
        </form>
    </x-card>

    @forelse ($jobs as $job)
        <x-job-card class="mb-4" :$job>
            <div>
                <x-link-button :href="route('jobs.show', $job)">Show</x-link-button>
            </div>
        </x-job-card>
    @empty
        <x-card>
            <p>No Results</p>
        </x-card>
    @endforelse
    <div class="mb-4">
        {{ $jobs->links() }}
    </div>
</x-layout>
