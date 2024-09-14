<template>
    <Link
    :href="href"
    :method="method"
   as="button"
   type="button"
    :class="['text-gray-400 w-[90%] h-[35px]',
    'rounded-sm m-auto bg-inherit',
    ' hover:bg-gray-700 transition-all ease-in duration-500',
    {'border-gray-600 border-[1px] hover:bg-inherit':page.component==component},
    ]">{{ name }}</Link>
</template>
<script setup>
import { usePage } from "@inertiajs/vue3"

const page = usePage();
defineProps({
    name:{
        type:String,
        default:'name:MenuLink',
    },
    method:{
        type: String,
        default: 'get',
    },

    href:String,

    component:String,

})
</script>
