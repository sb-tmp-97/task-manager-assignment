<script setup>

import {computed} from "vue";

const props = defineProps({
    task: Object,
});

const assignedTo = computed(() => {

    const names = Object.values(props.task.assigned_to);

    if (names.length === 0) {

        return null; // No names, return null

    }

    if (names.length === 1) {

        return names[0]; // Only one name, return it as-is

    }

    return names.slice(0, -1).join(', ') + ' and ' + names[names.length - 1]; // Multiple names, format as "name, name and name"

})
</script>

<template>
    <li class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6">
        <div class="min-w-0">
            <div class="flex items-start gap-x-3">
                <p class="text-sm/6 font-semibold text-gray-900">{{ task.title }}</p>
                <p :class="[task.completed ? 'text-green-700 bg-green-50 ring-green-600/20' : 'ext-gray-600 bg-gray-50 ring-gray-500/10', 'mt-0.5 whitespace-nowrap rounded-md px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset']">{{ task.completed ? 'Completed' : 'Pending' }}</p>
            </div>
            <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
                <p class="whitespace-nowrap" v-if="task.due_date">
                    Due on {{ task.due_date }}
                </p>
                <svg viewBox="0 0 2 2" class="size-0.5 fill-current" v-if="(task.due_date && assignedTo)">
                    <circle cx="1" cy="1" r="1" />
                </svg>
                <p class="truncate" v-if="assignedTo">Assigned to {{ assignedTo }}</p>
            </div>
        </div>
        <div class="flex flex-none items-center gap-x-4">
            <button class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block">
                View Task
            </button>
        </div>
    </li>
</template>
