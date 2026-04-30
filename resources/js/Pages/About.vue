<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { useGSAP } from '@/Composables/useGSAP';
import { onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    team: Array,
    certifications: Array,
    settings: Object,
});

const { gsap } = useGSAP();

const stats = [
    { label: 'Founded', value: '2014', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' },
    { label: 'Engineers', value: '15+', icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z' },
    { label: 'Sectors', value: '11', icon: 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064' },
    { label: 'Projects', value: '20+', icon: 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z' },
];

const certs = [
    { title: 'CAC Nigeria', description: 'Corporate Affairs Commission Registered Entity', icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' },
    { title: 'FIRS Compliant', description: 'Federal Inland Revenue Service Tax Compliant', icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4' },
    { title: 'ITF Certified', description: 'Industrial Training Fund Accredited Partner', icon: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253' },
    { title: 'BPP Registered', description: 'Bureau of Public Procurement Certified', icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' },
    { title: 'NSITF', description: 'Nigeria Social Insurance Trust Fund Compliant', icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z' },
    { title: 'ISO 27001', description: 'International Information Security Standard', icon: 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z' },
];

const avatarColors = [
    { bg: 'bg-primary-100', text: 'text-primary-600', ring: 'ring-primary-200' },
    { bg: 'bg-secondary-100', text: 'text-secondary-600', ring: 'ring-secondary-200' },
    { bg: 'bg-emerald-100', text: 'text-emerald-600', ring: 'ring-emerald-200' },
    { bg: 'bg-violet-100', text: 'text-violet-600', ring: 'ring-violet-200' },
    { bg: 'bg-amber-100', text: 'text-amber-600', ring: 'ring-amber-200' },
    { bg: 'bg-sky-100', text: 'text-sky-600', ring: 'ring-sky-200' },
];

onMounted(() => {
    gsap.from('.hero-reveal', { y: 80, opacity: 0, duration: 1.4, stagger: 0.15, ease: 'expo.out' });
    gsap.utils.toArray('.reveal').forEach((el) => {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 88%' },
            y: 50, opacity: 0, duration: 1.2, ease: 'expo.out',
        });
    });
    gsap.utils.toArray('.cert-card').forEach((el, i) => {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 90%' },
            y: 40, opacity: 0, duration: 0.9, delay: (i % 3) * 0.1, ease: 'power3.out',
        });
    });
    gsap.utils.toArray('.team-card').forEach((el, i) => {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 90%' },
            y: 50, opacity: 0, duration: 1, delay: (i % 3) * 0.12, ease: 'power3.out',
        });
    });
});
</script>

<template>
    <MainLayout>
        <!-- ═══ HERO ═══ -->
        <section class="relative pt-40 pb-28 px-6 overflow-hidden bg-white">
            <!-- Grid -->
            <div class="absolute inset-0 pointer-events-none"
                 style="background-image: linear-gradient(rgba(58,190,249,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(58,190,249,0.05) 1px, transparent 1px); background-size: 60px 60px;"></div>

            <!-- Blob -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-400/10 rounded-full blur-[120px] pointer-events-none translate-x-1/3 -translate-y-1/3"></div>

            <div class="max-w-7xl mx-auto relative z-10">
                <div class="max-w-4xl">
                    <div class="hero-reveal inline-flex items-center gap-2 text-xs font-bold tracking-[0.18em] uppercase text-secondary-500 mb-8">
                        <span class="w-8 h-px bg-secondary-500"></span>
                        Who We Are
                    </div>
                    <h1 class="hero-reveal text-4xl sm:text-6xl md:text-8xl font-black tracking-tighter leading-[0.88] text-slate-900 mb-8">
                        Engineering<br/>
                        <span class="text-primary-500">The Future.</span>
                    </h1>
                    <p class="hero-reveal text-xl text-slate-500 max-w-2xl leading-relaxed font-light">
                        {{ settings?.about_hero_subtitle || 'A premier multidisciplinary firm specializing in construction, agriculture, renewable energy, IT consultancy, and strategic infrastructure development since 2014.' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- ═══ STATS ROW ═══ -->
        <section class="px-6 py-0">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-px bg-slate-100 border border-slate-100 rounded-3xl overflow-hidden -mt-6 relative z-20 shadow-xl shadow-slate-100/80">
                    <div v-for="stat in stats" :key="stat.label"
                        class="reveal group bg-white px-8 py-10 flex items-center gap-5 hover:bg-primary-500 transition-all duration-500">
                        <div class="w-12 h-12 rounded-xl bg-primary-50 group-hover:bg-white/20 flex items-center justify-center flex-shrink-0 transition-all duration-500">
                            <svg class="w-5 h-5 text-primary-500 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" :d="stat.icon" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-3xl font-black text-slate-900 group-hover:text-white transition-colors duration-500">{{ stat.value }}</div>
                            <div class="text-xs font-bold uppercase tracking-widest text-slate-400 group-hover:text-white/70 transition-colors duration-500">{{ stat.label }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ MISSION ═══ -->
        <section class="py-32 px-6">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="reveal">
                    <div class="w-10 h-1 bg-primary-500 mb-8 rounded-full"></div>
                    <h2 class="text-4xl md:text-6xl font-black tracking-tighter text-slate-900 mb-8 leading-[0.9]">
                        {{ settings?.about_mission_title || 'Our Mission & Vision.' }}
                    </h2>
                    <p class="text-lg text-slate-600 leading-relaxed mb-5 font-light">
                        {{ settings?.about_mission_desc_1 || 'At Price and Quote, our mission is to empower organizations through innovative engineering, strategic consultancy, and sustainable infrastructure. Founded in 2014, we have grown into a trusted partner for government agencies and private enterprises alike.' }}
                    </p>
                    <p class="text-lg text-slate-600 leading-relaxed font-light">
                        {{ settings?.about_mission_desc_2 || 'We deliver solutions that are technologically advanced, environmentally conscious, and socially impactful.' }}
                    </p>
                    <div class="mt-10">
                        <Link href="/contact"
                            class="group inline-flex items-center gap-3 bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold text-sm transition-all duration-300 hover:bg-primary-500 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary-500/20 active:scale-95">
                            Work With Us
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </Link>
                    </div>
                </div>

                <!-- Visual block -->
                <div class="reveal">
                    <div class="relative aspect-square max-w-md mx-auto lg:mx-0">
                        <!-- Background pattern -->
                        <div class="absolute inset-0 rounded-3xl"
                             style="background-image: linear-gradient(rgba(58,190,249,0.08) 1px, transparent 1px), linear-gradient(90deg, rgba(58,190,249,0.08) 1px, transparent 1px); background-size: 30px 30px; border: 1px solid rgb(241,245,249); border-radius: 24px;"></div>
                        <!-- Floating elements -->
                        <div class="absolute top-8 left-8 right-8 bottom-8 bg-white rounded-2xl border border-slate-100 shadow-xl flex flex-col items-center justify-center gap-8 p-10">
                            <div class="text-center">
                                <div class="text-6xl font-black text-slate-900 tracking-tighter">12+</div>
                                <div class="text-sm font-bold uppercase tracking-widest text-slate-400 mt-1">Years of Excellence</div>
                            </div>
                            <div class="w-full h-px bg-slate-100"></div>
                            <div class="grid grid-cols-2 gap-6 w-full text-center">
                                <div>
                                    <div class="text-3xl font-black text-primary-500">20+</div>
                                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Projects</div>
                                </div>
                                <div>
                                    <div class="text-3xl font-black text-secondary-500">11</div>
                                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Sectors</div>
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="flex items-center justify-between text-xs font-bold text-slate-400 mb-2">
                                    <span>Project Success Rate</span><span class="text-primary-500">98%</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-primary-500 to-primary-400 rounded-full" style="width: 98%"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Decorative dots -->
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-primary-500 rounded-xl rotate-12"></div>
                        <div class="absolute -bottom-4 -left-4 w-6 h-6 bg-secondary-500 rounded-lg -rotate-12"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ CERTIFICATIONS ═══ -->
        <section class="py-24 px-6 bg-slate-50/70 border-y border-slate-100">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16 reveal">
                    <p class="text-xs font-bold tracking-[0.2em] uppercase text-secondary-500 mb-4">Trusted & Verified</p>
                    <h2 class="text-4xl md:text-6xl font-black tracking-tighter text-slate-900 leading-[0.9]">Compliance<br/><span class="text-slate-300">Excellence</span></h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    <div v-for="(cert, i) in (certifications?.length ? certifications : certs)" :key="cert.title || cert.id"
                        class="cert-card group bg-white rounded-2xl border border-slate-200 p-8 flex items-start gap-5 hover:border-primary-300 hover:shadow-lg hover:shadow-primary-500/5 transition-all duration-400 hover:-translate-y-0.5">
                        <div class="w-12 h-12 bg-primary-50 group-hover:bg-primary-500 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-500">
                            <svg class="w-5 h-5 text-primary-500 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" :d="cert.icon || 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 mb-1 group-hover:text-primary-500 transition-colors">{{ cert.title }}</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">{{ cert.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ LEADERSHIP TEAM ═══ -->
        <section class="py-32 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6 reveal">
                    <div>
                        <p class="text-xs font-bold tracking-[0.2em] uppercase text-primary-500 mb-4">The Brains Behind the Mission</p>
                        <h2 class="text-4xl md:text-6xl font-black tracking-tighter text-slate-900 leading-[0.9]">Leadership<br/><span class="text-slate-300">Team</span></h2>
                    </div>
                    <Link href="/team" class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-primary-500 transition-colors">
                        Full Team
                        <span class="w-6 h-6 rounded-full border border-current flex items-center justify-center group-hover:bg-primary-500 group-hover:border-primary-500 group-hover:text-white transition-all">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </Link>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="(member, i) in (team || []).slice(0, 3)" :key="member.id"
                        class="team-card group relative bg-white rounded-3xl border border-slate-200 p-8 hover:border-primary-200 hover:shadow-xl hover:shadow-primary-500/5 transition-all duration-500 hover:-translate-y-1 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 rounded-full blur-2xl pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-700"
                             :class="avatarColors[i % avatarColors.length].bg.replace('100', '50')"></div>
                        <div class="relative">
                            <!-- Avatar -->
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 text-xl font-black ring-4 ring-offset-2 transition-all duration-500"
                                 :class="[avatarColors[i % avatarColors.length].bg, avatarColors[i % avatarColors.length].text, avatarColors[i % avatarColors.length].ring]">
                                {{ member.name.split(' ').map(n => n[0]).join('').slice(0, 2) }}
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-1 group-hover:text-primary-500 transition-colors">{{ member.name }}</h3>
                            <p class="text-xs font-bold uppercase tracking-widest text-primary-500 mb-4">{{ member.role }}</p>
                            <p class="text-sm text-slate-500 leading-relaxed line-clamp-3">{{ member.bio }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>