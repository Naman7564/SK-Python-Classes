<template>
    <div class="student-panel min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/20 to-purple-50/20 overflow-x-hidden">
        <!-- Mobile Menu Overlay -->
        <div 
            v-if="sidebarOpen" 
            class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
            @click="toggleSidebar"
        ></div>

        <!-- Sidebar -->
        <StudentSidebar :user="user" :is-open="sidebarOpen" @close="toggleSidebar" />

        <!-- Main Content -->
        <div class="main-content-wrapper lg:ml-[260px] transition-all duration-300">
            <!-- Student Header -->
            <StudentHeader 
                :page-title="currentPageTitle"
                :page-subtitle="currentPageSubtitle"
                :user-name="user?.name || 'Student'"
                @toggle-sidebar="toggleSidebar"
            />

            <!-- Content Area -->
            <div class="main-content-area">
                <router-view :key="$route.fullPath" />
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import StudentSidebar from './StudentSidebar.vue';
import StudentHeader from './StudentHeader.vue';

export default {
    name: 'StudentPanel',
    components: {
        StudentSidebar,
        StudentHeader
    },
    setup() {
        const route = useRoute();
        const user = ref(null);
        const sidebarOpen = ref(false);

        const currentPageTitle = computed(() => {
            return route.meta?.title || 'Dashboard';
        });

        const currentPageSubtitle = computed(() => {
            return route.meta?.subtitle || 'Student Portal';
        });

        const toggleSidebar = () => {
            sidebarOpen.value = !sidebarOpen.value;
        };

        onMounted(() => {
            fetchUser();
        });

        watch(() => route.fullPath, () => {
            const contentArea = document.querySelector('.main-content-area');
            if (contentArea) {
                contentArea.scrollTo({ top: 0, behavior: 'smooth' });
            }
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const fetchUser = async () => {
            try {
                const response = await axios.get('/api/user');
                if (response.data.user) {
                    user.value = response.data.user;
                }
            } catch (error) {
                console.error('Error fetching user:', error);
                if (error.response && error.response.status === 401) {
                    window.location.href = '/login';
                }
            }
        };

        return {
            user,
            sidebarOpen,
            toggleSidebar,
            currentPageTitle,
            currentPageSubtitle
        };
    }
};
</script>

<style scoped>
.student-panel {
    width: 100%;
    overflow-x: hidden;
}

.main-content-wrapper {
    width: 100%;
    min-height: 100vh;
    max-width: 100%;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
}

@media (min-width: 1024px) {
    .main-content-wrapper {
        margin-left: 260px;
        width: calc(100% - 260px);
    }
}

.main-content-area {
    flex: 1;
    width: 100%;
    overflow-x: hidden;
    padding: 1rem;
    position: relative;
}

@media (min-width: 640px) {
    .main-content-area {
        padding: 1.5rem;
    }
}

@media (min-width: 768px) {
    .main-content-area {
        padding: 2rem;
    }
}
</style>







