<script setup>
import { CheckIcon, TrashIcon } from '@heroicons/vue/20/solid'
import {computed, inject} from "vue";
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    project: Object,
    task: Object,
});

const route = inject('route');

const assignedTo = computed(() => {

    const names = Object.values(props.task.assigned_to);

    if (names.length === 0) {

        return null; // No names, return null

    }

    if (names.length === 1) {

        return names[0]; // Only one name, return it as-is

    }

    return names.slice(0, -1).join(', ') + ' and ' + names[names.length - 1]; // Multiple names, format as "name, name and name"

});
</script>

<template>
    <li class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl relative flex flex-col gap-x-6 px-4 py-5 sm:px-6">
        <div class="flex-1 flex justify-between">
            <div class="min-w-0">
                <div class="flex items-start gap-x-3">
                    <p class="text-sm/6 font-semibold text-gray-900">{{ task.title }}</p>
                    <p :class="[task.completed ? 'text-green-700 bg-green-50 ring-green-600/20' : 'ext-gray-600 bg-gray-50 ring-gray-500/10', 'mt-0.5 whitespace-nowrap rounded-md px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset']">{{ task.completed ? 'Completed' : 'Pending' }}</p>
                </div>
                <div class="flex items-center gap-x-2 text-sm text-gray-500">
                    <p class="whitespace-nowrap" v-if="task.due_date">
                        Due on {{ task.due_date }}
                    </p>
                    <svg viewBox="0 0 2 2" class="size-0.5 fill-current" v-if="(task.due_date && assignedTo)">
                        <circle cx="1" cy="1" r="1" />
                    </svg>
                    <p class="truncate" v-if="assignedTo">Assigned to {{ assignedTo }}</p>
                </div>
            </div>
            <div class="flex flex-none items-center gap-x-2">
                <Link :href="route('projects.tasks.complete', {project: project.id, task: task.id})" method="put" as="button" type="button" class="relative inline-flex items-center rounded-md bg-white px-2 py-2 text-slate-800 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10 disabled:text-gray-300" v-if="!task.completed && task.can.complete">
                    <CheckIcon class="size-4" aria-hidden="true" />
                </Link>

                <Link :href="route('projects.tasks.destroy', {project: project.id, task: task.id})" method="delete" as="button" type="button" class="relative -ml-px inline-flex items-center rounded-md bg-white px-2 py-2 text-slate-800 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10  disabled:text-gray-300 disabled:cursor-not-allowed" v-if="task.can.delete">
                    <TrashIcon class="size-4" aria-hidden="true" />
                </Link>
            </div>
        </div>
        <div class="border-t border-gray-100 pt-3 mt-3 text-sm text-gray-500" v-html="task.description" v-if="task.description" />
    </li>
</template>
