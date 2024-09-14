<template>
<div class="text-gray-400">
<Link :href="href"  as="button" type="button"
:class="['bg-gray-700 hover:bg-gray-800 px-2 rounded-sm',
'transition-all ease-in duration-200',newClass]">
   <abbr class="no-underline" title="You can add new post"> {{ name }}</abbr>
</Link>
</div>
</template>
<script setup>
defineProps({
    name:{
        type:String,
        default:"Link name",
    },

    href:{
        type:String,
        default:"#",
    },
    newClass:{
        type:String,
        default:"",
    }
})
</script>
