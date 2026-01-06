<template>
    <transition
        enter-active-class="transition-all duration-300 ease-out"
        enter-from-class="opacity-0 translate-y-2 scale-95"
        enter-to-class="opacity-100 translate-y-0 scale-100"
        leave-active-class="transition-all duration-200 ease-in"
        leave-from-class="opacity-100 translate-y-0 scale-100"
        leave-to-class="opacity-0 translate-y-2 scale-95"
    >
        <div v-if="show" class="fixed top-4 right-4 z-[9999] max-w-md w-full sm:w-auto">
            <div 
                :class="[
                    'rounded-2xl shadow-2xl border-2 p-4 sm:p-5 backdrop-blur-sm transform transition-all duration-300',
                    type === 'success' 
                        ? 'bg-gradient-to-br from-green-50 to-emerald-50 border-green-200' 
                        : type === 'error'
                        ? 'bg-gradient-to-br from-red-50 to-pink-50 border-red-200'
                        : 'bg-gradient-to-br from-blue-50 to-indigo-50 border-blue-200'
                ]"
            >
                <div class="flex items-start space-x-4">
                    <!-- Icon -->
                    <div 
                        :class="[
                            'flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center',
                            type === 'success'
                                ? 'bg-gradient-to-br from-green-500 to-emerald-500'
                                : type === 'error'
                                ? 'bg-gradient-to-br from-red-500 to-pink-500'
                                : 'bg-gradient-to-br from-blue-500 to-indigo-500'
                        ]"
                    >
                        <svg v-if="type === 'success'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <svg v-else-if="type === 'error'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <svg v-else class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <h3 
                            :class="[
                                'text-lg font-bold mb-1',
                                type === 'success' 
                                    ? 'text-green-800' 
                                    : type === 'error'
                                    ? 'text-red-800'
                                    : 'text-blue-800'
                            ]"
                        >
                            {{ title }}
                        </h3>
                        <p 
                            :class="[
                                'text-sm',
                                type === 'success' 
                                    ? 'text-green-700' 
                                    : type === 'error'
                                    ? 'text-red-700'
                                    : 'text-blue-700'
                            ]"
                        >
                            {{ message }}
                        </p>
                    </div>

                    <!-- Close Button -->
                    <button 
                        @click="close"
                        :class="[
                            'flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center transition-all hover:scale-110',
                            type === 'success' 
                                ? 'text-green-600 hover:bg-green-100' 
                                : type === 'error'
                                ? 'text-red-600 hover:bg-red-100'
                                : 'text-blue-600 hover:bg-blue-100'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Progress Bar -->
                <div v-if="autoClose" class="mt-4 h-1 bg-white/30 rounded-full overflow-hidden">
                    <div 
                        :class="[
                            'h-full transition-all ease-linear',
                            type === 'success'
                                ? 'bg-gradient-to-r from-green-500 to-emerald-500'
                                : type === 'error'
                                ? 'bg-gradient-to-r from-red-500 to-pink-500'
                                : 'bg-gradient-to-r from-blue-500 to-indigo-500'
                        ]"
                        :style="{ width: progress + '%' }"
                    ></div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import { ref, watch, onMounted, onUnmounted } from 'vue';

export default {
    name: 'Toast',
    props: {
        show: {
            type: Boolean,
            default: false
        },
        type: {
            type: String,
            default: 'success',
            validator: (value) => ['success', 'error', 'info'].includes(value)
        },
        title: {
            type: String,
            default: 'Success'
        },
        message: {
            type: String,
            required: true
        },
        duration: {
            type: Number,
            default: 5000
        },
        autoClose: {
            type: Boolean,
            default: true
        }
    },
    emits: ['close'],
    setup(props, { emit }) {
        const progress = ref(100);
        let progressInterval = null;
        let closeTimeout = null;

        const close = () => {
            emit('close');
        };

        const startAutoClose = () => {
            if (!props.autoClose || !props.show) return;

            progress.value = 100;
            const interval = 50;
            const steps = props.duration / interval;
            const decrement = 100 / steps;

            progressInterval = setInterval(() => {
                progress.value -= decrement;
                if (progress.value <= 0) {
                    progress.value = 0;
                    clearInterval(progressInterval);
                    progressInterval = null;
                    close();
                }
            }, interval);

            closeTimeout = setTimeout(() => {
                close();
            }, props.duration);
        };

        const resetProgress = () => {
            progress.value = 100;
            if (progressInterval) {
                clearInterval(progressInterval);
                progressInterval = null;
            }
            if (closeTimeout) {
                clearTimeout(closeTimeout);
                closeTimeout = null;
            }
        };

        watch(() => props.show, (newVal) => {
            if (newVal) {
                resetProgress();
                if (props.autoClose) {
                    startAutoClose();
                }
            } else {
                resetProgress();
            }
        });

        onMounted(() => {
            if (props.show && props.autoClose) {
                startAutoClose();
            }
        });

        onUnmounted(() => {
            resetProgress();
        });

        return {
            progress,
            close
        };
    }
};
</script>

<style scoped>
/* Additional animations if needed */
</style>

