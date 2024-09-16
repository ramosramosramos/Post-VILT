<template>

    <div v-for="post in posts" :key="post.id" class=" overflow-hidden w-[90%] m-auto mb-3  bg-gray-800
         text-gray-400 border-[1px] border-gray-800 hover:scale-95 duration-300
         hover:border-gray-700 transition-all ease-in-out px-2 rounded-md">
        <!-- --------------------menu-------------------- -->
        <div :class="['w-[99%] m-auto flex py-1 '
            , { 'justify-between': isPinned }, { 'justify-end': !isPinned }]">
            <!-- -------------------- if there is pin post---------------- -->
            <!-- -------------------- if there is pin post---------------- -->
            <h1 v-if="isPinned" class=" text-sm text-gray-400"> <span
                    class="  text-gray-500 select-none rotate-[-50deg] material-symbols-outlined">
                    keep
                </span> Pinned post</h1>
            <details class=" select-none relative z-50  open:text-yellow-500">
                <summary class=" list-none cursor-pointer hover:text-yellow-500 transition-all ease-in duration-150">
                    <span class="material-symbols-outlined ">
                        more_vert
                    </span>

                </summary>
                <ul v-if="!isTrashed" class="flex flex-col absolute right-0 w-max  bg-gray-900 rounded-sm">
                    <MyPostLinks v-if="!isPinned" method="post" :href="route('posts.pinPost', post.id)"
                        name="Pin this post" />
                    <MyPostLinks v-if="isPinned" method="post" :href="route('posts.unpinPost', post.id)"
                        name="Unpin this post" />
                    <small class="px-2 py-1 text-gray-500">Actions</small>
                    <MyPostLinks :href="route('posts.edit', post.id)" name="Edit post" />
                    <MyPostLinks method="delete" :href="route('posts.destroy', post.id)" name="Move to trash" />
                    <MyPostLinks method="post" :href="route('posts.forceDestroy', post.id)" name="Delete permanently" />
                    <small class="px-2 py-1 text-gray-500">Services</small>
                    <MyPostLinks name="Edit privacy" />
                    <MyPostLinks name="Send to" />

                </ul>
                <ul v-if="isTrashed" class="flex flex-col absolute right-0 w-max  bg-gray-900 rounded-sm">

                    <small class="px-2 py-1 text-gray-500">Actions</small>
                    <MyPostLinks method="post" :href="route('posts.restore', post.id)" name="Restore this post" />
                    <MyPostLinks method="post" :href="route('posts.forceDestroy', post.id)" name="Delete permanently" />
                </ul>

            </details>

        </div>

        <!-- --------------------captions and contents--------------------------- -->
        <!-- --------------------captions and contents--------------------------- -->
        <h1 class="text-[20px] text-center py-2 mb-3">{{ post.caption }}

        </h1>
        <div @click="handleShowPost(post.id)"
            class="  overflow-hidden  w-[90%] min-h-[20vh] m-auto border-gray-700 border-[1px] rounded-sm">

            <p class="flex-wrap text-wrap break-words text-sm px-2 py-2">{{ post.content }}
            </p>

        </div>
       <!-- -------------------Reactions here----------------------- -->
        <!-- -------------------Reactions here----------------------- -->
        <Reactions v-if="!isTrashed" :reactable_type="reactable_type" :reactable_id="post.id"
            :reactions="post.reactions" />

            <!-- --------------------comments and share------------------- -->
            <!-- --------------------comments and share------------------- -->



            <div class="w-[90%] m-auto">
                <span class=" mt-2 mb-4 material-symbols-outlined">
                    share
                </span>
                <small class="m-1">Share</small>
            </div>

        <!-- ------------------comment section------------------ -->
        <!-- ------------------comment section------------------ -->
        <CommentSection :comments="post.comments" :post_id="post.id" :user_id="post.user_id"  />
        <div class="flex justify-between">
            <p class="mt-5"><small>{{ isTrashed ? 'Deleted:' : 'Posted:' }} {{ post.time }}</small></p>
            <!-- ------------------privacy here ------------- -->
            <span class=" mt-4 material-symbols-outlined">
                {{ post.privacy }}
            </span>
        </div>

    </div>

</template>
<script setup>

import Reactions from '@/Components/Reactions.vue';
import { useForm } from '@inertiajs/vue3';
import MyPostLinks from '../Links/MyPostLinks.vue';
import CommentSection from '../CommentSection.vue';

defineProps({
    posts: Array,
    isPinned: false,
    isTrashed: false,
    reactable_type: String,
});
const form = useForm({});


const handleShowPost = (id) => {
    form.get(route('posts.show', id), {
        preserveScroll: true
    });
}
</script>


<style scoped></style>
