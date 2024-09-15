<template>

    <Head title="Me" />
    <section class=" min-h-[100svh]">
        <!-- ----------Link to add post----------- -->
        <!-- ----------Link to add post----------- -->
        <PageMessage />
        <div class=" h-[100px] w-[90%] m-auto flex flex-wrap  items-center justify-between">
            <PageName name="My posts" />
            <GlobalLink :href="route('posts.create')" name=" Add new post"
                newClass="bg-inherit border-[1px] py-1 border-gray-600" />
        </div>
        <div>

            <!-- <h1>{{ posts. }}</h1> -->
        </div>
        <div v-if="pinnedPosts">
            <MyPostCard  reactable_type="post" :posts="pinnedPosts" :isPinned="true" />
        </div>
        <MyPostCard  reactable_type="App\Models\Post" :posts="posts"  />





    </section>
</template>
<script setup>
import Layout from '../../Layouts/Layout.vue';
import GlobalLink from '@/Components/Links/GlobalLink.vue';
import PageName from '@/Components/Labels/PageName.vue';
import MyPostCard from '@/Components/Cards/MyPostCard.vue';
import PageMessage from '@/Components/Messages/PageMessage.vue';

defineOptions({
    layout: Layout
})
defineProps({
    posts: Array,
    pinnedPosts: Array,
})
</script>
