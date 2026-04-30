<script setup>
import { onMounted, ref } from 'vue';
import { gsap } from 'gsap';

const emit = defineEmits(['loaded']);
const preloader = ref(null);
const logo = ref(null);

onMounted(() => {
    // Safety timeout — never block the page for more than 5 seconds
    const safety = setTimeout(() => {
        emit('loaded');
    }, 5000);

    const tl = gsap.timeline({
        onComplete: () => {
            clearTimeout(safety);
            emit('loaded');
        }
    });

    tl.from(logo.value, {
        scale: 0.8,
        opacity: 0,
        duration: 1.5,
        ease: 'expo.out'
    })
    .to(logo.value, {
        scale: 1.2,
        opacity: 0,
        duration: 1,
        ease: 'expo.in',
        delay: 0.3
    })
    .to(preloader.value, {
        yPercent: -100,
        duration: 1,
        ease: 'power4.inOut'
    });
});
</script>

<template>
    <div ref="preloader" class="fixed inset-0 z-[999] bg-white flex items-center justify-center">
        <div ref="logo" class="flex flex-col items-center">
            <img src="/logo.png" alt="Price and Quote" class="h-24 md:h-32 w-auto object-contain mb-8" />
            <div class="h-1 w-32 bg-slate-100 rounded-full overflow-hidden relative">
                <div class="absolute inset-0 bg-primary-500 animate-progress"></div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@keyframes progress {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
.animate-progress {
    animation: progress 2s infinite linear;
}
</style>
