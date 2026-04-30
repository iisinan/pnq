<script setup>
import { onMounted, ref, computed } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import Preloader from '@/Components/Preloader.vue';
import { useGSAP } from '@/Composables/useGSAP';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    services: Array,
    featuredProjects: Array,
    settings: Object,
    testimonials: Array,
});

const { gsap, ScrollTrigger } = useGSAP();
const isLoading = ref(true);
const activeService = ref(0);

const coreServices = computed(() => {
    const filtered = props.services.filter(s =>
        ['Agriculture', 'Constructions', 'Renewable Energy'].includes(s.title)
    );
    return filtered.length ? filtered : props.services.slice(0, 3);
});

const getServiceImage = (slug) => {
    const images = {
        'constructions': 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=800&auto=format&fit=crop',
        'agriculture': '/images/agriculture.png',
        'renewable-energy': '/images/renewable.png',
        'it-consultancy': 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=800&auto=format&fit=crop',
        'software-development': 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=800&auto=format&fit=crop',
    };
    return images[slug] || 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop';
};

const stats = [
    { label: 'Projects Delivered', value: 20, suffix: '+' },
    { label: 'Years of Experience', value: 12, suffix: '' },
    { label: 'Sectors Covered', value: 11, suffix: '' },
    { label: 'Expert Engineers', value: 15, suffix: '+' },
];

const sectors = ['Construction', 'Agriculture', 'Renewable Energy', 'IT Consultancy', 'Software Dev', 'Cybersecurity', 'Cloud & DevOps', 'Data & AI', 'Healthcare', 'Oil & Gas', 'E-Governance'];

onMounted(() => {
    // Hero entrance
    const tl = gsap.timeline({ delay: 0.2 });
    tl.from('.hero-badge', { y: 30, opacity: 0, duration: 0.8, ease: 'expo.out' })
      .from('.hero-line-1', { y: 100, opacity: 0, duration: 1, ease: 'expo.out' }, '-=0.4')
      .from('.hero-line-2', { y: 100, opacity: 0, duration: 1, ease: 'expo.out' }, '-=0.7')
      .from('.hero-sub', { y: 30, opacity: 0, duration: 0.9, ease: 'power3.out' }, '-=0.5')
      .from('.hero-cta', { y: 30, opacity: 0, duration: 0.9, ease: 'power3.out' }, '-=0.6')
      .from('.hero-scroll', { opacity: 0, duration: 0.8 }, '-=0.3');

    // Floating shapes
    gsap.to('.shape-1', { y: -30, duration: 4, repeat: -1, yoyo: true, ease: 'sine.inOut' });
    gsap.to('.shape-2', { y: 20, x: -15, duration: 5.5, repeat: -1, yoyo: true, ease: 'sine.inOut' });
    gsap.to('.shape-3', { y: -20, x: 10, duration: 3.5, repeat: -1, yoyo: true, ease: 'sine.inOut' });

    // Mouse parallax
    window.addEventListener('mousemove', (e) => {
        const xPos = (e.clientX / window.innerWidth - 0.5) * 30;
        const yPos = (e.clientY / window.innerHeight - 0.5) * 30;
        gsap.to('.parallax-slow', { x: xPos * 0.5, y: yPos * 0.5, duration: 1.5, ease: 'power2.out' });
        gsap.to('.parallax-fast', { x: xPos * 1.2, y: yPos * 1.2, duration: 1.5, ease: 'power2.out' });
    });

    // Scroll reveals
    gsap.utils.toArray('.reveal').forEach((el) => {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 88%' },
            y: 60, opacity: 0, duration: 1.2, ease: 'expo.out',
        });
    });

    gsap.utils.toArray('.testimonial-card').forEach((el, i) => {
        gsap.from(el, {
            scrollTrigger: { trigger: '.testimonials-grid', start: 'top 85%' },
            y: 50, opacity: 0, duration: 1, delay: i * 0.15, ease: 'power3.out',
        });
    });

    // Stat counters
    gsap.utils.toArray('.stat-num').forEach((el, i) => {
        const target = stats[i];
        let counter = { val: 0 };
        gsap.to(counter, {
            scrollTrigger: { trigger: el, start: 'top 90%' },
            val: target.value,
            duration: 2.5,
            ease: 'expo.out',
            onUpdate() {
                el.innerText = Math.round(counter.val) + target.suffix;
            }
        });
    });

    // Marquee
    const marqueeTrack = document.querySelector('.marquee-track');
    if (marqueeTrack) {
        const clone = marqueeTrack.innerHTML;
        marqueeTrack.innerHTML += clone;
        gsap.to(marqueeTrack, { x: '-50%', duration: 25, ease: 'none', repeat: -1 });
    }
});
</script>

