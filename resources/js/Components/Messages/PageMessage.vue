<template>
<div class="bg-gray-700">
    <h1 v-if="$page.props.flash.welcome"
    class=" text-gray-200 px-2  py-2">
    {{ $page.props.flash.welcome }}</h1>

    <h1 v-if="$page.props.flash.deleted"
    class=" text-gray-200 px-2  py-2">
    {{ $page.props.flash.deleted }}</h1>

    <h1 v-if="$page.props.flash.updated"
    class=" text-gray-200 px-2  py-2">
    {{ $page.props.flash.updated }}</h1>

    <h1 v-if="$page.props.flash.restored"
    class=" text-gray-200 px-2  py-2">
    {{ $page.props.flash.restored }}</h1>
    <h1 v-if="$page.props.flash.pinned"
    class=" text-gray-200 px-2  py-2">
    {{ $page.props.flash.pinned }}</h1>
</div>
</template>
<script setup>
</script>
