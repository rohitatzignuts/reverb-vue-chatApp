<script setup>
import { ref } from "vue";
import axios from "axios";

const props = defineProps({
    rootUrl: String,
});

const emits = defineEmits(["fetchMessages"]);

const message = ref("");

const messageRequest = async (text) => {
    try {
        await axios.post(`${props.rootUrl}/message`, { text });
    } catch (err) {
        console.log(err.message);
    }
};

const sendMessage = () => {
    if (message.value.trim() === "") {
        alert("Please enter a message!");
        return;
    }
    messageRequest(message.value);
    emits("fetchMessages");
    message.value = "";
};

const handleInput = (e) => {
    message.value = e.target.value;
};
</script>

<template>
    <div class="flex mt-6">
        <input
            v-model="message"
            autocomplete="off"
            type="text"
            class="w-full rounded-l border-r-0"
            placeholder="Message..."
            @input="handleInput"
            @keyup.enter="sendMessage"
        />
        <div class="bg-indigo-500 rounded-r">
            <button @click="sendMessage" class="py-2 px-4 text-white">
                Send
            </button>
        </div>
    </div>
</template>
