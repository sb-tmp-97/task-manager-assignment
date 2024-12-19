<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ProjectCard from "@/Pages/Projects/Components/ProjectCard.vue";

defineProps({
    projects: Array
});
</script>

<template>
    <Head title="Projects" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 mb-8">
                    Projects
                </h2>

                <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3">
                    <ProjectCard
                        :key="project.id"
                        :project="project"
                        v-for="project in projects"
                    />
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
