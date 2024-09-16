<template>

    <Head title="Edit" />
    <section class="min-h-[100vh]">
        <!-- ----------Link to home----------- -->
        <!-- ----------Link to home----------- -->
        <div class=" h-[100px] w-[90%] m-auto flex flex-wrap  items-center justify-between">
            <PageName name="Edit post" />
            <GlobalLink :href="route('posts.index')" name="Go back" />
        </div>
        <!-- --------------form to create post------------------ -->
        <!-- --------------form to create post------------------ -->
        <form @submit.prevent="handleEdit">
            <div class="w-[90%] m-auto rounded-sm">
                <TextField label="Caption" placeholder="Title" v-model="form.caption" :error="form.errors.caption" />
            </div>
            <TextAreaField label="Content" v-model="form.content" :error="form.errors.content" />
            <div class="w-[90%] flex flex-col m-auto mb-5">
                <PrivacyField v-model="form.privacy" />
            </div>
            <div class="w-[90%] m-auto">
                <PrimaryButton name="Publish now" />
            </div>
        </form>

    </section>
</template>
<script setup>
import Layout from '@/Layouts/Layout.vue';
import PrimaryButton from '@/Components/Inputs/PrimaryButton.vue';
import PageName from '@/Components/Labels/PageName.vue';
import TextAreaField from "@/Components/Inputs/TextAreaField.vue"
import TextField from "@/Components/Inputs/TextField.vue";
import PrivacyField from '@/Components/Inputs/PrivacyField.vue';
import { useForm } from '@inertiajs/vue3';
defineOptions({
    layout: Layout,

});
const props = defineProps({
    auth: Object,
    myPost: Object,
});

const form = useForm({
    user_id: props.auth.user.id,
    caption: props.myPost.caption,
    content: props.myPost.content,
    privacy: props.myPost.privacy,
})
const handleEdit = () => {
    form.put(route('posts.update', props.myPost.id));
}

</script>
