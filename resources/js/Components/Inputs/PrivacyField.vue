<template>
    <label class="text-gray-400">Privacy</label>
    <select v-model="model" class="bg-inherit w-max text-gray-500 cursor-pointer focus:ring-gray-800 ">
        <option class="bg-inherit"  value="public">Public</option>
        <option value="groups">Friends of friends</option>
        <option value="group">Friends</option>
        <option value="person">Only me</option>
    </select>
</template>

<script setup>
defineProps({
    label:{
        type:String,
        default:"Privacy"
    }
})
const model = defineModel();
</script>
