<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});

const submitted = ref(false);

const submitForm = () => {
    form.post('/contact', {
        preserveScroll: true,
        onSuccess: () => {
            submitted.value = true;
            form.reset();
        },
    });
};
</script>

<template>
    <MainLayout>
        <section class="pt-48 pb-32 px-6 relative overflow-hidden">
            <div class="absolute top-20 right-0 w-[500px] h-[500px] bg-primary-500/10 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-secondary-500/5 blur-[100px] rounded-full"></div>

            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-start">
                    <!-- Info -->
                    <div>
                        <h2 class="text-secondary-500 font-bold tracking-widest uppercase mb-6">Get In Touch</h2>
                        <h1 class="text-5xl md:text-8xl font-black tracking-tighter leading-[0.85] mb-8 text-slate-900">Let's Build <br/> <span class="text-slate-300">The Future.</span></h1>
                        <p class="text-lg text-slate-500 leading-relaxed mb-12 max-w-md">
                            Ready to transform your enterprise? Our team is here to discuss your next big project.
                        </p>

                        <div class="space-y-8">
                            <div v-for="info in [
                                {t: 'Our Headquarters', v: 'Central Business District, Abuja, Nigeria', i: 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'},
                                {t: 'Email Us', v: 'info@priceandquote.com', i: 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'},
                                {t: 'Call Us', v: '08033657989', i: 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'}
                            ]" :key="info.t" class="flex items-start space-x-5 group">
                                <div class="w-12 h-12 bg-primary-50 rounded-2xl flex items-center justify-center flex-shrink-0 text-primary-500 group-hover:bg-primary-500 group-hover:text-white transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" :d="info.i" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-slate-900 mb-1 group-hover:text-primary-500 transition-colors">{{ info.t }}</h4>
                                    <p class="text-slate-500 text-sm">{{ info.v }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Office Hours -->
                        <div class="mt-12 bg-white p-8 rounded-3xl border border-slate-200">
                            <h4 class="text-sm font-bold uppercase tracking-widest text-secondary-500 mb-4">Office Hours</h4>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between"><span class="text-slate-500">Monday — Friday</span><span class="font-bold text-slate-900">8:00 AM — 6:00 PM</span></div>
                                <div class="flex justify-between"><span class="text-slate-500">Saturday</span><span class="font-bold text-slate-900">9:00 AM — 2:00 PM</span></div>
                                <div class="flex justify-between"><span class="text-slate-500">Sunday</span><span class="text-slate-400">Closed</span></div>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="bg-white p-10 md:p-14 rounded-3xl relative overflow-hidden border border-slate-200 shadow-xl shadow-slate-200/50">
                        <!-- Success -->
                        <Transition enter-active-class="transition duration-500 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100">
                            <div v-if="submitted" class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center p-12 bg-white/95 backdrop-blur-xl rounded-3xl">
                                <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mb-6 animate-bounce">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-black mb-4 text-slate-900">Message Sent!</h3>
                                <p class="text-slate-500 mb-6 max-w-sm">Thank you for reaching out. Our team will get back to you within 24 hours.</p>
                                <button @click="submitted = false" class="text-primary-500 font-bold hover:underline">Send another message →</button>
                            </div>
                        </Transition>

                        <h3 class="text-xl font-bold mb-8 text-slate-900">Send us a message</h3>

                        <form @submit.prevent="submitForm" class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Your Name</label>
                                    <input v-model="form.name" type="text" required placeholder="John Doe" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-900 placeholder-slate-400 focus:border-primary-500 focus:ring-0 transition-all outline-none" />
                                    <p v-if="form.errors.name" class="text-red-500 text-xs mt-1 ml-1">{{ form.errors.name }}</p>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Email Address</label>
                                    <input v-model="form.email" type="email" required placeholder="john@company.com" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-900 placeholder-slate-400 focus:border-primary-500 focus:ring-0 transition-all outline-none" />
                                    <p v-if="form.errors.email" class="text-red-500 text-xs mt-1 ml-1">{{ form.errors.email }}</p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Subject</label>
                                <input v-model="form.subject" type="text" required placeholder="Project Inquiry" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-900 placeholder-slate-400 focus:border-primary-500 focus:ring-0 transition-all outline-none" />
                                <p v-if="form.errors.subject" class="text-red-500 text-xs mt-1 ml-1">{{ form.errors.subject }}</p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Message</label>
                                <textarea v-model="form.message" rows="5" required placeholder="Tell us about your project..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-900 placeholder-slate-400 focus:border-primary-500 focus:ring-0 transition-all outline-none resize-none"></textarea>
                                <p v-if="form.errors.message" class="text-red-500 text-xs mt-1 ml-1">{{ form.errors.message }}</p>
                            </div>

                            <button type="submit" :disabled="form.processing" class="w-full bg-primary-500 text-white py-5 rounded-2xl text-lg font-bold hover:bg-primary-600 transition-all hover:shadow-xl hover:shadow-primary-500/20 active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center space-x-3">
                                <span v-if="!form.processing">Send Message</span>
                                <span v-else class="flex items-center space-x-3">
                                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>Sending...</span>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>