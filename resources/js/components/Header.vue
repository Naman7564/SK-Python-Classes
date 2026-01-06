<template>
    <header class="header-modern sticky top-0 z-50 backdrop-blur-xl bg-white/95 border-b border-gray-200/60 shadow-md">
        <nav class="container mx-auto px-3 sm:px-4 lg:px-8">
            <div class="flex items-center justify-between h-14 sm:h-16 lg:h-20">
                <!-- Logo -->
                <router-link to="/" class="flex items-center space-x-2 sm:space-x-3 group cursor-pointer flex-shrink-0 min-w-0">
                    <div class="logo-container flex-shrink-0">
                        <img 
                            v-if="brandSettings.brand_logo_url" 
                            :src="brandSettings.brand_logo_url" 
                            :alt="brandSettings.brand_name"
                            class="h-8 w-auto sm:h-10 lg:h-12 transition-transform duration-300 group-hover:scale-110"
                        >
                    </div>
                    <h1 class="text-base sm:text-xl lg:text-2xl xl:text-3xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 bg-clip-text text-transparent animate-gradient truncate">
                        {{ brandSettings.brand_name || 'SK Python Classes' }}
                    </h1>
                </router-link>

                <!-- Navigation Links -->
                <div class="hidden lg:flex items-center space-x-1 xl:space-x-2">
                    <router-link 
                        to="/" 
                        class="nav-link relative px-3 xl:px-5 py-2 xl:py-2.5 text-xs xl:text-sm font-semibold text-gray-700 hover:text-blue-600 transition-all duration-300 rounded-lg xl:rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 group"
                    >
                        <span class="relative z-10">Home</span>
                        <span class="nav-underline"></span>
                    </router-link>
                    <router-link 
                        to="/courses" 
                        class="nav-link relative px-3 xl:px-5 py-2 xl:py-2.5 text-xs xl:text-sm font-semibold text-gray-700 hover:text-blue-600 transition-all duration-300 rounded-lg xl:rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 group"
                    >
                        <span class="relative z-10">Courses</span>
                        <span class="nav-underline"></span>
                    </router-link>
                    <router-link 
                        to="/contact" 
                        class="nav-link relative px-3 xl:px-5 py-2 xl:py-2.5 text-xs xl:text-sm font-semibold text-gray-700 hover:text-blue-600 transition-all duration-300 rounded-lg xl:rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 group"
                    >
                        <span class="relative z-10">Contact</span>
                        <span class="nav-underline"></span>
                    </router-link>
                    <router-link 
                        to="/inquiry" 
                        class="nav-link relative px-3 xl:px-5 py-2 xl:py-2.5 text-xs xl:text-sm font-semibold text-gray-700 hover:text-blue-600 transition-all duration-300 rounded-lg xl:rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 group"
                    >
                        <span class="relative z-10">Inquiry</span>
                        <span class="nav-underline"></span>
                    </router-link>
                    <router-link 
                        to="/about-us" 
                        class="nav-link relative px-3 xl:px-5 py-2 xl:py-2.5 text-xs xl:text-sm font-semibold text-gray-700 hover:text-blue-600 transition-all duration-300 rounded-lg xl:rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 group"
                    >
                        <span class="relative z-10">About Us</span>
                        <span class="nav-underline"></span>
                    </router-link>
                    <router-link 
                        to="/certificateverify" 
                        class="nav-link relative px-3 xl:px-5 py-2 xl:py-2.5 text-xs xl:text-sm font-semibold text-gray-700 hover:text-blue-600 transition-all duration-300 rounded-lg xl:rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 group"
                    >
                        <span class="relative z-10">Verify Certificate</span>
                        <span class="nav-underline"></span>
                    </router-link>
                </div>

                <!-- CTA Buttons -->
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <a 
                        href="/login"
                        class="hidden sm:flex items-center justify-center px-4 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm font-semibold text-gray-700 hover:text-white transition-all duration-300 rounded-lg sm:rounded-xl bg-gradient-to-r from-gray-100 to-gray-50 hover:from-blue-600 hover:to-indigo-600 shadow-sm hover:shadow-md transform hover:scale-105 active:scale-95"
                    >
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="hidden md:inline">Login</span>
                    </a>
                    
                    <!-- Mobile Menu Button -->
                    <button 
                        @click="toggleMobileMenu"
                        class="lg:hidden p-2 sm:p-2.5 text-gray-700 hover:text-blue-600 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 rounded-lg sm:rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500/20 active:scale-95 touch-manipulation"
                        aria-label="Toggle menu"
                    >
                        <svg 
                            class="w-5 h-5 sm:w-6 sm:h-6 transition-transform duration-300" 
                            :class="{ 'rotate-90': mobileMenuOpen }"
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path 
                                v-if="!mobileMenuOpen" 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M4 6h16M4 12h16M4 18h16" 
                            />
                            <path 
                                v-else 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M6 18L18 6M6 6l12 12" 
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <transition
                enter-active-class="transition-all duration-300 ease-out"
                enter-from-class="opacity-0 -translate-y-4"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition-all duration-200 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-4"
            >
                <div v-if="mobileMenuOpen" class="lg:hidden pb-4 sm:pb-6 pt-3 sm:pt-4 border-t border-gray-200/60 mt-2 sm:mt-3 bg-gradient-to-b from-white/50 to-gray-50/30 rounded-b-xl sm:rounded-b-2xl -mx-3 sm:-mx-4 lg:-mx-8 px-3 sm:px-4 lg:px-8">
                    <div class="flex flex-col space-y-1.5 sm:space-y-2 pt-1 sm:pt-2">
                        <router-link 
                            to="/" 
                            @click="closeMobileMenu" 
                            class="mobile-nav-link px-4 sm:px-5 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-blue-600 hover:to-indigo-600 rounded-lg sm:rounded-xl transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-[1.01] active:scale-[0.99] touch-manipulation"
                        >
                            <span class="relative z-10">Home</span>
                        </router-link>
                        <router-link 
                            to="/courses" 
                            @click="closeMobileMenu" 
                            class="mobile-nav-link px-4 sm:px-5 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-blue-600 hover:to-indigo-600 rounded-lg sm:rounded-xl transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-[1.01] active:scale-[0.99] touch-manipulation"
                        >
                            <span class="relative z-10">Courses</span>
                        </router-link>
                        <router-link 
                            to="/contact" 
                            @click="closeMobileMenu" 
                            class="mobile-nav-link px-4 sm:px-5 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-blue-600 hover:to-indigo-600 rounded-lg sm:rounded-xl transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-[1.01] active:scale-[0.99] touch-manipulation"
                        >
                            <span class="relative z-10">Contact</span>
                        </router-link>
                        <router-link 
                            to="/inquiry"
                            @click="closeMobileMenu"
                            class="mobile-nav-link px-4 sm:px-5 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-blue-600 hover:to-indigo-600 rounded-lg sm:rounded-xl transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-[1.01] active:scale-[0.99] touch-manipulation"
                        >
                            <span class="relative z-10">Inquiry</span>
                        </router-link>
                        <router-link 
                            to="/about-us" 
                            @click="closeMobileMenu" 
                            class="mobile-nav-link px-4 sm:px-5 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-blue-600 hover:to-indigo-600 rounded-lg sm:rounded-xl transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-[1.01] active:scale-[0.99] touch-manipulation"
                        >
                            <span class="relative z-10">About Us</span>
                        </router-link>
                        <router-link 
                            to="/certificateverify" 
                            @click="closeMobileMenu" 
                            class="mobile-nav-link px-4 sm:px-5 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-blue-600 hover:to-indigo-600 rounded-lg sm:rounded-xl transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-[1.01] active:scale-[0.99] touch-manipulation"
                        >
                            <span class="relative z-10">Verify Certificate</span>
                        </router-link>
                        <a 
                            href="/login" 
                            @click="closeMobileMenu" 
                            class="mobile-nav-link px-4 sm:px-5 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-lg sm:rounded-xl transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center transform hover:scale-[1.01] active:scale-[0.99] mt-1.5 sm:mt-2 touch-manipulation"
                        >
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Login
                        </a>
                    </div>
                </div>
            </transition>
        </nav>
    </header>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'Header',
    setup() {
        const mobileMenuOpen = ref(false);
        const brandSettings = ref({
            brand_name: 'SK Python Classes',
            brand_logo_url: null
        });

        const fetchBrandSettings = async () => {
            try {
                const response = await axios.get('/api/brand-settings');
                if (response.data.success && response.data.settings) {
                    const settings = response.data.settings;
                    brandSettings.value = {
                        brand_name: settings.brand_name || 'SK Python Classes',
                        brand_logo_url: settings.brand_logo_url || (settings.brand_logo ? `/storage/${settings.brand_logo}` : null)
                    };
                    
                    // Update favicon if available
                    if (settings.favicon_url) {
                        updateFavicon(settings.favicon_url);
                    } else if (settings.favicon) {
                        updateFavicon(`/storage/${settings.favicon}`);
                    }
                }
            } catch (error) {
                console.error('Error fetching brand settings:', error);
            }
        };

        const updateFavicon = (faviconUrl) => {
            let link = document.querySelector("link[rel*='icon']") || document.createElement('link');
            link.type = 'image/x-icon';
            link.rel = 'shortcut icon';
            link.href = faviconUrl;
            document.getElementsByTagName('head')[0].appendChild(link);
        };

        const toggleMobileMenu = () => {
            mobileMenuOpen.value = !mobileMenuOpen.value;
        };

        const closeMobileMenu = () => {
            mobileMenuOpen.value = false;
        };


        onMounted(() => {
            fetchBrandSettings();
        });

        return {
            mobileMenuOpen,
            brandSettings,
            toggleMobileMenu,
            closeMobileMenu
        };
    }
};
</script>

