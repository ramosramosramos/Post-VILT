<template>

    <div class="w-[90%] m-auto rounded-sm">
        <label class="text-gray-400" >{{label}} <span class="text-red-500">*</span></label>
        <textarea v-model="model" :class=" ['bg-gray-700',
         'text-gray-200 resize-none w-[100%]' ,
         'min-h-[30vh] rounded-sm',
         {'border-red-500':error},
         ]" :placeholder="placeholder"></textarea>
         <p class="text-red-500 text-center mb-2">{{ error }}</p>
    </div>
</template>
<script setup>
defineProps({
    label: {
        type: String,
        default: "label"
    },
    placeholder: {
        type: String,
        default: "What's on your mind? "
    },
    error: {
        type: String,
        default: ""
    },


});
const model = defineModel();
</script>
