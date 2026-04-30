<script setup>
import { onMounted, ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import ServiceCard from '@/Components/Premium/ServiceCard.vue';
import { useGSAP } from '@/Composables/useGSAP';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    services: Array
});

const { gsap, ScrollTrigger } = useGSAP();

onMounted(() => {
    gsap.from('.hero-reveal', { y: 80, opacity: 0, duration: 1.5, stagger: 0.2, ease: 'expo.out' });

    gsap.utils.toArray('.card-reveal').forEach((card, i) => {
        gsap.from(card, {
            scrollTrigger: { trigger: card, start: 'top 90%' },
            y: 50, opacity: 0, duration: 1, delay: i % 3 * 0.1, ease: 'power3.out'
        });
    });
});

const getDetails = (slug) => {
    const detailsMap = {
        'it-consultancy': ['Strategic Tech Roadmaps', 'Digital Maturity Audit', 'IT Governance', 'Change Management'],
        'software-development': ['Custom Enterprise Apps', 'Mobile First Solutions', 'API Ecosystems', 'Legacy Modernization'],
        'infrastructure-networking': ['Data Center Design', 'Smart Networking', 'Cloud Integration', 'Network Security'],
        'cybersecurity': ['Threat Intelligence', 'Penetration Testing', 'Identity Management', 'Compliance Frameworks'],
        'cloud-devops': ['AWS/Azure/GCP Experts', 'CI/CD Pipelines', 'Containerization', 'Serverless Architecture'],
        'data-analytics-ai': ['Predictive Modeling', 'ML/DL Solutions', 'BI Dashboards', 'Big Data Engineering'],
        'constructions': ['National Infrastructure', 'Civil Engineering', 'Structural Integrity', 'Smart Buildings'],
        'agriculture': ['Precision Farming', 'Ag-Tech IoT', 'Smart Irrigation', 'Sustainable Infrastructure'],
        'healthcare': ['Health Information Systems', 'Medical Infrastructure', 'Epidemiology Systems', 'Telemedicine Platforms'],
        'oil-and-gas': ['Digital Oilfield', 'Resource Optimization', 'Safety Systems', 'Pipeline Monitoring'],
        'renewable-energy': ['Solar Farm Design', 'Wind Power Solutions', 'Energy Storage', 'Smart Grid Integration']
    };
    return detailsMap[slug] || ['Quality Standards', 'Innovative Approach', 'Expert Engineering', 'Scalable Solutions'];
};
</script>

<template>
    <MainLayout>
        <!-- Hero -->
        <section class="pt-48 pb-32 px-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-primary-500/10 blur-[150px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-secondary-500/5 blur-[150px] rounded-full -translate-x-1/2 translate-y-1/2"></div>

            <div class="max-w-7xl mx-auto relative z-10">
                <div class="max-w-4xl">
                    <h2 class="text-primary-500 font-bold tracking-[0.3em] uppercase mb-6 hero-reveal">Our Services</h2>
                    <h1 class="text-6xl md:text-9xl font-black tracking-tighter leading-[0.85] mb-12 text-slate-900 hero-reveal">
                        Sectors of <br/> <span class="text-slate-300">Excellence.</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-slate-500 max-w-2xl leading-relaxed font-light hero-reveal">
                        From digital transformation to national infrastructure, we deliver mission-critical solutions across 11 specialized sectors.
                    </p>
                </div>
            </div>
        </section>

        <!-- Services Grid -->
        <section class="py-32 px-6 bg-slate-50/50 border-y border-slate-100">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-20">
                    <h2 class="text-sm font-bold text-primary-600 uppercase tracking-[0.3em] mb-4">Specialized Solutions</h2>
                    <h3 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tighter">Full Portfolio</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <ServiceCard
                        v-for="service in services"
                        :key="service.id"
                        class="card-reveal"
                        :title="service.title"
                        :description="service.description"
                        :icon="service.icon"
                        :details="getDetails(service.slug)"
                    />
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="py-32 px-6">
            <div class="max-w-7xl mx-auto bg-slate-900 p-12 md:p-24 rounded-3xl text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10 pointer-events-none"></div>
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/20 blur-[100px] rounded-full"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-7xl font-black text-white tracking-tighter mb-8">Ready to transform <br/> your <span class="text-primary-500">sector?</span></h2>
                    <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                        <Link href="/contact" class="px-12 py-6 bg-primary-500 text-white rounded-2xl font-black text-lg hover:bg-primary-400 transition-all hover:shadow-2xl hover:shadow-primary-500/20 hover:-translate-y-0.5">
                            Get a Quote
                        </Link>
                        <Link href="/portfolio" class="px-12 py-6 border border-white/20 text-white rounded-2xl font-black text-lg hover:bg-white/10 transition-all">
                            View Our Work
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>