<style scoped>
.container {
    max-width: 1280px;
    margin: 0 auto;
}

.header-modern {
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
}

.logo-container {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
}

.logo-container::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 12px;
    padding: 2px;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(147, 51, 234, 0.3));
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.logo-container:hover::before {
    opacity: 1;
}

.nav-link {
    position: relative;
    overflow: hidden;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%) scaleX(0);
    width: 80%;
    height: 3px;
    background: linear-gradient(90deg, transparent, #3b82f6, #6366f1, transparent);
    border-radius: 2px 2px 0 0;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-link:hover::after {
    transform: translateX(-50%) scaleX(1);
}

.nav-link.router-link-active {
    color: #2563eb;
    background: linear-gradient(to right, rgba(59, 130, 246, 0.1), rgba(99, 102, 241, 0.1));
}

.nav-link.router-link-active::after {
    transform: translateX(-50%) scaleX(1);
}

.nav-underline {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%) scaleX(0);
    width: 60%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #3b82f6, transparent);
    transition: transform 0.3s ease;
}

.mobile-nav-link {
    position: relative;
    overflow: hidden;
}

.mobile-nav-link::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%) translateX(-100%);
    width: 4px;
    height: 70%;
    background: linear-gradient(180deg, #3b82f6, #6366f1);
    border-radius: 0 4px 4px 0;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-nav-link:hover::before,
.mobile-nav-link.router-link-active::before {
    transform: translateY(-50%) translateX(0);
}

.mobile-nav-link.router-link-active {
    color: #2563eb;
    background: linear-gradient(to right, rgba(59, 130, 246, 0.15), rgba(99, 102, 241, 0.15));
}

@keyframes gradient {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Focus states for accessibility */
.nav-link:focus-visible,
.mobile-nav-link:focus-visible {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
    border-radius: 8px;
}
</style>

