<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { useGSAP } from '@/Composables/useGSAP';
import { onMounted } from 'vue';

defineProps({
    team: Array,
    certifications: Array,
    settings: Object
});

const { gsap } = useGSAP();

onMounted(() => {
    gsap.from('.hero-reveal', { y: 80, opacity: 0, duration: 1.5, stagger: 0.2, ease: 'expo.out' });

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
</script>

<template>
    <MainLayout>
        <!-- Hero -->
        <section class="pt-48 pb-32 px-6 relative overflow-hidden">
            <div class="absolute top-20 right-0 w-[600px] h-[600px] bg-primary-500/10 blur-[150px] rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-secondary-500/5 blur-[120px] rounded-full"></div>

            <div class="max-w-7xl mx-auto text-center relative z-10">
                <h2 class="text-secondary-500 font-bold tracking-widest uppercase mb-6 hero-reveal">Who We Are</h2>
                <h1 class="text-6xl md:text-9xl font-black tracking-tighter leading-[0.85] mb-12 text-slate-900 hero-reveal">
                    Engineering <br/> <span class="text-primary-500">The Future</span>
                </h1>
                <p class="text-xl md:text-2xl text-slate-500 max-w-3xl mx-auto leading-relaxed font-light hero-reveal">
                    {{ settings?.about_hero_subtitle || 'Price and Quote is a premier multidisciplinary firm specializing in construction, agriculture, renewable energy, IT consultancy, and strategic infrastructure development.' }}
                </p>
            </div>
        </section>

        <!-- Mission & Stats -->
        <section class="py-32 px-6 border-t border-slate-100">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-32 items-center">
                <div class="reveal">
                    <div class="w-16 h-1 bg-primary-500 mb-10"></div>
                    <h3 class="text-4xl md:text-6xl font-black mb-10 tracking-tighter text-slate-900">{{ settings?.about_mission_title || 'Our Mission & Vision.' }}</h3>
                    <p class="text-lg text-slate-600 leading-relaxed mb-6">
                        {{ settings?.about_mission_desc_1 || 'At Price and Quote, our mission is to empower organizations through innovative engineering, strategic consultancy, and sustainable infrastructure. Founded in 2014, we have grown into a trusted partner for government agencies and private enterprises alike.' }}
                    </p>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        {{ settings?.about_mission_desc_2 || 'With a focus on construction, agriculture, and renewable energy, we deliver solutions that are technologically advanced, environmentally conscious, and socially impactful.' }}
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-6 reveal">
                    <div v-for="stat in [
                        {l: 'Founded', v: '2014'},
                        {l: 'Engineers', v: '15+'},
                        {l: 'Sectors', v: '11'},
                        {l: 'Projects', v: '20+'}
                    ]" :key="stat.l" class="bg-white p-10 rounded-3xl text-center border border-slate-200 hover:border-primary-500/30 transition-all duration-500 hover:shadow-xl">
                        <div class="stat-value text-4xl font-black text-slate-900 mb-3">{{ stat.v }}</div>
                        <div class="text-sm uppercase tracking-widest text-slate-400 font-bold">{{ stat.l }}</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Certifications -->
        <section class="py-32 bg-slate-50 px-6 border-y border-slate-100">
            <div class="max-w-7xl mx-auto text-center">
                <h2 class="text-secondary-500 font-bold tracking-widest uppercase mb-4 reveal">Trusted & Verified</h2>
                <h3 class="text-4xl md:text-7xl font-black tracking-tighter mb-20 reveal text-slate-900">Compliance Excellence</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="cert in [
                        {t: 'CAC Nigeria', d: 'Corporate Affairs Commission Registered Entity', i: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'},
                        {t: 'FIRS Compliance', d: 'Federal Inland Revenue Service Tax Compliance', i: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'},
                        {t: 'ITF Certified', d: 'Industrial Training Fund Accredited Partner', i: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'},
                        {t: 'ISO 27001', d: 'International Information Security Standard', i: 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'},
                        {t: 'NSITF', d: 'Social Insurance Trust Fund Compliant', i: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'},
                        {t: 'BPP Registered', d: 'Bureau of Public Procurement Certified', i: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'}
                    ]" :key="cert.t" class="reveal bg-white p-10 rounded-3xl group hover:border-primary-500/30 transition-all duration-500 border border-slate-200 text-left hover:shadow-xl">
                        <div class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center mb-6 text-primary-500 group-hover:bg-primary-500 group-hover:text-white transition-all duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" :d="cert.i" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-slate-900">{{ cert.t }}</h4>
                        <p class="text-slate-500 leading-relaxed text-sm">{{ cert.d }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team -->
        <section class="py-32 px-6">
            <div class="max-w-7xl mx-auto text-center">
                <h2 class="text-primary-500 font-bold tracking-widest uppercase mb-4 reveal">The Brains</h2>
                <h3 class="text-4xl md:text-7xl font-black tracking-tighter mb-20 reveal text-slate-900">Leadership Team</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="member in team" :key="member.id" class="reveal group bg-white p-10 rounded-3xl border border-slate-200 hover:border-primary-500/30 transition-all duration-500 hover:shadow-xl text-center">
                        <div class="w-20 h-20 bg-primary-50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary-500 transition-all duration-500">
                            <span class="text-2xl font-black text-primary-500 group-hover:text-white transition-colors">{{ member.name.charAt(0) }}</span>
                        </div>
                        <h4 class="text-xl font-bold text-slate-900 mb-1">{{ member.name }}</h4>
                        <p class="text-primary-500 font-bold text-xs uppercase tracking-widest mb-4">{{ member.role }}</p>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ member.bio }}</p>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>