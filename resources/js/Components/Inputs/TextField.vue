<template>
<div class="mb-6 ">
    <label class="text-gray-400">{{ label }} <span class="text-red-500">*</span> </label>
    <input :type="type" v-model="model" :placeholder="placeholder"
    :class="['w-[100%] px-2  bg-gray-700',
         'text-gray-200 border-gray-600 rounded-sm',
         {'border-red-500':error},
         ]">
    <p class="text-red-500">{{ error }}</p>
</div>
</template>
<script setup>

defineProps({
    type:{
        type:String,
        default:"text",
    },
    placeholder:{
        type:String,
        default:"placeholder",
    },

    error:{
        type:String,
        default:"",
    },
    label:{
        type:String,
        default:"label",
    }

});

const model = defineModel();

</script>
<style scoped>
div{
width: clamp(200px,50vw + 5rem,400px);
}

</style>
