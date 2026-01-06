<template>
    <a 
        v-if="whatsappNumber"
        :href="whatsappUrl"
        target="_blank"
        rel="noopener noreferrer"
        class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50 group"
    >
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 w-14 h-14 sm:w-16 sm:h-16 rounded-full shadow-2xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 active:scale-95 animate-pulse hover:animate-none">
            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
        </div>
        <!-- Tooltip -->
        <div class="absolute bottom-full right-0 mb-2 hidden sm:group-hover:block">
            <div class="bg-gray-900 text-white text-xs sm:text-sm rounded-lg py-2 px-3 whitespace-nowrap shadow-lg">
                Chat with us on WhatsApp
                <div class="absolute top-full right-4 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
            </div>
        </div>
    </a>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'WhatsAppButton',
    setup() {
        const whatsappNumber = ref('');
        const brandName = ref('SK Python Classes');

        const fetchBrandSettings = async () => {
            try {
                const response = await axios.get('/api/brand-settings');
                if (response.data.success && response.data.settings) {
                    const settings = response.data.settings;
                    whatsappNumber.value = settings.whatsapp || '';
                    brandName.value = settings.brand_name || 'SK Python Classes';
                }
            } catch (error) {
                console.error('Error fetching brand settings:', error);
            }
        };

        const whatsappUrl = computed(() => {
            if (!whatsappNumber.value) return '#';
            
            // Remove all non-digit characters except +
            let cleanNumber = whatsappNumber.value.replace(/[^\d+]/g, '');
            
            // Remove + if present and ensure it starts with country code
            if (cleanNumber.startsWith('+')) {
                cleanNumber = cleanNumber.substring(1);
            }
            
            // Default message
            const message = encodeURIComponent(`Hello! I'm interested in learning more about ${brandName.value}. Could you please provide me with more information?`);
            
            return `https://wa.me/${cleanNumber}?text=${message}`;
        });

        onMounted(() => {
            fetchBrandSettings();
        });

        return {
            whatsappNumber,
            whatsappUrl
        };
    }
};
</script>

<style scoped>
/* Pulse animation for WhatsApp button */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>

