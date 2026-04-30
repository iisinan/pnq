<script setup>
import { ref, computed, onMounted } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { useGSAP } from '@/Composables/useGSAP';
import { Dialog, DialogPanel, DialogTitle, TransitionRoot, TransitionChild } from '@headlessui/vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({ projects: Array });
const { gsap } = useGSAP();
const activeCategory = ref('All');
const selectedProject = ref(null);

const categories = computed(() => ['All', ...new Set((props.projects || []).map(p => p.category).filter(Boolean))]);

const filteredProjects = computed(() => {
    if (activeCategory.value === 'All') return props.projects || [];
    return (props.projects || []).filter(p => p.category === activeCategory.value);
});

const categoryAccents = {
    'Construction': 'bg-amber-500',
    'Agriculture': 'bg-emerald-500',
    'Renewable Energy': 'bg-sky-500',
    'IT Consultancy': 'bg-violet-500',
    'Software Development': 'bg-blue-500',
    'Cybersecurity': 'bg-red-500',
    'E-Governance': 'bg-indigo-500',
};

const getCategoryAccent = (cat) => categoryAccents[cat] || 'bg-primary-500';

const getCategoryBg = (cat) => {
    const map = {
        'Construction': 'bg-amber-50',
        'Agriculture': 'bg-emerald-50',
        'Renewable Energy': 'bg-sky-50',
        'IT Consultancy': 'bg-violet-50',
        'E-Governance': 'bg-indigo-50',
        'Cybersecurity': 'bg-red-50',
    };
    return map[cat] || 'bg-primary-50';
};

const patternSymbols = ['◆', '▲', '●', '■', '◉', '★'];

onMounted(() => {
    gsap.from('.hero-reveal', { y: 70, opacity: 0, duration: 1.4, stagger: 0.15, ease: 'expo.out' });
    gsap.utils.toArray('.reveal').forEach((el) => {
        gsap.from(el, { scrollTrigger: { trigger: el, start: 'top 88%' }, y: 50, opacity: 0, duration: 1.2, ease: 'expo.out' });
    });
});
</script>

