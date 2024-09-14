<template>

    <Head title="Login" />
    <section class=" bg-gray-900 flex flex-col  justify-center items-center min-h-[100dvh]">

        <form @submit.prevent="handleLogin">
            <div class="mb-3">
                <PageName name="Login account" />
            </div>
            <TextField :error="form.errors.email" v-model="form.email" label="Email" placeholder="exmple@mail.com" />
            <TextField :error="form.errors.password" v-model="form.password" type="password" label="Confirmation"
                placeholder="Password" />
            <div class="mb-6 ">

                <input  id="checkbox" type="checkbox" v-model="form.remember"  :class="['px-2  bg-gray-700',
                    'text-gray-700 border-gray-600 rounded-sm',
                    'focus:ring-0 cursor-pointer']">
                <label for="checkbox" class=" cursor-pointer text-gray-400 select-none"> Remember me<span
                        class="text-red-500">*</span> </label>

            </div>


            <div>
                <PrimaryButton name="Continue" />
            </div>

        </form>

        <div class="mt-10">
            <GoToLink :href="route('register')" name="Create account" />
        </div>

    </section>
</template>

<script setup>

import PageName from '@/Components/Labels/PageName.vue';
import TextField from '@/Components/Inputs/TextField.vue';
import PrimaryButton from '@/Components/Inputs/PrimaryButton.vue';
import GoToLink from '@/Components/Inputs/GoToLink.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: null,
    password: null,
    remember:false,
});

const handleLogin = () => {
    form.post(route('auth.login'));
}
</script>
