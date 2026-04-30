<script setup>
import { ref, computed, onMounted } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import ProjectCard from '@/Components/Premium/ProjectCard.vue';
import { useGSAP } from '@/Composables/useGSAP';

const props = defineProps({
    projects: Array
});

const { gsap, ScrollTrigger } = useGSAP();
const activeCategory = ref('All');

const categories = computed(() => {
    return ['All', ...new Set(props.projects.map(p => p.category))];
});

const filteredProjects = computed(() => {
    if (activeCategory.value === 'All') return props.projects;
    return props.projects.filter(p => p.category === activeCategory.value);
});

onMounted(() => {
    gsap.from('.hero-reveal', { y: 80, opacity: 0, duration: 1.5, stagger: 0.2, ease: 'expo.out' });

    gsap.from('.project-reveal', {
        y: 60, opacity: 0, duration: 1, stagger: 0.1, ease: 'power3.out',
        scrollTrigger: { trigger: '.projects-grid', start: 'top 80%' }
    });
});
</script>

<template>
    <MainLayout>
        <!-- Hero -->
        <section class="pt-48 pb-32 px-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-primary-500/10 blur-[150px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-secondary-500/5 blur-[150px] rounded-full -translate-x-1/2 translate-y-1/2"></div>

            <div class="max-w-7xl mx-auto relative z-10">
                <div class="max-w-4xl hero-reveal">
                    <h2 class="text-secondary-500 font-bold tracking-widest uppercase mb-6">Our Track Record</h2>
                    <h1 class="text-6xl md:text-9xl font-black tracking-tighter leading-[0.85] mb-12 text-slate-900">
                        Project <br/> <span class="text-slate-300">Milestones.</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-slate-500 max-w-2xl leading-relaxed font-light">
                        Explore our portfolio of award-winning projects across construction, agriculture, renewable energy, and digital infrastructure.
                    </p>
                </div>
            </div>
        </section>

        <!-- Projects -->
        <section class="py-24 px-6 bg-slate-50/50 border-y border-slate-100">
            <div class="max-w-7xl mx-auto">
                <!-- Filters -->
                <div class="flex flex-col md:flex-row items-center justify-between mb-20 gap-8">
                    <div class="flex items-center space-x-4 flex-wrap gap-y-3">
                        <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Filter:</span>
                        <button
                            v-for="cat in categories"
                            :key="cat"
                            @click="activeCategory = cat"
                            class="px-6 py-2.5 rounded-2xl text-sm font-bold transition-all duration-300 border"
                            :class="[activeCategory === cat ? 'bg-primary-500 text-white border-primary-500 shadow-lg shadow-primary-500/20' : 'bg-white border-slate-200 text-slate-500 hover:border-primary-500 hover:text-primary-500']"
                        >
                            {{ cat }}
                        </button>
                    </div>
                    <div class="text-slate-400 font-medium text-sm">
                        {{ filteredProjects.length }} project{{ filteredProjects.length !== 1 ? 's' : '' }}
                    </div>
                </div>

                <!-- Grid -->
                <TransitionGroup
                    tag="div"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 projects-grid"
                    move-class="transition duration-700 ease-in-out"
                    enter-active-class="transition duration-700 ease-out"
                    enter-from-class="opacity-0 translate-y-10"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition duration-500 ease-in absolute"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-90"
                >
                    <ProjectCard
                        v-for="project in filteredProjects"
                        :key="project.id"
                        class="project-reveal"
                        :project="project"
                    />
                </TransitionGroup>

                <div v-if="filteredProjects.length === 0" class="py-32 text-center">
                    <div class="inline-block p-10 bg-white rounded-3xl border border-slate-200">
                        <svg class="w-16 h-16 text-slate-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <p class="text-xl font-bold text-slate-400 mb-4">No projects in this sector yet.</p>
                        <button @click="activeCategory = 'All'" class="text-primary-500 font-bold text-sm hover:underline">View All Projects</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats CTA -->
        <section class="py-32 px-6">
            <div class="max-w-7xl mx-auto bg-slate-900 p-12 md:p-24 rounded-3xl text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10 pointer-events-none"></div>
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/20 blur-[100px] rounded-full"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-7xl font-black text-white tracking-tighter mb-12">Driven by <span class="text-primary-500">Excellence.</span></h2>
                    <div class="flex justify-center space-x-8 md:space-x-16 mb-12">
                        <div class="flex flex-col items-center">
                            <span class="text-5xl font-black text-white mb-2">20+</span>
                            <span class="text-primary-500 font-bold uppercase tracking-widest text-xs">Projects</span>
                        </div>
                        <div class="w-px h-20 bg-white/10"></div>
                        <div class="flex flex-col items-center">
                            <span class="text-5xl font-black text-white mb-2">12+</span>
                            <span class="text-primary-500 font-bold uppercase tracking-widest text-xs">Years</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style scoped>
.projects-grid { position: relative; }
</style>