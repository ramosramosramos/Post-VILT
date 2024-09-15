<template>
    <div class="w-[90%] m-auto mt-1 ">
        <form @submit.prevent="handleReaction" class="flex gap-6">
            <button @click="form.type = 'heart'">
                <span class="material-symbols-outlined">
                    favorite
                </span>
            </button>

            <button @click="form.type = 'happy'">
                <span class="material-symbols-outlined">
                    sentiment_very_satisfied
                </span>
            </button>
            <button @click="form.type = 'dislike'">
                <span class="material-symbols-outlined">
                    thumb_down
                </span>
            </button>

            <button @click="form.type = 'mad'">
                <span class="material-symbols-outlined">
                    sentiment_extremely_dissatisfied
                </span>
            </button>

            <button @click="form.type = 'sad'">
                <span class="material-symbols-outlined">
                    sentiment_dissatisfied
                </span>
            </button>

        </form>

    </div>
</template>
<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
const page = usePage();
const props = defineProps({
    reactable_type: String,
    reactable_id: Number,

});



const form = useForm({
    user_id:page.props.auth.user.id,
    type: '',// type of reactions heart||sad||mad etc.
    reactable_id: props.reactable_id,//post id or comment id
    reactable_type: props.reactable_type,// what type? is it post or comment?
});

const handleReaction = () => {

        form.post(route('posts.reaction'));


}

</script>
