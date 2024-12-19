<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { PlusIcon } from '@heroicons/vue/20/solid'
import TaskItem from "@/Pages/Projects/Components/TaskItem.vue";

defineProps({
    project: Object,
    tasks: Array,
});
</script>

<template>
    <Head :title="project.title" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        {{ project.title }}
                    </h2>

                    <button type="button" class="rounded-full bg-slate-600 p-1.5 text-white shadow-sm hover:bg-slate-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <PlusIcon class="size-5" aria-hidden="true" />
                    </button>
                </div>

                <ul role="list" class="divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                    <TaskItem
                        :key="task.id"
                        :task="task"
                        v-for="task in tasks"
                    />
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
