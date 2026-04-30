<script setup>
import { onMounted, ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { useGSAP } from '@/Composables/useGSAP';
import { Link } from '@inertiajs/vue3';

const props = defineProps({ team: Array });
const { gsap } = useGSAP();
const hoveredMember = ref(null);

const milestones = [
    { year: '2014', title: 'Company Founded', desc: 'Price and Quote Limited established with a vision to deliver excellence across multiple sectors.' },
    { year: '2018', title: 'First Major Contract', desc: 'Secured the first significant engineering and consultancy contract with a federal agency.' },
    { year: '2020', title: 'Sativa Rice Mill Project', desc: 'Awarded design, monitoring and consultancy services for the Sativa Rice Mill complex.' },
    { year: '2022', title: 'Multi-Sector Expansion', desc: 'Expanded into renewable energy, precision agriculture, and large-scale civil construction.' },
    { year: '2024', title: 'Federal Housing Scheme', desc: 'Awarded the 292-unit Federal Government Resettlement Housing scheme in Kebbi State.' },
];

const avatarGradients = [
    'from-primary-400 to-primary-600',
    'from-secondary-400 to-secondary-600',
    'from-emerald-400 to-emerald-600',
    'from-violet-400 to-violet-600',
    'from-amber-400 to-amber-600',
    'from-sky-400 to-sky-600',
    'from-rose-400 to-rose-600',
    'from-teal-400 to-teal-600',
];

onMounted(() => {
    gsap.from('.hero-reveal', { y: 70, opacity: 0, duration: 1.4, stagger: 0.15, ease: 'expo.out' });
    gsap.utils.toArray('.reveal').forEach((el) => {
        gsap.from(el, { scrollTrigger: { trigger: el, start: 'top 88%' }, y: 50, opacity: 0, duration: 1.2, ease: 'expo.out' });
    });
    gsap.utils.toArray('.team-card').forEach((el, i) => {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 92%' },
            y: 40, opacity: 0, duration: 0.9, delay: (i % 4) * 0.1, ease: 'power3.out'
        });
    });
    gsap.utils.toArray('.milestone-item').forEach((el, i) => {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 90%' },
            x: i % 2 === 0 ? -40 : 40, opacity: 0, duration: 1, ease: 'expo.out'
        });
    });
});
</script>

