<template>
    <details class=" flex flex-col gap-1 w-[90%] m-auto">
        <summary class="list-none select-none cursor-pointer">
            <div>
                <span class="  material-symbols-outlined">
                    comment
                </span>
                <small class="m-1">Comments</small>
            </div>
        </summary>
        <!-- -----------form to add comment--------------- -->
        <!-- -----------form to add comment--------------- -->
        <form @submit.prevent="handleComment" class=" flex  flex-col w-[100%] gap-2 m-auto ">
            <textarea v-model="form.contents" class=" resize-none rounded-sm
        bg-gray-800 "></textarea>
            <button class="border-[1px] border-gray-500 ">Add comment</button>
        </form>

        <!-- ----------------------------list of comments here------------- -->
        <!-- ----------------------------list of comments here------------- -->
        <div v-for="comment in comments" :key="comment.id"
        class="w-[90%] m-auto mt-2  bg-gray-900 rounded-sm px-2 py-2 ">

        <h1 v-if="comment.user_name===page.props.auth.user.name">You</h1>
            <h1 v-else>{{ comment.user_name }}</h1>
            <p><small class="px-5 ">{{ comment.content }}</small></p>
        </div>

    </details>
</template>
<script setup>
import { useForm, usePage } from "@inertiajs/vue3"
const page = usePage()
const props = defineProps({
    comments: Array,
    post_id: Number,
    user_id: Number,

})

const form = useForm({
    contents: "",
    user_id: props.user_id,
    post_id: props.post_id,
})



const handleComment = () => {
    form.post(route('comments.store'), { preserveScroll: true,
        onSuccess:()=>{
            form.reset();
        }
    });



}

</script>
