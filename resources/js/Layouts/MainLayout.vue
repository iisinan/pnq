<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import Logo from '@/Components/Logo.vue';
import Lenis from 'lenis';
import { useGSAP } from '@/Composables/useGSAP';

const { gsap } = useGSAP();
const isScrolled = ref(false);
const isMobileMenuOpen = ref(false);

onMounted(() => {
    document.documentElement.classList.remove('dark');
    localStorage.setItem('theme', 'light');

    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    });

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    window.addEventListener('scroll', () => {
        isScrolled.value = window.scrollY > 20;
    });
});

const navLinks = [
    { name: 'Home', href: '/' },
    { name: 'About', href: '/about' },
    { name: 'Services', href: '/services' },
    { name: 'Portfolio', href: '/portfolio' },
    { name: 'Team', href: '/team' },
    { name: 'Contact', href: '/contact' },
];
</script>

<template>
    <div class="min-h-screen bg-white text-slate-900 selection:bg-primary-500/20 selection:text-primary-700 font-sans">
        <Head :title="$page.props.title ? `${$page.props.title} | Price and Quote` : 'Price and Quote - Engineering Excellence'" />

        <!-- Navigation -->
        <nav
            class="fixed top-0 left-0 right-0 z-[100] transition-all duration-500 px-6"
            :class="[isScrolled ? 'pt-4' : 'pt-6']"
        >
            <div
                class="max-w-7xl mx-auto flex items-center justify-between rounded-2xl transition-all duration-500 px-8 border"
                :class="[isScrolled ? 'bg-white/90 backdrop-blur-xl py-3 border-slate-200 shadow-lg shadow-slate-200/50' : 'bg-transparent py-4 border-transparent']"
            >
                <Link href="/" class="flex items-center">
                    <Logo />
                </Link>

                <!-- Desktop -->
                <div class="hidden md:flex items-center space-x-8">
                    <Link
                        v-for="link in navLinks"
                        :key="link.name"
                        :href="link.href"
                        class="text-sm font-bold tracking-tight transition-colors relative group"
                        :class="[$page.url === link.href ? 'text-primary-500' : 'text-slate-600 hover:text-slate-900']"
                    >
                        {{ link.name }}
                        <span
                            class="absolute -bottom-1 left-0 h-0.5 bg-primary-500 transition-all duration-500"
                            :class="[$page.url === link.href ? 'w-full' : 'w-0 group-hover:w-full']"
                        ></span>
                    </Link>
                </div>

                <!-- Mobile Toggle -->
                <button
                    @click="isMobileMenuOpen = !isMobileMenuOpen"
                    class="text-slate-900 p-2 md:hidden"
                >
                    <div class="w-6 h-5 relative flex flex-col justify-between">
                        <span class="w-full h-0.5 bg-current transition-all duration-300" :class="{'rotate-45 translate-y-2': isMobileMenuOpen}"></span>
                        <span class="w-full h-0.5 bg-current transition-all duration-300" :class="{'opacity-0': isMobileMenuOpen}"></span>
                        <span class="w-full h-0.5 bg-current transition-all duration-300" :class="{'-rotate-45 -translate-y-2': isMobileMenuOpen}"></span>
                    </div>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <Transition
            enter-active-class="transition duration-500 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition duration-200 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="isMobileMenuOpen" class="fixed inset-0 z-[90] bg-white/95 backdrop-blur-xl flex flex-col items-center justify-center p-8">
                <div class="flex flex-col items-center space-y-10 text-center w-full max-w-sm">
                    <Logo :showText="true" class="h-16 w-auto" />
                    <Link
                        v-for="link in navLinks"
                        :key="link.name"
                        :href="link.href"
                        @click="isMobileMenuOpen = false"
                        class="text-3xl font-black text-slate-900 hover:text-primary-500 transition-colors tracking-tighter"
                        :class="{'text-primary-500': $page.url === link.href}"
                    >
                        {{ link.name }}
                    </Link>
                    <div class="pt-8 w-full">
                        <Link href="/contact" @click="isMobileMenuOpen = false" class="block w-full bg-primary-500 text-white py-5 rounded-2xl text-lg font-bold text-center shadow-xl shadow-primary-500/20">
                            Get Started
                        </Link>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Main -->
        <main class="relative z-10">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-slate-50 border-t border-slate-100 py-24 px-6 md:px-12 relative overflow-hidden">
            <div class="max-w-7xl mx-auto relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-16">
                    <div class="col-span-1 md:col-span-2">
                        <Link href="/" class="flex items-center mb-8">
                            <Logo />
                        </Link>
                        <p class="text-slate-500 max-w-md text-lg leading-relaxed mb-8">
                            Transforming the national landscape through construction, agriculture, renewable energy, IT consultancy, and strategic infrastructure solutions since 2014.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-slate-900 font-bold uppercase tracking-widest text-sm mb-8">Quick Links</h4>
                        <ul class="space-y-4">
                            <li v-for="link in navLinks" :key="link.name">
                                <Link :href="link.href" class="text-slate-500 hover:text-primary-500 transition-colors font-medium">{{ link.name }}</Link>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-slate-900 font-bold uppercase tracking-widest text-sm mb-8">Contact Info</h4>
                        <ul class="space-y-4 text-slate-500">
                            <li class="flex flex-col">
                                <span class="text-xs font-bold text-slate-400 uppercase mb-1">Email</span>
                                <span class="text-slate-900 font-medium">info@priceandquote.com</span>
                            </li>
                            <li class="flex flex-col">
                                <span class="text-xs font-bold text-slate-400 uppercase mb-1">Phone</span>
                                <span class="text-slate-900 font-medium">08033657989</span>
                            </li>
                            <li class="flex flex-col">
                                <span class="text-xs font-bold text-slate-400 uppercase mb-1">Location</span>
                                <span class="text-slate-900 font-medium">CBD, Abuja, Nigeria</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-20 pt-8 border-t border-slate-200 flex flex-col md:flex-row justify-between items-center text-slate-400 text-sm">
                    <p class="font-medium">&copy; 2026 Price and Quote Limited. All rights reserved.</p>
                    <div class="flex space-x-8 mt-4 md:mt-0 font-medium">
                        <a href="#" class="hover:text-primary-500 transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-primary-500 transition-colors">Terms of Use</a>
                    </div>
                </div>
            </div>

            <div class="absolute -bottom-48 -right-48 w-[500px] h-[500px] bg-primary-500/5 blur-[150px] rounded-full"></div>
        </footer>
    </div>
</template>