<template>
    <MainLayout>
        <Preloader v-if="isLoading" @loaded="isLoading = false" />

        <!-- ═══ HERO ═══ -->
        <section class="relative min-h-screen flex items-center justify-center pt-24 overflow-hidden bg-white">
            <!-- Grid pattern -->
            <div class="absolute inset-0 pointer-events-none"
                style="background-image: linear-gradient(rgba(58,190,249,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(58,190,249,0.06) 1px, transparent 1px); background-size: 60px 60px;">
            </div>

            <!-- Floating geometric shapes -->
            <div class="parallax-slow absolute inset-0 pointer-events-none overflow-hidden">
                <div class="shape-1 absolute top-1/4 right-16 w-24 h-24 border-2 border-primary-300/40 rounded-3xl rotate-12"></div>
                <div class="shape-2 absolute top-1/3 left-10 w-16 h-16 bg-secondary-500/10 rounded-2xl -rotate-12"></div>
                <div class="shape-3 absolute bottom-1/3 right-1/4 w-10 h-10 border-2 border-primary-400/30 rounded-full"></div>
                <div class="shape-1 absolute bottom-1/4 left-1/4 w-6 h-6 bg-primary-400/20 rounded-full"></div>
            </div>
            <div class="parallax-fast absolute inset-0 pointer-events-none overflow-hidden">
                <div class="shape-2 absolute top-16 left-1/3 w-3 h-3 bg-secondary-500/40 rounded-full"></div>
                <div class="shape-3 absolute bottom-20 right-1/3 w-5 h-5 border-2 border-primary-400/40 rotate-45"></div>
            </div>

            <!-- Glow blobs -->
            <div class="absolute top-1/3 left-1/4 w-[500px] h-[500px] bg-primary-400/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-1/3 right-1/4 w-[400px] h-[400px] bg-secondary-500/8 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="container mx-auto px-6 relative z-10 text-center">
                <!-- Badge -->
                <div class="hero-badge inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full border border-slate-200 bg-white/80 backdrop-blur-sm mb-10 shadow-sm">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-secondary-500"></span>
                    </span>
                    <span class="text-xs font-bold tracking-[0.18em] uppercase text-slate-500">{{ settings?.company_name || 'Price and Quote Ltd' }} — Est. 2014</span>
                </div>

                <!-- Title -->
                <div class="overflow-hidden mb-4">
                    <h1 class="hero-line-1 text-4xl sm:text-6xl md:text-8xl lg:text-[10rem] font-black tracking-tighter leading-[0.88] text-slate-900">
                        {{ settings?.hero_title_line_1 || 'Engineering' }}
                    </h1>
                </div>
                <div class="overflow-hidden mb-10">
                    <h1 class="hero-line-2 text-4xl sm:text-6xl md:text-8xl lg:text-[10rem] font-black tracking-tighter leading-[0.88] text-primary-500">
                        {{ settings?.hero_title_line_2 || 'Excellence.' }}
                    </h1>
                </div>

                <!-- Subtitle -->
                <p class="hero-sub text-lg md:text-xl text-slate-500 max-w-2xl mx-auto mb-12 leading-relaxed font-light">
                    {{ settings?.hero_subtitle || 'Delivering mission-critical solutions in construction, agriculture, renewable energy, and digital technology across Nigeria.' }}
                </p>

                <!-- CTAs -->
                <div class="hero-cta flex flex-col sm:flex-row items-center justify-center gap-4">
                    <Link href="/portfolio"
                        class="group relative overflow-hidden bg-primary-500 text-white px-10 py-4 rounded-2xl font-bold text-base transition-all duration-300 hover:shadow-2xl hover:shadow-primary-500/30 hover:-translate-y-0.5 active:scale-95">
                        <span class="relative z-10">View Our Work</span>
                        <span class="absolute inset-0 bg-primary-600 scale-x-0 origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
                    </Link>
                    <Link href="/contact"
                        class="group flex items-center gap-2 bg-white border border-slate-200 text-slate-800 px-10 py-4 rounded-2xl font-bold text-base transition-all duration-300 hover:border-primary-300 hover:shadow-lg hover:-translate-y-0.5 active:scale-95">
                        Get a Quote
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </Link>
                </div>
            </div>

            <!-- Scroll indicator -->
            <div class="hero-scroll absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-40">
                <span class="text-[10px] uppercase tracking-widest font-bold text-slate-400">Scroll</span>
                <div class="w-px h-10 bg-gradient-to-b from-slate-400 to-transparent animate-pulse"></div>
            </div>
        </section>

        <!-- ═══ MARQUEE ═══ -->
        <div class="border-y border-slate-100 bg-slate-50/50 py-5 overflow-hidden">
            <div class="marquee-track flex items-center whitespace-nowrap">
                <span v-for="sector in sectors" :key="sector"
                    class="inline-flex items-center gap-6 px-8 text-sm font-bold uppercase tracking-widest text-slate-400 hover:text-primary-500 transition-colors cursor-default">
                    <span class="w-1.5 h-1.5 bg-primary-400 rounded-full flex-shrink-0"></span>
                    {{ sector }}
                </span>
            </div>
        </div>

        <!-- ═══ STATS ═══ -->
        <section class="py-24 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-px bg-slate-100 rounded-3xl overflow-hidden border border-slate-100">
                    <div v-for="(stat, i) in stats" :key="stat.label"
                        class="reveal group bg-white px-10 py-12 text-center hover:bg-primary-50/60 transition-colors duration-500">
                        <div class="stat-num text-5xl md:text-6xl font-black text-slate-900 mb-2 group-hover:text-primary-500 transition-colors duration-500 tabular-nums">{{ stat.value }}{{ stat.suffix }}</div>
                        <div class="text-xs font-bold uppercase tracking-widest text-slate-400">{{ stat.label }}</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ CORE COMPETENCIES ═══ -->
        <section class="py-24 px-6 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-[600px] h-[600px] bg-primary-400/5 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-6">
                    <div class="reveal">
                        <p class="text-xs font-bold tracking-[0.2em] uppercase text-secondary-500 mb-4">What We Do</p>
                        <h2 class="text-4xl md:text-7xl font-black tracking-tighter text-slate-900 leading-[0.9]">Core<br/><span class="text-slate-300">Competencies</span></h2>
                    </div>
                    <div class="reveal">
                        <Link href="/services"
                            class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-primary-500 transition-colors">
                            All Services
                            <span class="w-6 h-6 rounded-full border border-current flex items-center justify-center group-hover:bg-primary-500 group-hover:border-primary-500 group-hover:text-white transition-all">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </Link>
                    </div>
                </div>

                <!-- Service cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div v-for="(service, i) in coreServices" :key="i"
                        @mouseenter="activeService = i"
                        class="reveal group relative overflow-hidden rounded-3xl border border-slate-200 cursor-default transition-all duration-500 flex flex-col"
                        :class="[activeService === i ? 'bg-slate-900 border-slate-900 shadow-2xl shadow-slate-900/20' : 'bg-white hover:border-primary-200']">

                        <!-- Image -->
                        <div class="h-48 overflow-hidden relative flex-shrink-0">
                            <img :src="getServiceImage(service.slug)" :alt="service.title" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            <div class="absolute inset-0 bg-slate-900/20 transition-colors duration-500"
                                 :class="activeService === i ? 'bg-slate-900/60 mix-blend-multiply' : ''"></div>
                        </div>

                        <!-- Content wrapper -->
                        <div class="p-10 relative flex-grow flex flex-col">
                            <!-- Background glow on active -->
                            <div class="absolute top-0 right-0 w-40 h-40 rounded-full blur-3xl transition-all duration-700 pointer-events-none"
                                 :class="activeService === i ? 'bg-primary-500/20 opacity-100' : 'opacity-0'"></div>
    
                            <!-- Icon -->
                        <div class="relative w-14 h-14 mb-8 rounded-2xl flex items-center justify-center transition-all duration-500"
                             :class="activeService === i ? 'bg-primary-500' : 'bg-primary-50'">
                            <svg class="w-7 h-7 transition-colors duration-500"
                                 :class="activeService === i ? 'text-white' : 'text-primary-500'"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" :d="service.icon" />
                            </svg>
                        </div>

                        <!-- Number -->
                        <div class="text-xs font-black tracking-widest mb-4 transition-colors duration-500"
                             :class="activeService === i ? 'text-primary-400' : 'text-slate-300'">0{{ i + 1 }}</div>

                            <!-- Content -->
                            <h3 class="text-2xl font-bold mb-3 tracking-tight transition-colors duration-500"
                                :class="activeService === i ? 'text-white' : 'text-slate-900'">{{ service.title }}</h3>
                            <p class="text-sm leading-relaxed transition-colors duration-500 flex-grow"
                               :class="activeService === i ? 'text-slate-400' : 'text-slate-500'">{{ service.description }}</p>
    
                            <!-- Arrow -->
                            <div class="mt-8 flex items-center gap-2 text-xs font-bold uppercase tracking-widest transition-all duration-500"
                                 :class="activeService === i ? 'text-primary-400 translate-x-0 opacity-100' : 'text-transparent -translate-x-2 opacity-0'">
                                Explore
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ TESTIMONIALS ═══ -->
        <section class="py-24 px-6 bg-slate-50/50 border-t border-slate-100" v-if="testimonials && testimonials.length > 0">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16 reveal">
                    <p class="text-xs font-bold tracking-[0.2em] uppercase text-primary-500 mb-4">Client Feedback</p>
                    <h2 class="text-4xl md:text-6xl font-black tracking-tighter text-slate-900 leading-[0.9]">
                        What Our<br/><span class="text-slate-300">Clients Say</span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 testimonials-grid">
                    <div v-for="(testimonial, i) in testimonials.slice(0, 5)" :key="testimonial.id || i" 
                        class="testimonial-card bg-white p-10 rounded-3xl border border-slate-200 hover:border-primary-300 hover:shadow-xl transition-all duration-500 flex flex-col h-full">
                        
                        <div class="flex items-center gap-1 mb-6 text-amber-400">
                            <svg v-for="n in testimonial.rating || 5" :key="n" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </div>
                        
                        <p class="text-slate-600 leading-relaxed font-light italic flex-grow mb-8">
                            "{{ testimonial.content }}"
                        </p>
                        
                        <div class="flex items-center gap-4 mt-auto">
                            <div class="w-12 h-12 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-lg flex-shrink-0">
                                {{ testimonial.client_name.charAt(0) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">{{ testimonial.client_name }}</h4>
                                <p class="text-xs text-slate-500">{{ testimonial.client_position }}, <span class="text-primary-600 font-medium">{{ testimonial.client_company }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ CTA ═══ -->
        <section class="py-24 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="reveal relative overflow-hidden rounded-3xl bg-slate-900 p-14 md:p-24">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
                        <div class="absolute top-8 right-8 w-48 h-48 border border-white/5 rounded-3xl rotate-12"></div>
                        <div class="absolute bottom-8 left-8 w-32 h-32 border border-white/5 rounded-2xl -rotate-12"></div>
                        <div class="absolute top-1/2 right-16 w-6 h-6 bg-primary-500/30 rounded-full blur-sm"></div>
                        <div class="absolute top-8 left-1/3 w-3 h-3 bg-secondary-500/40 rounded-full"></div>
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-900 to-primary-950/50"></div>
                    </div>
                    <div class="relative z-10 text-center">
                        <p class="text-xs font-bold tracking-[0.2em] uppercase text-primary-400 mb-6">Partner With Us</p>
                        <h2 class="text-4xl md:text-7xl font-black tracking-tighter text-white mb-6 leading-[0.9]">
                            Ready to build<br/>the future <span class="text-primary-500">together?</span>
                        </h2>
                        <p class="text-lg text-slate-400 mb-12 max-w-xl mx-auto leading-relaxed font-light">
                            High-impact solutions across construction, agriculture, energy, and digital infrastructure.
                        </p>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            <Link href="/contact"
                                class="group relative overflow-hidden bg-primary-500 text-white px-12 py-5 rounded-2xl text-base font-black transition-all duration-300 hover:shadow-2xl hover:shadow-primary-500/40 hover:-translate-y-0.5 active:scale-95">
                                <span class="relative z-10">Start Your Project</span>
                                <span class="absolute inset-0 bg-primary-400 scale-x-0 origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
                            </Link>
                            <Link href="/about"
                                class="text-slate-400 hover:text-white transition-colors text-sm font-bold flex items-center gap-2">
                                Learn about us
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style scoped>
.marquee-track { will-change: transform; }
</style>
