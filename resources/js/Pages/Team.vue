<script setup>
import { onMounted } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { useGSAP } from '@/Composables/useGSAP';

const props = defineProps({
    team: Array
});

const { gsap } = useGSAP();

onMounted(() => {
    gsap.from('.hero-reveal', { y: 80, opacity: 0, duration: 1.5, stagger: 0.2, ease: 'expo.out' });

    gsap.from('.team-card', {
        y: 60, opacity: 0, duration: 1.2, stagger: 0.15, ease: 'power4.out',
        scrollTrigger: { trigger: '.team-grid', start: 'top 80%' }
    });

    gsap.utils.toArray('.reveal').forEach((el) => {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 85%' },
            y: 50, opacity: 0, duration: 1.2, ease: 'expo.out',
        });
    });
});

const milestones = [
    { year: '2014', title: 'Company Founded', desc: 'Price and Quote Limited established with a vision to deliver excellence across multiple sectors.' },
    { year: '2018', title: 'First Major Award', desc: 'Secured first significant engineering and consultancy contract.' },
    { year: '2020', title: 'Sativa Rice Mill Project', desc: 'Awarded design, monitoring, and consultancy services for the Sativa Rice Mill.' },
    { year: '2022', title: 'Multi-Sector Expansion', desc: 'Expanded into renewable energy, agriculture, and large-scale construction projects.' },
    { year: '2024', title: 'Federal Housing Project', desc: 'Awarded the 292-unit Federal Government Resettlement Housing scheme in Kebbi.' },
];
</script>

<template>
    <MainLayout>
        <!-- Hero -->
        <section class="pt-48 pb-32 px-6 relative overflow-hidden">
            <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-primary-500/10 blur-[150px] rounded-full"></div>

            <div class="max-w-7xl mx-auto text-center relative z-10">
                <h2 class="text-primary-500 font-bold tracking-widest uppercase mb-6 hero-reveal">Our People</h2>
                <h1 class="text-6xl md:text-9xl font-black tracking-tighter leading-[0.85] mb-12 text-slate-900 hero-reveal">
                    The Minds Behind <br/> <span class="text-slate-300">The Mission.</span>
                </h1>
                <p class="text-xl md:text-2xl text-slate-500 max-w-3xl mx-auto leading-relaxed font-light hero-reveal">
                    A dedicated team of engineers, strategists, and innovators committed to delivering excellence.
                </p>
            </div>
        </section>

        <!-- Team Grid -->
        <section class="py-24 px-6 bg-slate-50/50 border-y border-slate-100">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 team-grid">
                    <div
                        v-for="member in team"
                        :key="member.id"
                        class="team-card group bg-white p-10 rounded-3xl border border-slate-200 hover:border-primary-500/30 transition-all duration-500 hover:shadow-xl text-center"
                    >
                        <div class="w-20 h-20 bg-primary-50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary-500 transition-all duration-500">
                            <span class="text-2xl font-black text-primary-500 group-hover:text-white transition-colors">{{ member.name.split(' ').map(n => n[0]).join('').slice(0, 2) }}</span>
                        </div>
                        <h3 class="text-xl font-bold mb-1 text-slate-900 group-hover:text-primary-500 transition-colors">{{ member.name }}</h3>
                        <p class="text-primary-500 font-bold text-xs uppercase tracking-widest mb-4">{{ member.role }}</p>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ member.bio }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Company Timeline -->
        <section class="py-32 px-6">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-20">
                    <h2 class="text-primary-500 font-bold tracking-widest uppercase mb-4 reveal">Our Journey</h2>
                    <h3 class="text-4xl md:text-6xl font-black tracking-tighter text-slate-900 reveal">A Decade of Impact</h3>
                </div>

                <div class="relative">
                    <div class="absolute left-8 md:left-1/2 top-0 bottom-0 w-px bg-slate-200 md:-translate-x-px"></div>

                    <div v-for="(milestone, i) in milestones" :key="i" class="reveal relative flex items-start mb-12 last:mb-0" :class="[i % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse']">
                        <div class="absolute left-8 md:left-1/2 w-4 h-4 bg-primary-500 rounded-full -translate-x-1/2 mt-2 ring-4 ring-white z-10"></div>

                        <div class="ml-20 md:ml-0 md:w-1/2" :class="[i % 2 === 0 ? 'md:pr-16 md:text-right' : 'md:pl-16']">
                            <div class="bg-white p-8 rounded-3xl border border-slate-200 hover:border-primary-500/30 transition-all hover:shadow-lg">
                                <span class="text-primary-500 font-black text-2xl">{{ milestone.year }}</span>
                                <h4 class="text-lg font-bold mt-2 mb-2 text-slate-900">{{ milestone.title }}</h4>
                                <p class="text-slate-500 text-sm">{{ milestone.desc }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Join CTA -->
        <section class="py-32 px-6">
            <div class="max-w-7xl mx-auto bg-slate-900 p-12 md:p-24 rounded-3xl text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10 pointer-events-none"></div>
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/20 blur-[100px] rounded-full"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-6xl font-black text-white tracking-tighter mb-8">Join Our Team</h2>
                    <p class="text-xl text-slate-400 mb-12 max-w-2xl mx-auto font-light">
                        We're always looking for exceptional talent to join our mission of engineering the future.
                    </p>
                    <a href="mailto:info@priceandquote.com" class="inline-block bg-primary-500 text-white px-12 py-6 rounded-2xl text-lg font-black hover:bg-primary-400 transition-all hover:shadow-2xl hover:shadow-primary-500/20 hover:-translate-y-0.5">
                        Get In Touch
                    </a>
                </div>
            </div>
        </section>
    </MainLayout>
</template>