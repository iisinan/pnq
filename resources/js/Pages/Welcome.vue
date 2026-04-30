<script setup>
import { onMounted, ref, computed } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import Preloader from '@/Components/Preloader.vue';
import { useGSAP } from '@/Composables/useGSAP';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    services: Array,
    featuredProjects: Array,
    settings: Object
});

const { gsap, ScrollTrigger } = useGSAP();
const heroSubtitle = ref(null);
const heroCta = ref(null);
const isLoading = ref(true);

const coreServices = computed(() => {
    const filtered = props.services.filter(s =>
        ['Agriculture', 'Constructions', 'Renewable Energy'].includes(s.title)
    );
    return filtered.length ? filtered : props.services.slice(0, 3);
});

onMounted(() => {
    const tl = gsap.timeline();
    tl.from('.char', { y: 100, opacity: 0, duration: 1, stagger: 0.02, ease: 'expo.out' })
      .from(heroSubtitle.value, { y: 20, opacity: 0, duration: 1, ease: 'power3.out' }, '-=0.5')
      .from(heroCta.value, { y: 20, opacity: 0, duration: 1, ease: 'power3.out' }, '-=0.8');

    window.addEventListener('mousemove', (e) => {
        const xPos = (e.clientX / window.innerWidth - 0.5) * 40;
        const yPos = (e.clientY / window.innerHeight - 0.5) * 40;
        gsap.to('.glow-1', { x: xPos, y: yPos, duration: 1.5, ease: 'power2.out' });
        gsap.to('.glow-2', { x: -xPos, y: -yPos, duration: 1.5, ease: 'power2.out' });
    });

    gsap.utils.toArray('.reveal').forEach((el) => {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 85%' },
            y: 50, opacity: 0, duration: 1.2, ease: 'expo.out',
        });
    });

    gsap.utils.toArray('.stat-value').forEach((el) => {
        const raw = el.innerText;
        const value = parseInt(raw.replace('+', ''));
        const hasPlus = raw.includes('+');
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 90%' },
            innerText: 0, duration: 2.5, snap: { innerText: 1 }, ease: 'expo.out',
            onUpdate() { if (hasPlus && !el.innerText.includes('+')) el.innerText += '+'; }
        });
    });
});

const stats = [
    { label: 'Successful Projects', value: '20+' },
    { label: 'Years of Excellence', value: '12' },
    { label: 'Core Sectors', value: '11' },
    { label: 'Expert Engineers', value: '15+' },
];
</script>

