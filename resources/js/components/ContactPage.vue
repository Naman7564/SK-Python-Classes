<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/20 to-purple-50/20">
        <Header />
        
        <!-- Contact Section -->
        <section class="py-8 sm:py-12 lg:py-16">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
                <!-- Page Header -->
                <div class="text-center mb-8 sm:mb-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl sm:rounded-2xl shadow-xl mb-4 sm:mb-6">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-600 bg-clip-text text-transparent mb-3 sm:mb-4 px-2">
                        Contact Us
                    </h1>
                    <p class="text-sm sm:text-base lg:text-lg text-gray-600 max-w-2xl mx-auto px-2">
                        Have a question? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 mb-8 sm:mb-12">
                    <!-- Contact Info Cards -->
                    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 p-5 sm:p-6 text-center">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Email</h3>
                        <a 
                            v-if="contactInfo.email" 
                            :href="`mailto:${contactInfo.email}`"
                            class="text-sm sm:text-base text-blue-600 hover:text-blue-700 break-all transition"
                        >
                            {{ contactInfo.email }}
                        </a>
                        <p v-else class="text-sm sm:text-base text-gray-500 italic">Not set</p>
                    </div>

                    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 p-5 sm:p-6 text-center">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Phone</h3>
                        <a 
                            v-if="contactInfo.phone" 
                            :href="`tel:${contactInfo.phone}`"
                            class="text-sm sm:text-base text-blue-600 hover:text-blue-700 transition"
                        >
                            {{ contactInfo.phone }}
                        </a>
                        <p v-else class="text-sm sm:text-base text-gray-500 italic">Not set</p>
                    </div>

                    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 p-5 sm:p-6 text-center">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Location</h3>
                        <p v-if="contactInfo.address" class="text-sm sm:text-base text-gray-600">{{ contactInfo.address }}</p>
                        <p v-else class="text-sm sm:text-base text-gray-500 italic">Not set</p>
                    </div>
                </div>

                <!-- Inquiry Form Card -->
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500 p-4 sm:p-6 lg:p-8">
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white mb-1 sm:mb-2">Send Us a Message</h2>
                        <p class="text-blue-100 text-xs sm:text-sm lg:text-base">Fill out the form below and we'll get back to you</p>
                    </div>

                    <div class="p-4 sm:p-6 lg:p-8 xl:p-10">
                        <form @submit.prevent="submitInquiry" class="space-y-4 sm:space-y-5 lg:space-y-6">
                            <!-- Name Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-1.5 sm:mr-2 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class="text-xs sm:text-sm">Full Name <span class="text-red-500">*</span></span>
                                </label>
                                <input 
                                    type="text" 
                                    v-model="form.name" 
                                    placeholder="Enter your full name"
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Email and Phone Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 lg:gap-6">
                                <!-- Email Field -->
                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-1.5 sm:mr-2 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs sm:text-sm">Email Address <span class="text-red-500">*</span></span>
                                    </label>
                                    <input 
                                        type="email" 
                                        v-model="form.email" 
                                        placeholder="your.email@example.com"
                                        class="form-input-modern"
                                        required
                                    >
                                </div>

                                <!-- Phone Field -->
                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-1.5 sm:mr-2 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span class="text-xs sm:text-sm">Phone Number <span class="text-red-500">*</span></span>
                                    </label>
                                    <input 
                                        type="tel" 
                                        v-model="form.phone" 
                                        placeholder="+91 98765 43210"
                                        class="form-input-modern"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Subject Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-1.5 sm:mr-2 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-7 4h7" />
                                    </svg>
                                    <span class="text-xs sm:text-sm">Subject <span class="text-red-500">*</span></span>
                                </label>
                                <input 
                                    type="text" 
                                    v-model="form.subject" 
                                    placeholder="What is your inquiry about?"
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Message Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-1.5 sm:mr-2 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                                    </svg>
                                    <span class="text-xs sm:text-sm">Message <span class="text-red-500">*</span></span>
                                </label>
                                <textarea 
                                    v-model="form.message" 
                                    rows="5"
                                    placeholder="Please describe your inquiry in detail..."
                                    class="form-input-modern resize-vertical min-h-[120px] sm:min-h-[150px]"
                                    required
                                ></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex flex-col gap-3 sm:gap-4 pt-2 sm:pt-4">
                                <button 
                                    type="submit" 
                                    :disabled="loading"
                                    class="w-full px-5 sm:px-6 py-3 sm:py-3.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500 text-white rounded-lg sm:rounded-xl hover:from-blue-600 hover:via-indigo-600 hover:to-blue-600 transition font-semibold text-sm sm:text-base shadow-lg shadow-blue-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center space-x-2 touch-manipulation"
                                >
                                    <span v-if="!loading" class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        <span>Send Message</span>
                                    </span>
                                    <span v-else class="flex items-center space-x-2">
                                        <svg class="animate-spin w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span>Sending...</span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <Footer />

        <!-- Toast Notification -->
        <Toast 
            :show="showToast" 
            :type="toastType"
            :title="toastTitle"
            :message="toastMessage"
            :duration="5000"
            @close="showToast = false"
        />
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import Header from './Header.vue';
import Footer from './Footer.vue';
import Toast from './Toast.vue';

