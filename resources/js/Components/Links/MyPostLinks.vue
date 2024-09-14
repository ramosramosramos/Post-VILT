<template>
    <Link :href="href"  as="button" type="button" :method="method"
    class="px-3 text-start
    border-gray-700
     border-[1px]
     text-gray-300
     hover:border-gray-500 rounded-sm
     transition-all ease-in duration-75
     m-1">{{ name }}</Link>

</template>
<script setup>
defineProps({
    name: String,
    href:{
        type:String,
        default:'#',
    },

    method:{
        type:String,
        default:'get',
    }
}
);


</script>
