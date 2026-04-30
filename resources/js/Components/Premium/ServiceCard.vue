<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
    description: String,
    icon: String,
    details: Array,
});

const isExpanded = ref(false);
</script>

<template>
    <div
        class="bg-white p-10 group transition-all duration-500 cursor-pointer overflow-hidden relative border border-slate-200 rounded-3xl hover:border-primary-500/30 hover:shadow-xl hover:shadow-primary-500/10"
        :class="[isExpanded ? 'ring-2 ring-primary-500/30 scale-[1.02] shadow-xl' : 'hover:-translate-y-2']"
        @click="isExpanded = !isExpanded"
    >
        <div class="flex items-start justify-between mb-6">
            <div
                class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center group-hover:bg-primary-500 transition-all duration-500"
                :class="{'bg-primary-500': isExpanded}"
            >
                <svg class="w-8 h-8 text-primary-500 group-hover:text-white transition-colors" :class="{'text-white': isExpanded}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" :d="icon" />
                </svg>
            </div>
            <div class="text-slate-300 group-hover:text-primary-500 transition-all duration-500" :class="{'rotate-45 text-primary-500': isExpanded}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
            </div>
        </div>

        <h4 class="text-2xl font-bold mb-4 text-slate-900 group-hover:text-primary-500 transition-colors tracking-tight">{{ title }}</h4>
        <p class="text-slate-500 leading-relaxed mb-4">{{ description }}</p>

        <Transition
            enter-active-class="transition duration-500 ease-out"
            enter-from-class="opacity-0 max-h-0"
            enter-to-class="opacity-100 max-h-[600px]"
            leave-active-class="transition duration-300 ease-in"
            leave-from-class="opacity-100 max-h-[600px]"
            leave-to-class="opacity-0 max-h-0"
        >
            <div v-if="isExpanded" class="pt-6 border-t border-slate-100 space-y-4">
                <div v-for="(detail, i) in details" :key="i" class="flex items-center space-x-3 text-slate-600">
                    <div class="w-1.5 h-1.5 bg-primary-500 rounded-full"></div>
                    <span class="font-semibold text-sm">{{ detail }}</span>
                </div>
                <div class="pt-4">
                    <Link href="/contact" class="block w-full bg-slate-900 text-white py-4 rounded-2xl font-bold text-base text-center hover:bg-primary-500 transition-all duration-500 active:scale-95">
                        Inquire Now
                    </Link>
                </div>
            </div>
        </Transition>
    </div>
</template>