export default {
    name: 'ContactPage',
    components: {
        Header,
        Footer,
        Toast
    },
    setup() {
        const router = useRouter();
        const form = ref({
            name: '',
            email: '',
            phone: '',
            subject: '',
            message: ''
        });

        const contactInfo = ref({
            email: '',
            phone: '',
            address: ''
        });

        const loading = ref(false);
        const showToast = ref(false);
        const toastType = ref('success');
        const toastTitle = ref('Success');
        const toastMessage = ref('');

        const fetchBrandSettings = async () => {
            try {
                const response = await axios.get('/api/brand-settings');
                if (response.data.success && response.data.settings) {
                    const settings = response.data.settings;
                    contactInfo.value = {
                        email: settings.email || '',
                        phone: settings.phone || '',
                        address: settings.address || ''
                    };
                }
            } catch (error) {
                console.error('Error fetching brand settings:', error);
            }
        };

        const submitInquiry = async () => {
            loading.value = true;
            showToast.value = false;

            try {
                const response = await axios.post('/api/queries', form.value);
                
                if (response.data.success) {
                    // Show success toast
                    toastType.value = 'success';
                    toastTitle.value = 'Message Sent Successfully!';
                    toastMessage.value = 'Your message has been sent successfully! We will contact you shortly.';
                    showToast.value = true;
                    
                    // Reset form
                    form.value = {
                        name: '',
                        email: '',
                        phone: '',
                        subject: '',
                        message: ''
                    };
                }
            } catch (error) {
                console.error('Error submitting inquiry:', error);
                // Show error toast
                toastType.value = 'error';
                toastTitle.value = 'Failed to Send';
                toastMessage.value = error.response?.data?.message || 'Failed to send message. Please try again.';
                showToast.value = true;
            } finally {
                loading.value = false;
            }
        };

        onMounted(() => {
            fetchBrandSettings();
        });

        return {
            form,
            contactInfo,
            loading,
            showToast,
            toastType,
            toastTitle,
            toastMessage,
            submitInquiry
        };
    }
};
</script>

<style scoped>
.container {
    max-width: 1280px;
    margin: 0 auto;
}

.form-field-group {
    position: relative;
}

.form-label {
    display: flex;
    align-items: center;
    font-size: 0.75rem;
    font-weight: 600;
    color: #4b5563;
    margin-bottom: 0.5rem;
    letter-spacing: -0.01em;
    flex-wrap: wrap;
    gap: 0.25rem;
}

@media (min-width: 640px) {
    .form-label {
        font-size: 0.875rem;
    }
}

.form-input-modern {
    width: 100%;
    padding: 0.75rem 0.875rem;
    font-size: 0.875rem;
    color: #1f2937;
    background: #ffffff;
    border: 2px solid #e5e7eb;
    border-radius: 0.625rem;
    transition: all 0.2s ease;
    outline: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    touch-action: manipulation;
}

@media (min-width: 640px) {
    .form-input-modern {
        padding: 0.875rem 1rem;
        font-size: 0.9375rem;
        border-radius: 0.75rem;
    }
}

.form-input-modern:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    background: #ffffff;
}

.form-input-modern::placeholder {
    color: #9ca3af;
    font-size: 0.875rem;
}

@media (min-width: 640px) {
    .form-input-modern::placeholder {
        font-size: 0.9375rem;
    }
}

/* Improve touch targets for mobile */
button, a {
    min-height: 44px;
    min-width: 44px;
}

/* Prevent zoom on input focus on iOS */
@media screen and (max-width: 768px) {
    input[type="text"],
    input[type="email"],
    input[type="tel"],
    textarea {
        font-size: 16px !important;
    }
}
</style>

