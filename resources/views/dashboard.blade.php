<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>

    <x-container>
        
        <x-form post :action="route('question.store')">

            <x-text-area label="Question :" name="question" />

            <x-btn.primary>Save</x-btn.primary>

            <x-btn.reset>Cancel</x-btn.reset>

        </x-form>

        <hr class="my-4 border-dashed boder-gray-700">
        
        <div class="mb-1 uppercase dark:text-gray-300 ">List of Questions</div>

        <div class="space-y-3 dark:text-gray-400">
            @foreach ($questions as $item)
                <x-question :question="$item" />
            @endforeach
        </div>
        
    </x-container>

            

        
</x-app-layout>
