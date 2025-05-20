<div class="mt-4 p-4 bg-gray-50 rounded-lg">
    <div class="grid grid-cols-5 gap-2 mb-4">
        <!-- Minutes -->
        <div>
            <label class="block text-xs font-medium">Minutes</label>
            <select wire:model="value" class="w-full text-xs rounded">
                <option value="*">Every minute</option>
                <option value="*/5">Every 5 minutes</option>
                <option value="0">On the hour</option>
                <!-- More options... -->
            </select>
        </div>
        
        <!-- Hours -->
        <div>
            <label class="block text-xs font-medium">Hours</label>
            <select wire:model="value" class="w-full text-xs rounded">
                <option value="*">Every hour</option>
                <option value="0">Midnight</option>
                <option value="12">Noon</option>
                <!-- More options... -->
            </select>
        </div>
        
        <!-- Days -->
        <div>
            <label class="block text-xs font-medium">Days</label>
            <select wire:model="value" class="w-full text-xs rounded">
                <option value="*">Every day</option>
                <option value="*/2">Every 2 days</option>
                <!-- More options... -->
            </select>
        </div>
        
        <!-- Months -->
        <div>
            <label class="block text-xs font-medium">Months</label>
            <select wire:model="value" class="w-full text-xs rounded">
                <option value="*">Every month</option>
                <option value="1">January</option>
                <!-- More options... -->
            </select>
        </div>
        
        <!-- Weekdays -->
        <div>
            <label class="block text-xs font-medium">Weekdays</label>
            <select wire:model="value" class="w-full text-xs rounded">
                <option value="*">Every weekday</option>
                <option value="0">Sunday</option>
                <option value="1">Monday</option>
                <!-- More options... -->
            </select>
        </div>
    </div>
    
    <div class="text-center text-sm text-gray-600">
        Current expression: <code>{{ $value }}</code>
    </div>
</div>