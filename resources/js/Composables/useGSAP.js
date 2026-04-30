import { onMounted, onUnmounted } from 'vue';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function useGSAP() {
    onUnmounted(() => {
        // Clean up scroll triggers to prevent memory leaks
        ScrollTrigger.getAll().forEach(t => t.kill());
    });

    return {
        gsap,
        ScrollTrigger
    };
}