<template>
    <MainLayout>
        <Preloader v-if="isLoading" @loaded="isLoading = false" />

        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
            <div class="glow-1 absolute top-1/4 -left-20 w-[500px] h-[500px] bg-primary-500/15 blur-[150px] rounded-full"></div>
            <div class="glow-2 absolute bottom-1/4 -right-20 w-[500px] h-[500px] bg-secondary-500/10 blur-[150px] rounded-full"></div>

            <div class="container mx-auto px-6 relative z-10 text-center">
                <div class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-full border border-slate-200 bg-white/70 backdrop-blur-sm mb-8">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-secondary-500"></span>
                    </span>
                    <span class="text-xs font-bold tracking-widest uppercase text-primary-600">Price and Quote — Since 2014</span>
                </div>

                <h1 class="text-6xl md:text-9xl font-black tracking-tighter leading-[0.9] mb-8 overflow-hidden text-slate-900">
                    <div class="flex flex-wrap justify-center overflow-hidden">
                        <span v-for="(char, i) in (settings?.hero_title_line_1 || 'ENGINEERING').split('')" :key="'a'+i" class="char inline-block">{{ char }}</span>
                    </div>
                    <div class="flex flex-wrap justify-center overflow-hidden">
                        <span v-for="(char, i) in (settings?.hero_title_line_2 || 'EXCELLENCE').split('')" :key="'b'+i" class="char inline-block text-primary-500">{{ char }}</span>
                    </div>
                </h1>

                <p ref="heroSubtitle" class="text-xl md:text-2xl text-slate-500 max-w-2xl mx-auto mb-12 leading-relaxed font-light">
                    {{ settings?.hero_subtitle || 'Delivering mission-critical solutions in construction, agriculture, renewable energy, and digital technology across Nigeria.' }}
                </p>

                <div ref="heroCta" class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <Link href="/portfolio" class="bg-primary-500 hover:bg-primary-600 text-white px-10 py-5 rounded-2xl text-lg font-bold transition-all hover:shadow-xl hover:shadow-primary-500/25 hover:-translate-y-0.5">
                        View Portfolio
                    </Link>
                    <Link href="/services" class="bg-white hover:bg-slate-50 text-slate-900 px-10 py-5 rounded-2xl text-lg font-bold transition-all border border-slate-200 hover:border-slate-300 hover:-translate-y-0.5">
                        Our Services
                    </Link>
                </div>
            </div>

            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce opacity-40">
                <div class="w-6 h-10 border-2 border-slate-400 rounded-full flex justify-center pt-2">
                    <div class="w-1 h-2 bg-slate-400 rounded-full"></div>
                </div>
            </div>
        </section>

        <!-- Stats -->
        <section class="py-20 border-y border-slate-100 bg-slate-50/50">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                <div v-for="stat in stats" :key="stat.label" class="reveal group">
                    <div class="stat-value text-5xl md:text-6xl font-black text-slate-900 mb-2 group-hover:text-primary-500 transition-colors">{{ stat.value }}</div>
                    <div class="text-sm font-bold uppercase tracking-widest text-slate-400">{{ stat.label }}</div>
                </div>
            </div>
        </section>

        <!-- Core Competencies -->
        <section class="py-32 px-6 relative overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 space-y-8 md:space-y-0">
                    <div class="reveal">
                        <h2 class="text-sm font-bold tracking-widest uppercase text-secondary-500 mb-4">What We Do</h2>
                        <h3 class="text-4xl md:text-7xl font-black tracking-tighter text-slate-900">Core Competencies</h3>
                    </div>
                    <div class="reveal">
                        <Link href="/services" class="text-slate-500 hover:text-primary-500 flex items-center space-x-2 group font-bold">
                            <span>Explore all services</span>
                            <span class="group-hover:translate-x-2 transition-transform">→</span>
                        </Link>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div v-for="(service, i) in coreServices" :key="i" class="reveal bg-white p-12 group hover:border-primary-500/30 transition-all duration-700 border border-slate-200 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary-500/10 rounded-3xl">
                        <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-primary-500 transition-all duration-500">
                            <svg class="w-8 h-8 text-primary-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" :d="service.icon" />
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold mb-4 text-slate-900 group-hover:text-primary-500 transition-colors">{{ service.title }}</h4>
                        <p class="text-slate-500 leading-relaxed mb-6">{{ service.description }}</p>
                        <Link href="/services" class="inline-flex items-center text-sm font-bold uppercase tracking-widest text-primary-500 opacity-0 group-hover:opacity-100 transition-all duration-500">
                            Learn More <span class="ml-2">→</span>
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="py-32 px-6">
            <div class="max-w-7xl mx-auto bg-slate-900 p-12 md:p-24 rounded-3xl text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10 pointer-events-none"></div>
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/20 blur-[100px] rounded-full"></div>
                <div class="relative z-10">
                    <h2 class="text-5xl md:text-7xl font-black tracking-tighter mb-8 leading-[0.85] text-white">Ready to build the <br/> future <span class="text-primary-500">together?</span></h2>
                    <p class="text-xl text-slate-400 mb-12 max-w-2xl mx-auto font-light leading-relaxed">
                        Partner with Price and Quote for high-impact solutions that drive growth and national development.
                    </p>
                    <Link href="/contact" class="inline-block bg-primary-500 text-white px-14 py-6 rounded-2xl text-xl font-black hover:bg-primary-400 transition-all hover:shadow-2xl hover:shadow-primary-500/30 hover:-translate-y-0.5">
                        Start Your Project
                    </Link>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style scoped>
.char { display: inline-block; }
</style>
