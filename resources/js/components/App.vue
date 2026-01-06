<template>
    <div id="app">
        <router-view />
        
        <!-- WhatsApp Button - Show on all pages except admin panel -->
        <WhatsAppButton v-if="!isAdminPanel" />
    </div>
</template>

<script>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import WhatsAppButton from './WhatsAppButton.vue';

export default {
    name: 'App',
    components: {
        WhatsAppButton
    },
    setup() {
        const route = useRoute();
        
        const isAdminPanel = computed(() => {
            return route.path.startsWith('/admin-panel') || route.path.startsWith('/dashboard');
        });

        return {
            isAdminPanel
        };
    }
};
</script>

<style>
#app {
    width: 100%;
}
</style>

