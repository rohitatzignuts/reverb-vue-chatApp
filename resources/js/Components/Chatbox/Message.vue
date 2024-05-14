<script setup>
defineProps({
    userId: Number,
    message: Object,
});
</script>

<template>
    <div
        :class="`row ${
            userId === message.user_id ? 'justify-content-end' : ''
        }`"
    >
        <div class="col-md-6">
            <div
                :class="
                    userId === message.user.id
                        ? 'text-indigo-500'
                        : 'text-red-500'
                "
            >
                <span>{{ message.user.name }} | </span>
            </div>
            <div role="alert" class="pl-4 italic">
                {{ message.text }}
            </div>
            <small class="float-right pr-4">{{ message.time }}</small>
        </div>
    </div>
</template>
