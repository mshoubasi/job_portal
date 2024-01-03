<x-layout>
    <x-nav-bar class="mb-4" :links="['My Jobs' => route('my-job.index'), 'Edit' => '#']"/>
        <x-card class="mb-8">
            <form action="{{ route('my-job.update', $job) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <x-label for="title">Job Title</x-label>
                        <x-text-input name="title" :value="$job->title"/>
                    </div>
                    <div>
                        <x-label for="location">Location</x-label>
                        <x-text-input name="location" :value="$job->location"/>
                    </div>
                    <div class="col-span-2">
                        <x-label for="salary">Salary</x-label>
                        <x-text-input type="number" name="salary" :value="$job->salary"/>
                    </div>
                    <div class="col-span-2">
                        <x-label for="description">Discription</x-label>
                        <x-text-input type="textarea" name="description" :value="$job->description"/>
                    </div>
                    <div>
                        <x-label for="experience">experience</x-label>
                        <x-radio-input name="experience" :value="$job->experience" :allOptions="false" :options="array_combine(
                            array_map('ucfirst', \App\Models\Job::$experience),
                            \App\Models\Job::$experience,
                        )"/>
                    </div>
                    <div>
                        <x-label for="category">Category</x-label>
                        <x-radio-input name="category" :value="$job->category" :allOptions="false" :options="\App\Models\Job::$category"/>
                    </div>
                </div>
                <x-button class="w-full">Edit</x-button>
            </form>
        </x-card>
</x-layout>
