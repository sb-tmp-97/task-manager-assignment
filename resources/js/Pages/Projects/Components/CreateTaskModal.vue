<script setup>
import {reactive, watch} from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import MultiSelect from "@/Components/MultiSelect.vue";

const props = defineProps({
    submitUrl: String,
    users: Object,
});

const open = defineModel('open', {
    type: Boolean,
});

const form = useForm({
    title: '',
    due_date: '',
    assigned_to: [],
});

const submit = () => {

    form.post(props.submitUrl, {
        onSuccess: () => {

            open.value = false;

            form.reset();

        },
    });

}

// Reset form on modal open
watch(open, (value) => {

    if (value) {

        form.reset();
        form.clearErrors();

    }

})
</script>

<template>
    <TransitionRoot as="template" :show="open">
        <Dialog class="relative z-10" @close="open = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <form class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0" @submit.prevent="submit">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                            <DialogTitle as="h2" class="text-lg font-semibold text-gray-900">New Task</DialogTitle>

                            <div class="mt-4">
                                <InputLabel for="title" value="Title" />

                                <TextInput
                                    id="title"
                                    class="mt-1 block w-full"
                                    v-model="form.title"
                                />

                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="due_date" value="Due Date" />

                                <TextInput
                                    id="due_date"
                                    class="mt-1 block w-full"
                                    v-model="form.due_date"
                                    type="date"
                                />

                                <InputError class="mt-2" :message="form.errors.due_date" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="assigned_to" value="Assigned To" />

                                <MultiSelect
                                    id="assigned_to"
                                    class="mt-1 block w-full"
                                    v-model="form.assigned_to"
                                    type="date"
                                    :options="users"
                                />

                                <InputError class="mt-2" :message="form.errors.assigned_to" />
                            </div>

                            <div class="mt-5 sm:mt-6">
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-slate-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">Create</button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </form>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