<template>
    <MainLayout>
        <!-- ═══ HERO ═══ -->
        <section class="relative pt-40 pb-20 px-6 overflow-hidden bg-white">
            <div class="absolute inset-0 pointer-events-none"
                 style="background-image: linear-gradient(rgba(58,190,249,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(58,190,249,0.05) 1px, transparent 1px); background-size: 60px 60px;"></div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-secondary-500/8 rounded-full blur-[120px] pointer-events-none translate-x-1/3 -translate-y-1/4"></div>

            <div class="max-w-7xl mx-auto relative z-10">
                <div class="hero-reveal inline-flex items-center gap-2 text-xs font-bold tracking-[0.18em] uppercase text-secondary-500 mb-8">
                    <span class="w-8 h-px bg-secondary-500"></span>
                    Our Track Record
                </div>
                <div class="flex flex-col md:flex-row md:items-end gap-10">
                    <div class="flex-1">
                        <h1 class="hero-reveal text-4xl sm:text-6xl md:text-8xl font-black tracking-tighter leading-[0.88] text-slate-900">
                            Project<br/><span class="text-slate-300">Milestones.</span>
                        </h1>
                    </div>
                    <div class="hero-reveal max-w-sm pb-2">
                        <p class="text-lg text-slate-500 leading-relaxed font-light">{{ filteredProjects.length }} project{{ filteredProjects.length !== 1 ? 's' : '' }} across construction, agriculture, renewable energy, and digital infrastructure.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ PROJECTS ═══ -->
        <section class="pb-24 px-6">
            <div class="max-w-7xl mx-auto">
                <!-- Filters -->
                <div class="reveal flex items-center flex-wrap gap-2 mb-12 py-6 border-y border-slate-100">
                    <button
                        v-for="cat in categories"
                        :key="cat"
                        @click="activeCategory = cat"
                        class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 border active:scale-95"
                        :class="[activeCategory === cat
                            ? 'bg-slate-900 text-white border-slate-900 shadow-md'
                            : 'bg-white border-slate-200 text-slate-500 hover:border-slate-300 hover:text-slate-800']">
                        {{ cat }}
                        <span v-if="cat === 'All'" class="ml-1.5 text-xs opacity-60">{{ projects?.length }}</span>
                    </button>
                </div>

                <!-- Grid -->
                <TransitionGroup
                    tag="div"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                    move-class="transition duration-700 ease-in-out"
                    enter-active-class="transition duration-500 ease-out"
                    enter-from-class="opacity-0 translate-y-8 scale-95"
                    enter-to-class="opacity-100 translate-y-0 scale-100"
                    leave-active-class="transition duration-300 ease-in absolute"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-90">

                    <div v-for="(project, i) in filteredProjects" :key="project.id"
                        @click="selectedProject = project"
                        class="group relative rounded-3xl border border-slate-200 overflow-hidden cursor-pointer transition-all duration-500 hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-slate-200/60 hover:border-slate-300 bg-white">

                        <!-- Visual area — geometric, no stock photo -->
                        <div class="aspect-[16/9] relative overflow-hidden flex items-center justify-center"
                             :class="getCategoryBg(project.category)">
                            <!-- Pattern of dots/shapes -->
                            <div class="absolute inset-0 grid grid-cols-8 gap-3 p-5 opacity-20 pointer-events-none">
                                <div v-for="n in 32" :key="n"
                                     class="aspect-square rounded-full"
                                     :class="getCategoryAccent(project.category) + '/60'"
                                     :style="`opacity: ${Math.random() * 0.8 + 0.2}`"></div>
                            </div>
                            <!-- Large symbol -->
                            <div class="relative z-10 flex flex-col items-center gap-3">
                                <span class="text-6xl opacity-20 font-black select-none"
                                      :class="getCategoryAccent(project.category).replace('bg-', 'text-').replace('-500', '-600')">
                                    {{ patternSymbols[i % patternSymbols.length] }}
                                </span>
                                <span class="text-xs font-black uppercase tracking-widest px-4 py-2 rounded-xl border opacity-60"
                                      :class="`${getCategoryAccent(project.category).replace('bg-', 'border-').replace('-500', '-300')} ${getCategoryAccent(project.category).replace('bg-', 'text-').replace('-500', '-700')}`">
                                    {{ project.category }}
                                </span>
                            </div>
                            <!-- Hover overlay -->
                            <div class="absolute inset-0 bg-slate-900/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-400 backdrop-blur-sm">
                                <div class="text-white text-sm font-bold flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    View Details
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-7">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-2 h-2 rounded-full flex-shrink-0" :class="getCategoryAccent(project.category)"></div>
                                <span class="text-xs font-bold uppercase tracking-widest text-slate-400">{{ project.category }}</span>
                                <span class="ml-auto text-xs text-slate-400">{{ project.year }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-500 transition-colors leading-tight">{{ project.title }}</h3>
                            <p class="text-sm text-slate-500 line-clamp-2 leading-relaxed">{{ project.description }}</p>
                        </div>
                    </div>
                </TransitionGroup>

                <!-- Empty state -->
                <div v-if="filteredProjects.length === 0" class="py-32 text-center reveal">
                    <div class="inline-block p-12 bg-slate-50 rounded-3xl border border-slate-100">
                        <div class="text-6xl mb-6 opacity-20">◆</div>
                        <p class="text-xl font-bold text-slate-400 mb-4">No projects in this sector yet.</p>
                        <button @click="activeCategory = 'All'" class="text-primary-500 font-bold text-sm hover:underline transition-all active:scale-95">View All Projects →</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ PROJECT MODAL ═══ -->
        <TransitionRoot appear :show="!!selectedProject" as="template">
            <Dialog as="div" @close="selectedProject = null" class="relative z-[200]">
                <TransitionChild as="template" enter="duration-400 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-250 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xl" />
                </TransitionChild>
                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 md:p-8">
                        <TransitionChild as="template" enter="duration-500 cubic-bezier(0.16, 1, 0.3, 1)" enter-from="opacity-0 scale-95 translate-y-12" enter-to="opacity-100 scale-100 translate-y-0" leave="duration-300 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                            <DialogPanel v-if="selectedProject" class="w-full max-w-4xl bg-white rounded-3xl overflow-hidden shadow-2xl border border-slate-100">
                                <!-- Visual header -->
                                <div class="aspect-[21/6] relative flex items-center justify-center overflow-hidden" :class="getCategoryBg(selectedProject.category)">
                                    <div class="absolute inset-0 grid grid-cols-12 gap-3 p-8 opacity-15 pointer-events-none">
                                        <div v-for="n in 48" :key="n" class="aspect-square rounded-full" :class="getCategoryAccent(selectedProject.category)"></div>
                                    </div>
                                    <div class="relative z-10 text-center">
                                        <span class="text-8xl opacity-20 font-black select-none" :class="getCategoryAccent(selectedProject.category).replace('bg-', 'text-').replace('-500', '-600')">◆</span>
                                    </div>
                                    <button @click="selectedProject = null" class="absolute top-5 right-5 w-10 h-10 bg-white/90 hover:bg-white rounded-xl flex items-center justify-center shadow-md transition-all active:scale-90 group">
                                        <svg class="w-5 h-5 text-slate-500 group-hover:text-slate-900 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>

                                <!-- Content -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                                    <div class="md:col-span-2 p-10 md:p-12 border-b md:border-b-0 md:border-r border-slate-100">
                                        <div class="flex items-center gap-2 mb-5">
                                            <div class="w-2 h-2 rounded-full" :class="getCategoryAccent(selectedProject.category)"></div>
                                            <span class="text-xs font-bold uppercase tracking-widest text-slate-400">{{ selectedProject.category }}</span>
                                        </div>
                                        <DialogTitle as="h2" class="text-3xl md:text-5xl font-black tracking-tighter text-slate-900 mb-6 leading-[0.9]">{{ selectedProject.title }}</DialogTitle>
                                        <p class="text-slate-500 leading-relaxed text-base font-light">{{ selectedProject.content || selectedProject.description }}</p>
                                    </div>
                                    <div class="p-10 md:p-12 bg-slate-50/50 space-y-7">
                                        <div>
                                            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Client</p>
                                            <p class="text-base font-bold text-slate-900">{{ selectedProject.client_name || 'Price and Quote' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Year</p>
                                            <p class="text-base font-bold text-slate-900">{{ selectedProject.year || '2024' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Sector</p>
                                            <p class="text-base font-bold text-slate-900">{{ selectedProject.category }}</p>
                                        </div>
                                        <div class="pt-4">
                                            <Link href="/contact" @click="selectedProject = null"
                                                class="block w-full bg-slate-900 text-white py-4 rounded-2xl font-bold text-sm text-center hover:bg-primary-500 transition-all duration-300 active:scale-95">
                                                Inquire About This Project
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </MainLayout>
</template>

<style scoped>
.projects-grid { position: relative; }
</style>