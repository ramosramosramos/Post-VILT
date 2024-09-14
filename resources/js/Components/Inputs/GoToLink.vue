<template>
    <Link :href="href"  as="button" type="button" :class="['text-gray-300 tracking-widest',
     'border-gray-800 hover:bg-gray-800',
     'transition-all ease-in border-[1px] rounded-sm',
     newClass
     ]">
        {{ name }}</Link>
</template>
<script setup>

defineProps({
    name: {
        type: String,
        default: "Button"
    },
    href: {
        type: String,
        default: "#"
    },
    newClass:String,
})

</script>

<style scoped>
button {
    height: 45px;
    width: clamp(200px, 50vw + 5rem, 400px);
}
</style>
