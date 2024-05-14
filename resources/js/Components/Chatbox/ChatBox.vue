<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import axios from "axios";
import Message from "./Message.vue";
import MessageInput from "./MessageInput.vue";

const rootUrl = "http://127.0.0.1:8000";
const user = JSON.parse(
    document.getElementById("main").getAttribute("data-user")
);

const webSocketChannel = "channel_for_everyone";

const messages = ref([]);
const scroll = ref(null);

const scrollToBottom = () => {
    scroll.value.scrollIntoView({ behavior: "smooth" });
};

const connectWebSocket = () => {
    window.Echo.private(webSocketChannel).listen("GotMessage", async (e) => {
        getMessages();
    });
};

const getMessages = async () => {
    try {
        const response = await axios.get(`${rootUrl}/messages`);
        messages.value = response.data;
        setTimeout(scrollToBottom, 0);
    } catch (err) {
        console.error(err.message);
    }
};

onMounted(() => {
    getMessages();
    connectWebSocket();
});

onBeforeUnmount(() => {
    window.Echo.leave(webSocketChannel);
});
</script>

<template>
    <div class="row justify-content-center">
        <div class="col-md-8 px-8 pb-4">
            <div class="card">
                <div class="text-xl font-bold">Chat Box</div>
                <hr />
                <div class="card-body" style="height: 500px; overflow-y: auto">
                    <Message
                        v-for="message in messages"
                        :key="message.id"
                        :userId="user.id"
                        :message="message"
                    />
                    <span ref="scroll"></span>
                </div>
                <div class="card-footer">
                    <MessageInput
                        :rootUrl="rootUrl"
                        @fetch-messages="getMessages"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