<template>
    <MainLayout>
        <!-- ═══ HERO ═══ -->
        <section class="relative pt-40 pb-24 px-6 overflow-hidden bg-white">
            <div class="absolute inset-0 pointer-events-none"
                 style="background-image: linear-gradient(rgba(58,190,249,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(58,190,249,0.05) 1px, transparent 1px); background-size: 60px 60px;"></div>
            <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[700px] h-[300px] bg-primary-400/8 rounded-full blur-[100px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto relative z-10 text-center">
                <div class="hero-reveal inline-flex items-center gap-2 text-xs font-bold tracking-[0.18em] uppercase text-primary-500 mb-8">
                    <span class="w-8 h-px bg-primary-500"></span>
                    Our People
                    <span class="w-8 h-px bg-primary-500"></span>
                </div>
                <h1 class="hero-reveal text-4xl sm:text-6xl md:text-8xl font-black tracking-tighter leading-[0.88] text-slate-900 mb-6">
                    The Minds Behind<br/><span class="text-slate-300">The Mission.</span>
                </h1>
                <p class="hero-reveal text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed font-light">
                    A dedicated team of engineers, strategists, and innovators committed to delivering national impact.
                </p>
            </div>
        </section>

        <!-- ═══ TEAM GRID ═══ -->
        <section class="py-16 px-6 border-y border-slate-100 bg-slate-50/30">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    <div v-for="(member, i) in team" :key="member.id"
                        @mouseenter="hoveredMember = member.id"
                        @mouseleave="hoveredMember = null"
                        class="team-card group bg-white rounded-3xl border border-slate-200 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-slate-200/70 hover:-translate-y-1 hover:border-slate-300">
                        <!-- Avatar header -->
                        <div class="aspect-square relative flex items-center justify-center overflow-hidden"
                             :class="`bg-gradient-to-br ${avatarGradients[i % avatarGradients.length]}`">
                            <!-- Background pattern -->
                            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 1px); background-size: 20px 20px;"></div>
                            <!-- Initials -->
                            <span class="relative z-10 text-4xl md:text-5xl font-black text-white/90 tracking-tighter select-none">
                                {{ member.name.split(' ').map(n => n[0]).join('').slice(0, 2) }}
                            </span>
                            <!-- Hover overlay -->
                            <div class="absolute inset-0 bg-slate-900/70 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-400 backdrop-blur-sm px-5 text-center">
                                <p class="text-white text-xs leading-relaxed font-light">{{ member.bio }}</p>
                            </div>
                        </div>
                        <!-- Info -->
                        <div class="p-6">
                            <h3 class="text-base font-bold text-slate-900 group-hover:text-primary-500 transition-colors leading-tight">{{ member.name }}</h3>
                            <p class="text-xs font-bold uppercase tracking-widest text-primary-500 mt-1">{{ member.role }}</p>
                        </div>
                    </div>
                </div>

                <!-- Empty state -->
                <div v-if="!team || team.length === 0" class="text-center py-24">
                    <div class="text-6xl mb-6 opacity-20 select-none">◆</div>
                    <p class="text-slate-400 font-bold">Team data loading...</p>
                </div>
            </div>
        </section>

        <!-- ═══ TIMELINE ═══ -->
        <section class="py-32 px-6">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-20 reveal">
                    <p class="text-xs font-bold tracking-[0.2em] uppercase text-primary-500 mb-4">Our Journey</p>
                    <h2 class="text-4xl md:text-7xl font-black tracking-tighter text-slate-900 leading-[0.9]">A Decade<br/><span class="text-slate-300">of Impact</span></h2>
                </div>

                <div class="relative">
                    <!-- Center line (desktop) -->
                    <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-primary-500/30 via-primary-500/60 to-primary-500/30 -translate-x-px"></div>
                    <!-- Left line (mobile) -->
                    <div class="md:hidden absolute left-6 top-0 bottom-0 w-px bg-gradient-to-b from-primary-500/30 via-primary-500/60 to-primary-500/30"></div>

                    <div class="space-y-12">
                        <div v-for="(milestone, i) in milestones" :key="i"
                            class="milestone-item relative flex items-start gap-8 md:gap-0"
                            :class="[i % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse']">

                            <!-- Mobile dot -->
                            <div class="md:hidden w-12 flex-shrink-0 flex justify-center pt-4">
                                <div class="w-3 h-3 bg-primary-500 rounded-full ring-4 ring-primary-100 relative z-10"></div>
                            </div>

                            <!-- Desktop dot -->
                            <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 top-6 z-10">
                                <div class="w-4 h-4 bg-primary-500 rounded-full ring-4 ring-white ring-offset-0 shadow-md shadow-primary-500/30"></div>
                            </div>

                            <!-- Card -->
                            <div class="flex-1 md:w-1/2"
                                 :class="[i % 2 === 0 ? 'md:pr-14 md:text-right' : 'md:pl-14']">
                                <div class="bg-white rounded-3xl border border-slate-200 p-8 hover:border-primary-200 hover:shadow-lg hover:shadow-primary-500/5 transition-all duration-400 group">
                                    <div class="inline-flex items-center gap-2 mb-4" :class="i % 2 === 0 ? 'md:flex-row-reverse' : ''">
                                        <span class="text-2xl font-black text-primary-500">{{ milestone.year }}</span>
                                        <span class="w-6 h-px bg-primary-500/40"></span>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-primary-500 transition-colors">{{ milestone.title }}</h3>
                                    <p class="text-sm text-slate-500 leading-relaxed">{{ milestone.desc }}</p>
                                </div>
                            </div>

                            <!-- Spacer -->
                            <div class="hidden md:block md:w-1/2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ JOIN CTA ═══ -->
        <section class="py-24 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="reveal relative overflow-hidden rounded-3xl bg-slate-900 p-14 md:p-24 text-center">
                    <div class="absolute top-8 right-8 w-32 h-32 border border-white/5 rounded-2xl rotate-12 pointer-events-none"></div>
                    <div class="absolute bottom-8 left-8 w-24 h-24 border border-white/5 rounded-xl -rotate-12 pointer-events-none"></div>
                    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-900 to-primary-950/50 pointer-events-none"></div>
                    <div class="relative z-10">
                        <p class="text-xs font-bold tracking-[0.2em] uppercase text-primary-400 mb-6">Join The Team</p>
                        <h2 class="text-4xl md:text-6xl font-black text-white tracking-tighter mb-6 leading-[0.9]">
                            Exceptional talent<br/>for an <span class="text-primary-500">exceptional mission.</span>
                        </h2>
                        <p class="text-lg text-slate-400 mb-12 max-w-xl mx-auto font-light leading-relaxed">
                            We're always looking for outstanding engineers, strategists, and innovators to help shape the future.
                        </p>
                        <a href="mailto:info@priceandquote.com"
                            class="group relative overflow-hidden inline-block bg-primary-500 text-white px-12 py-5 rounded-2xl text-base font-black transition-all duration-300 hover:shadow-2xl hover:shadow-primary-500/40 hover:-translate-y-0.5 active:scale-95">
                            <span class="relative z-10">Get In Touch</span>
                            <span class="absolute inset-0 bg-primary-400 scale-x-0 origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>