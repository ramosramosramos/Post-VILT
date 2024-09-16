<template>

    <Head title="Me" />
    <section class=" min-h-[100svh]">
        <!-- ----------Link to add post----------- -->
        <!-- ----------Link to add post----------- -->
        <PageMessage />
        <div class=" h-[100px] w-[90%] m-auto flex flex-wrap  items-center justify-between">
            <GlobalLink name="Go back to my post" :href="route('posts.index')"/>

        </div>
        <div>

            <!-- <h1>{{ posts. }}</h1> -->
        </div>

        <MyPostCard reactable_type="post" :posts="posts"  />


    </section>
</template>
<script setup>
import Layout from '../../Layouts/Layout.vue';
import PageMessage from '@/Components/Messages/PageMessage.vue';
import MyPostCard from '@/Components/Cards/MyPostCard.vue';
import GlobalLink from '@/Components/Links/GlobalLink.vue';

defineOptions({
    layout: Layout
})
defineProps({
    posts: Array,
})
</script>
