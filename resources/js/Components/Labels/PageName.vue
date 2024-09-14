<template>
<div class="text-gray-600">
    <h1 class="text-2xl font-bold">{{ name }}</h1>
</div>
</template>
<script setup>
defineProps({
name:{
    type:String,
    default:"Page Name",
}
});
</script>
