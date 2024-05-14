<script setup>
import ChatBox from "./ChatBox.vue";
const rootUrl = "http://127.0.0.1:8000";
</script>

<template>
    <div>
        <ChatBox :rootUrl="rootUrl" />
    </div>
</template>
