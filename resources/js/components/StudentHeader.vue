<template>
    <header class="student-header bg-white/80 backdrop-blur-md shadow-xl sticky top-0 z-50 border-b border-gray-200/60 w-full" id="student-main-header">
        <div class="px-4 py-3 sm:px-6 sm:py-4">
            <div class="flex items-center justify-between">
                <!-- Left Section: Mobile Menu + Page Info -->
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <!-- Mobile Menu Button -->
                    <button 
                        @click="$emit('toggle-sidebar')"
                        class="lg:hidden p-2.5 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all duration-200 active:scale-95"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    
                    <!-- Page Icon & Title -->
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <!-- Dynamic Icon -->
                        <div class="hidden sm:flex w-12 h-12 sm:w-14 sm:h-14 rounded-2xl items-center justify-center shadow-xl transform hover:scale-105 transition-all duration-300" :class="getHeaderIconClass()">
                            <!-- Dashboard Icon -->
                            <svg v-if="currentRoute === 'student.dashboard'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <!-- Live Classes Icon -->
                            <svg v-else-if="currentRoute === 'student.live-classes'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <!-- Payments Icon -->
                            <svg v-else-if="currentRoute === 'student.payments'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <!-- Certificates Icon -->
                            <svg v-else-if="currentRoute === 'student.certificates'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <!-- Default Icon -->
                            <svg v-else class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        
                        <!-- Page Title & Subtitle -->
                        <div class="flex flex-col">
                            <h1 class="text-xl sm:text-2xl md:text-3xl font-extrabold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent leading-tight">
                                {{ pageTitle }}
                            </h1>
                            <p class="text-xs sm:text-sm text-gray-500 hidden sm:block mt-0.5 font-medium">
                                {{ pageSubtitle }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Section: User Info -->
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <!-- User Info -->
                    <div class="hidden sm:flex items-center space-x-3 bg-gradient-to-r from-blue-50 to-purple-50 px-4 py-2 rounded-xl border border-blue-100/50">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-lg ring-2 ring-white">
                            <span class="text-white font-bold text-sm">{{ userInitials }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 font-medium">Welcome back</span>
                            <span class="text-sm font-semibold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                {{ userName }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Mobile User Avatar -->
                    <div class="sm:hidden w-9 h-9 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-xs">{{ userInitials }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import { computed } from 'vue';
import { useRoute } from 'vue-router';

export default {
    name: 'StudentHeader',
    props: {
        pageTitle: {
            type: String,
            required: true
        },
        pageSubtitle: {
            type: String,
            default: 'Student Portal'
        },
        userName: {
            type: String,
            default: 'Student'
        }
    },
    emits: ['toggle-sidebar'],
    setup(props) {
        const route = useRoute();

        const currentRoute = computed(() => {
            return route.name;
        });

        const userInitials = computed(() => {
            const name = props.userName || 'Student';
            return name
                .split(' ')
                .map(n => n[0])
                .join('')
                .toUpperCase()
                .substring(0, 2);
        });

        const getHeaderIconClass = () => {
            const routeName = route.name;
            if (routeName === 'student.dashboard') {
                return 'bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500';
            } else if (routeName === 'student.live-classes') {
                return 'bg-gradient-to-br from-red-500 to-orange-500';
            } else if (routeName === 'student.payments') {
                return 'bg-gradient-to-br from-emerald-500 to-green-500';
            } else if (routeName === 'student.certificates') {
                return 'bg-gradient-to-br from-teal-500 to-cyan-500';
            }
            return 'bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500';
        };

        return {
            currentRoute,
            userInitials,
            getHeaderIconClass
        };
    }
};
</script>

<style scoped>
#student-main-header {
    transition: all 0.3s ease;
    position: sticky;
    top: 0;
    z-index: 50;
    width: 100%;
    display: block;
}

.student-header {
    display: block !important;
}

.backdrop-blur-md {
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}
</style>







