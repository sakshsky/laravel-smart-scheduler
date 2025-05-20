<div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-4">Laravel Scheduler Generator</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Input Form -->
            <div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Task Name</label>
                    <input type="text" wire:model="taskName" 
                           class="w-full px-3 py-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Artisan Command</label>
                    <input type="text" wire:model="command" 
                           placeholder="emails:send"
                           class="w-full px-3 py-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Frequency</label>
                    <select wire:model="frequency" class="w-full px-3 py-2 border rounded">
                        <option value="hourly">Hourly</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                        <option value="custom">Custom Cron</option>
                    </select>
                </div>

                @if($frequency !== 'custom')
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Run At</label>
                    <input type="time" wire:model="time" 
                           class="px-3 py-2 border rounded">
                </div>
                @else
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Cron Expression</label>
                    <input type="text" wire:model="customExpression" 
                           placeholder="* * * * *"
                           class="w-full px-3 py-2 border rounded">
                    <div class="text-sm text-gray-500 mt-1">
                        Example: 0 2 * * * = Daily at 2:00 AM
                    </div>
                    
                    @if(!empty($nextRunDates))
                    <div class="mt-2">
                        <h4 class="font-medium">Next Run Times:</h4>
                        <ul class="text-sm">
                            @foreach($nextRunDates as $date)
                            <li>{{ $date }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                @endif

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Timezone</label>
                    <select wire:model="timezone" class="w-full px-3 py-2 border rounded">
                        @foreach($timezones as $tz)
                        <option value="{{ $tz }}">{{ $tz }}</option>
                        @endforeach
                    </select>
                </div>

                <button wire:click="generateCode" 
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Generate Scheduler Code
                </button>
            </div>

            <!-- Code Output -->
            <div>
                @if($generatedCode)
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Generated Code:</label>
                    <pre class="bg-gray-100 p-4 rounded overflow-x-auto text-sm"><code class="language-php">{{ $generatedCode }}</code></pre>
                </div>
                
                <div class="flex space-x-2">
                    <button onclick="copyToClipboard()" 
                            class="bg-gray-200 px-3 py-1 rounded text-sm">
                        Copy Code
                    </button>
                    <button wire:click="$set('generatedCode', '')" 
                            class="bg-gray-200 px-3 py-1 rounded text-sm">
                        Clear
                    </button>
                </div>
                @else
                <div class="bg-gray-100 p-8 rounded flex items-center justify-center text-gray-500">
                    Your generated code will appear here
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyToClipboard() {
    const code = `{!! addslashes($generatedCode) !!}`;
    navigator.clipboard.writeText(code).then(() => {
        alert('Code copied to clipboard!');
    });
}
</script>
@endpush