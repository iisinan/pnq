<script setup>
defineProps({
    showText: {
        type: Boolean,
        default: true
    }
});
</script>

<template>
    <div class="flex items-center group cursor-pointer">
        <img
            src="/logo.png"
            alt="Price and Quote"
            class="object-contain transition-all duration-500"
            :class="$attrs.class || 'h-10 w-auto'"
        />
    </div>
</template>
