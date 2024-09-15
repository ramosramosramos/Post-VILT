<template>

    <Head title="My Trash" />
    <section class=" min-h-[100vh]">
        <!-- ----------Link to add post----------- -->
        <!-- ----------Link to add post----------- -->
        <PageMessage />
        <div class=" h-[100px] w-[90%] m-auto flex flex-wrap  items-center justify-between">
            <PageName name="Trashed posts" />

        </div>
        <div>

            <!-- <h1>{{ posts. }}</h1> -->
        </div>
        <MyPostCard :posts="posts"  :isTrashed="true" />
    </section>
</template>
<script setup>
import Layout from '../../Layouts/Layout.vue';
import PageName from '@/Components/Labels/PageName.vue';
import MyPostCard from '@/Components/Cards/MyPostCard.vue';
import PageMessage from '@/Components/Messages/PageMessage.vue';

defineOptions({
    layout: Layout
})
defineProps({
    posts: Array,
})
</script>
