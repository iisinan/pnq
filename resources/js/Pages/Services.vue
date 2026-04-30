<script setup>
import { onMounted, ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { useGSAP } from '@/Composables/useGSAP';
import { Link } from '@inertiajs/vue3';

const props = defineProps({ services: Array });
const { gsap } = useGSAP();
const activeIdx = ref(0);

const getDetails = (slug) => {
    const map = {
        'it-consultancy': ['Strategic Tech Roadmaps', 'Digital Maturity Audits', 'IT Governance', 'Change Management'],
        'software-development': ['Custom Enterprise Apps', 'Mobile-First Solutions', 'API Ecosystems', 'Legacy Modernization'],
        'infrastructure-networking': ['Data Center Design', 'Smart Networking', 'Cloud Integration', 'Network Security'],
        'cybersecurity': ['Threat Intelligence', 'Penetration Testing', 'Identity Management', 'Compliance Frameworks'],
        'cloud-devops': ['AWS/Azure/GCP Expertise', 'CI/CD Pipelines', 'Containerization', 'Serverless Architecture'],
        'data-analytics-ai': ['Predictive Modeling', 'ML/DL Solutions', 'BI Dashboards', 'Big Data Engineering'],
        'constructions': ['National Infrastructure', 'Civil Engineering', 'Structural Integrity', 'Smart Buildings'],
        'agriculture': ['Precision Farming', 'Ag-Tech IoT', 'Smart Irrigation', 'Sustainable Infrastructure'],
        'healthcare': ['Health Information Systems', 'Medical Infrastructure', 'Epidemiology Systems', 'Telemedicine'],
        'oil-and-gas': ['Digital Oilfield', 'Resource Optimization', 'Safety Systems', 'Pipeline Monitoring'],
        'renewable-energy': ['Solar Farm Design', 'Wind Power Solutions', 'Energy Storage', 'Smart Grid Integration'],
    };
    return map[slug] || ['Quality Standards', 'Innovative Approach', 'Expert Engineering', 'Scalable Solutions'];
};

const categoryColors = [
    'from-primary-500/20 to-primary-500/5',
    'from-secondary-500/20 to-secondary-500/5',
    'from-emerald-500/20 to-emerald-500/5',
    'from-violet-500/20 to-violet-500/5',
    'from-amber-500/20 to-amber-500/5',
];

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
        <section class="relative pt-40 pb-28 px-6 overflow-hidden bg-white">
            <div class="absolute inset-0 pointer-events-none"
                 style="background-image: linear-gradient(rgba(58,190,249,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(58,190,249,0.05) 1px, transparent 1px); background-size: 60px 60px;"></div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-400/10 rounded-full blur-[120px] pointer-events-none translate-x-1/2 -translate-y-1/4"></div>
            <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-secondary-500/5 rounded-full blur-[80px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto relative z-10">
                <div class="hero-reveal inline-flex items-center gap-2 text-xs font-bold tracking-[0.18em] uppercase text-primary-500 mb-8">
                    <span class="w-8 h-px bg-primary-500"></span>
                    Our Services
                </div>
                <h1 class="hero-reveal text-4xl sm:text-6xl md:text-8xl font-black tracking-tighter leading-[0.88] text-slate-900 mb-6">
                    Sectors of<br/><span class="text-slate-300">Excellence.</span>
                </h1>
                <p class="hero-reveal text-xl text-slate-500 max-w-2xl leading-relaxed font-light">
                    Mission-critical solutions delivered across {{ services?.length || 11 }} specialized sectors — from digital transformation to national infrastructure.
                </p>
            </div>
        </section>

        <!-- ═══ SERVICES — Split Layout ═══ -->
        <section class="py-16 px-6 border-y border-slate-100">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">
                    <!-- LEFT: list -->
                    <div class="lg:col-span-2 space-y-2 reveal">
                        <p class="text-xs font-bold uppercase tracking-widest text-slate-400 px-4 mb-4">{{ services?.length || 11 }} Specializations</p>
                        <button
                            v-for="(service, i) in services"
                            :key="service.id"
                            @click="activeIdx = i"
                            class="w-full text-left px-5 py-4 rounded-2xl transition-all duration-300 flex items-center gap-4 group"
                            :class="[activeIdx === i
                                ? 'bg-slate-900 text-white shadow-lg'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900']">
                            <!-- Number -->
                            <span class="text-xs font-black tabular-nums w-6 flex-shrink-0 transition-colors"
                                  :class="activeIdx === i ? 'text-primary-400' : 'text-slate-300 group-hover:text-slate-400'">
                                {{ String(i + 1).padStart(2, '0') }}
                            </span>
                            <!-- Icon mini -->
                            <span class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 transition-all duration-300"
                                  :class="activeIdx === i ? 'bg-white/10' : 'bg-slate-100 group-hover:bg-primary-50'">
                                <svg class="w-4 h-4 transition-colors" :class="activeIdx === i ? 'text-primary-400' : 'text-slate-400 group-hover:text-primary-500'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" :d="service.icon" />
                                </svg>
                            </span>
                            <!-- Title -->
                            <span class="font-bold text-sm">{{ service.title }}</span>
                            <!-- Arrow -->
                            <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0"
                                 :class="activeIdx === i ? 'opacity-100 text-primary-400' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>

                    <!-- RIGHT: detail panel -->
                    <div class="lg:col-span-3 reveal">
                        <TransitionGroup name="panel" mode="out-in">
                            <div v-if="services?.[activeIdx]" :key="activeIdx"
                                class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-10 md:p-14 shadow-xl shadow-slate-100/50 h-full">
                                <!-- Background gradient blob -->
                                <div class="absolute -top-20 -right-20 w-60 h-60 rounded-full blur-3xl pointer-events-none"
                                     :class="`bg-gradient-to-br ${categoryColors[activeIdx % categoryColors.length]}`"></div>

                                <!-- Icon large -->
                                <div class="relative w-20 h-20 rounded-3xl bg-primary-500 flex items-center justify-center mb-10">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" :d="services[activeIdx].icon" />
                                    </svg>
                                </div>

                                <!-- Number & title -->
                                <div class="text-xs font-black text-primary-500 tracking-widest mb-3">
                                    {{ String(activeIdx + 1).padStart(2, '0') }} / {{ String(services.length).padStart(2, '0') }}
                                </div>
                                <h2 class="text-3xl md:text-5xl font-black tracking-tighter text-slate-900 mb-5">{{ services[activeIdx].title }}</h2>
                                <p class="text-slate-500 leading-relaxed text-base mb-10 max-w-lg font-light">{{ services[activeIdx].description }}</p>

                                <!-- Features -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-10">
                                    <div v-for="(detail, j) in getDetails(services[activeIdx].slug)" :key="j"
                                        class="flex items-center gap-3 bg-slate-50 rounded-xl px-5 py-3.5 hover:bg-primary-50 hover:text-primary-700 transition-colors duration-200 group">
                                        <div class="w-1.5 h-1.5 bg-primary-500 rounded-full flex-shrink-0 group-hover:scale-150 transition-transform"></div>
                                        <span class="text-sm font-semibold text-slate-700 group-hover:text-primary-700 transition-colors">{{ detail }}</span>
                                    </div>
                                </div>

                                <!-- CTA -->
                                <Link href="/contact"
                                    class="group inline-flex items-center gap-3 bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold text-sm transition-all duration-300 hover:bg-primary-500 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary-500/20 active:scale-95">
                                    Get a Quote for {{ services[activeIdx].title }}
                                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </Link>
                            </div>
                        </TransitionGroup>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ CTA ═══ -->
        <section class="py-24 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="reveal relative overflow-hidden rounded-3xl bg-slate-900 p-14 md:p-24 text-center">
                    <div class="absolute top-8 right-8 w-32 h-32 border border-white/5 rounded-2xl rotate-12 pointer-events-none"></div>
                    <div class="absolute bottom-8 left-8 w-24 h-24 border border-white/5 rounded-xl -rotate-12 pointer-events-none"></div>
                    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-900 to-primary-950/50 pointer-events-none"></div>
                    <div class="relative z-10">
                        <p class="text-xs font-bold tracking-[0.2em] uppercase text-primary-400 mb-6">Transform Your Sector</p>
                        <h2 class="text-4xl md:text-7xl font-black text-white tracking-tighter mb-8 leading-[0.9]">
                            Ready to start<br/>your <span class="text-primary-500">project?</span>
                        </h2>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            <Link href="/contact"
                                class="group relative overflow-hidden bg-primary-500 text-white px-12 py-5 rounded-2xl text-base font-black transition-all duration-300 hover:shadow-2xl hover:shadow-primary-500/40 hover:-translate-y-0.5 active:scale-95">
                                <span class="relative z-10">Get a Quote</span>
                                <span class="absolute inset-0 bg-primary-400 scale-x-0 origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
                            </Link>
                            <Link href="/portfolio" class="text-slate-400 hover:text-white text-sm font-bold flex items-center gap-2 transition-colors">
                                View Our Work <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style scoped>
.panel-enter-active { transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
.panel-leave-active { transition: all 0.2s ease-in; }
.panel-enter-from { opacity: 0; transform: translateY(20px); }
.panel-leave-to { opacity: 0; transform: translateY(-10px); }
</style>