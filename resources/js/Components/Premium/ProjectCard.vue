<script setup>
import { ref } from 'vue';
import { Dialog, DialogPanel, DialogTitle, TransitionRoot, TransitionChild } from '@headlessui/vue';

const props = defineProps({
    project: Object
});

const isOpen = ref(false);
</script>

<template>
    <div>
        <!-- Card -->
        <div
            @click="isOpen = true"
            class="group relative aspect-[4/5] rounded-3xl overflow-hidden cursor-pointer bg-slate-100 border border-slate-200 transition-all duration-500 hover:-translate-y-2 hover:shadow-xl hover:shadow-primary-500/10"
        >
            <img
                :src="project.thumbnail || 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1000&auto=format&fit=crop'"
                @error="(e) => e.target.src = 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1000&auto=format&fit=crop'"
                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-500"></div>

            <div class="absolute bottom-0 left-0 p-8 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                <div class="text-xs font-black uppercase tracking-widest text-primary-400 mb-2">{{ project.category }}</div>
                <h4 class="text-2xl font-bold text-white mb-2 tracking-tight leading-tight">{{ project.title }}</h4>
                <p class="text-white/60 text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">{{ project.description }}</p>
                <div class="mt-4 flex items-center text-white text-xs font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-200">
                    View Details <span class="ml-2">→</span>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" @close="isOpen = false" class="relative z-[200]">
                <TransitionChild as="template" enter="duration-500 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-300 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-white/80 backdrop-blur-2xl" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-6 md:p-12">
                        <TransitionChild as="template" enter="duration-700 cubic-bezier(0.16, 1, 0.3, 1)" enter-from="opacity-0 scale-95 translate-y-20" enter-to="opacity-100 scale-100 translate-y-0" leave="duration-300 ease-in" leave-from="opacity-100 scale-100 translate-y-0" leave-to="opacity-0 scale-95 translate-y-20">
                            <DialogPanel class="w-full max-w-6xl transform overflow-hidden rounded-3xl bg-white p-10 md:p-16 text-left shadow-2xl shadow-slate-200/50 transition-all border border-slate-200">
                                <div class="flex justify-between items-start mb-12">
                                    <div class="max-w-2xl">
                                        <div class="text-sm font-black uppercase tracking-widest text-primary-500 mb-3">{{ project.category }}</div>
                                        <DialogTitle as="h3" class="text-4xl md:text-6xl font-black tracking-tighter text-slate-900 leading-[0.9]">
                                            {{ project.title }}
                                        </DialogTitle>
                                    </div>
                                    <button @click="isOpen = false" class="p-4 rounded-2xl border border-slate-200 hover:bg-slate-50 transition-all group">
                                        <svg class="w-6 h-6 text-slate-400 group-hover:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                                    <div class="lg:col-span-8">
                                        <div class="aspect-video rounded-3xl overflow-hidden mb-10 shadow-xl">
                                            <img
                                                :src="project.thumbnail || 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200&auto=format&fit=crop'"
                                                @error="(e) => e.target.src = 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200&auto=format&fit=crop'"
                                                class="w-full h-full object-cover"
                                            />
                                        </div>
                                        <p class="text-slate-600 text-xl leading-relaxed font-light">{{ project.content || project.description }}</p>
                                    </div>
                                    <div class="lg:col-span-4 space-y-8">
                                        <div class="bg-slate-50 p-10 rounded-3xl border border-slate-100">
                                            <h5 class="text-sm font-black uppercase tracking-widest text-secondary-500 mb-8">Project Details</h5>
                                            <div class="space-y-8">
                                                <div class="flex flex-col">
                                                    <div class="text-xs text-slate-400 uppercase font-bold mb-1">Client</div>
                                                    <div class="text-lg text-slate-900 font-bold">{{ project.client_name || 'Price and Quote' }}</div>
                                                </div>
                                                <div class="flex flex-col">
                                                    <div class="text-xs text-slate-400 uppercase font-bold mb-1">Year</div>
                                                    <div class="text-lg text-slate-900 font-bold">{{ project.year || '2024' }}</div>
                                                </div>
                                                <div class="flex flex-col">
                                                    <div class="text-xs text-slate-400 uppercase font-bold mb-1">Sector</div>
                                                    <div class="text-lg text-slate-900 font-bold">{{ project.category }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>
