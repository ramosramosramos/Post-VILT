<template>
    <header>
        <nav class="flex items-center h-[50px] bg-gray-800">
            <button @click="isOpen = true" class="ml-2 text-gray-300">
                <span class="material-symbols-outlined">
                    menu
                </span></button>
        </nav>

        <!-- side navigation -->
        <aside :class="[' h-[100%] w-[250px] fixed top-0  bg-gray-800 z-50',
            'transition-all ease-in duration-300',
            { 'left-[-999px]': !isOpen },
            { 'left-[0px]': isOpen }
        ]">
            <!-- Side menu content goes here -->
       <div class="absolute w-[100%] flex flex-col gap-1 m-auto top-[200px]">
        <MenuLink name="Public" :href="route('posts.public')" component="Posts/Public"/>
        <MenuLink name="My Post" :href="route('posts.index')" component="Posts/Index"/>
        <MenuLink name="Trash" :href="route('posts.indexTrash')" component="Posts/Trash" />
       </div>

        </aside>
    </header>
    <main @click="isOpen = false" class="bg-gray-900">

        <Head :title="title" />
        <slot />
    </main>
</template>

<script setup>
import { ref, watch } from "vue";
import MenuLink from "@/Components/Links/MenuLink.vue";
defineProps({
    title: String,
})
// Retrieve the initial state from localStorage
const storedState = localStorage.getItem('isOpen');
const isOpen = ref(storedState === 'true'); // Convert to boolean



// Watch for changes to isOpen and store in localStorage
watch(isOpen, (newValue) => {
    localStorage.setItem('isOpen', newValue.toString());
});
</script>
