<script setup>
import {computed, inject} from "vue";
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    project: Object,
});

const route = inject('route');

const completionBarWidth = computed(() => {

    return Math.round((props.project.tasks_completed / props.project.tasks_total) * 100);

});
</script>

<template>
    <li class="col-span-1 flex rounded-md shadow-sm">
        <div class="flex flex-1 items-center justify-between truncate rounded-md border border-gray-200 bg-white">
            <Link :href="route('projects.tasks.index', project.id)" class="flex-1">
                <div class="flex-1 truncate px-4 py-2 text-sm">
                    <span class="text-lg font-medium text-gray-900 hover:text-gray-600">{{ project.title }}</span>
                    <p class="text-gray-500 text-sm mt-1">{{ project.tasks_completed }} / {{ project.tasks_total }} tasks completed</p>
                    <div class="flex mt-3 relative">
                        <div class="h-2 bg-green-50 flex flex-1"></div>
                        <div class="h-2 bg-green-500 absolute top-0 bottom-0 left-0" :style="{ width: completionBarWidth + '%' }"></div>
                    </div>
                </div>
            </Link>
        </div>
    </li>
</template>
