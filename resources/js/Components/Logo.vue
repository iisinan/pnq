<script setup>
defineProps({
    showText: {
        type: Boolean,
        default: true
    }
});
</script>

<template>
    <div class="flex flex-col items-center justify-center group cursor-pointer">
        <img
            src="/logo.png"
            alt="Price and Quote"
            class="object-contain transition-all duration-500"
            :class="$attrs.class || 'h-10 w-auto'"
        />
        <span v-if="showText" class="mt-1 text-[10px] md:text-xs font-bold tracking-[0.15em] uppercase text-slate-800 whitespace-nowrap">Price &amp; Quote</span>
    </div>
</template>
