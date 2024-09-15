<template>
    <div class="w-[90%] m-auto mt-1 flex flex-col gap-2 ">
        <span><small>Total reactions :{{ reactions.total }}</small></span>
        <form @submit.prevent="handleReaction" class="flex gap-2">
            <button @click="form.type = 'heart'">
                <span class="material-symbols-outlined">
                    favorite
                </span>

                <small v-if="reactions.heart>0">{{ reactions.heart }} </small>
            </button>

            <button @click="form.type = 'happy'">
                <span class="material-symbols-outlined">
                    sentiment_very_satisfied
                </span>
                <small v-if="reactions.happy>0">{{ reactions.happy }}</small>
            </button>
            <button @click="form.type = 'dislike'">
                <span class="material-symbols-outlined">
                    thumb_down
                </span>

                <small v-if="reactions.dislike>0">{{ reactions.dislike }}</small>
            </button>

            <button @click="form.type = 'mad'">
                <span class="material-symbols-outlined">
                    sentiment_extremely_dissatisfied
                </span>
                <small v-if="reactions.mad>0">{{ reactions.mad }}</small>
            </button>

            <button @click="form.type = 'sad'">
                <span class="material-symbols-outlined">
                    sentiment_dissatisfied
                </span>
                <small v-if="reactions.sad>0">{{ reactions.sad }}</small>
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
    reactions:Object
});



const form = useForm({
    user_id:page.props.auth.user.id,
    type: '',// type of reactions heart||sad||mad etc.
    reactable_id: props.reactable_id,//post id or comment id
    reactable_type: props.reactable_type,// what type? is it post or comment?
});

const handleReaction = () => {

    form.post(route('posts.reaction'), {
        preserveScroll:true,
        onError: (errors) => {
            console.error(errors); // Handle errors
        },
        onSuccess: () => {

        }
    });


}

</script>
