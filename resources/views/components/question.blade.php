@props([
    'question'
])

<div class="flex justify-between p-3 rounded shadow dark:bg-gray-800/50 dark:text-gray-400 ds shadow-blue-500/50">
    <span> {{ $question->question }} </span>
    
    <div>
        <x-form :action="route('question.like', $question)">
            <button class="flex items-start space-x-1 text-green-500">
                <x-icons.thumbs-up class="w-5 h-5 text-green-500 cursor-pointer hover:text-green-300"/>
                
                <span>{{ $question->likes}}</span>
            </button>
        </x-form>
        
        <x-form :action="route('question.like', $question)">
            <button class="flex items-start space-x-1 text-green-500">
                <x-icons.thumbs-down class="w-5 h-5 text-red-500 cursor-pointer hover:text-red-300"/>
                
                <span>{{ $question->unlikes}}</span>
            </button>
        </x-form>
        
    </div>
</div>