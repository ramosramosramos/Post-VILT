<template>

    <Head title="Register" />
    <section class=" bg-gray-900 flex flex-col  justify-center items-center min-h-[100dvh]">

        <form @submit.prevent="handleRegister">
            <div class="mb-3">
                <PageName name="Register" />
            </div>
            <TextField :error="form.errors.name" v-model="form.name" label="Full name" placeholder="John Doe F." />
            <TextField :error="form.errors.email" v-model="form.email" label="Email" placeholder="exmple@mail.com" />
            <TextField :error="form.errors.password" v-model="form.password" type="password" label="Password" placeholder="Must be more than 8 characters" />
            <TextField v-model="form.password_confirmation" label="Confirmation" type="password" placeholder="Re-type password" />
            <PrimaryButton name="Create" />

        </form>
        <div class="mt-10">
            <GoToLink :href="route('login')" name=" Go to login" />
        </div>
    </section>
</template>

<script setup>

import PageName from '@/Components/Labels/PageName.vue';
import TextField from '@/Components/Inputs/TextField.vue';
import PrimaryButton from '@/Components/Inputs/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import GoToLink from '@/Components/Inputs/GoToLink.vue';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});

const handleRegister = () => {
    form.post(route('auth.register'));
}
</script>
