<template>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8 sm:mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full mb-4 sm:mb-6 shadow-lg">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-3 sm:mb-4">
                    Certificate Verification
                </h1>
                <p class="text-gray-600 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto">
                    Enter your certificate number to verify its authenticity
                </p>
            </div>

            <!-- Verification Form -->
            <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 lg:p-10 border border-gray-100 mb-8">
                <form @submit.prevent="verifyCertificate" class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Certificate Number
                        </label>
                        <input
                            v-model="certificateNumber"
                            type="text"
                            placeholder="Enter certificate number (e.g., CERT-XXXXXXXX-YYYY)"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 text-sm sm:text-base"
                            required
                        />
                    </div>
                    <button
                        type="submit"
                        :disabled="loading"
                        class="w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 text-white px-6 py-3 rounded-xl hover:from-indigo-600 hover:via-purple-600 hover:to-indigo-600 transition font-semibold shadow-lg shadow-indigo-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95 text-sm sm:text-base"
                    >
                        <span v-if="!loading" class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Verify Certificate</span>
                        </span>
                        <span v-else class="flex items-center justify-center space-x-2">
                            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Verifying...</span>
                        </span>
                    </button>
                </form>
            </div>

            <!-- Verification Result -->
            <div v-if="verificationResult" class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 lg:p-10 border border-gray-100">
                <!-- Valid Certificate -->
                <div v-if="verificationResult.valid && verificationResult.certificate" class="text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-green-600 mb-4">Certificate Verified!</h2>
                    <p class="text-gray-600 mb-8">This certificate is authentic and valid.</p>

                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl p-6 sm:p-8 border-2 border-indigo-200">
                        <div class="space-y-4 text-left">
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="font-semibold text-gray-700">Student Name:</span>
                                <span class="text-gray-900 font-bold">{{ verificationResult.certificate.user?.name }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="font-semibold text-gray-700">Course:</span>
                                <span class="text-gray-900 font-bold">{{ verificationResult.certificate.course?.name }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="font-semibold text-gray-700">Certificate Number:</span>
                                <span class="text-gray-900 font-mono font-bold">{{ verificationResult.certificate.certificate_number }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="font-semibold text-gray-700">Issue Date:</span>
                                <span class="text-gray-900">{{ formatDate(verificationResult.certificate.issue_date) }}</span>
                            </div>
                            <div v-if="verificationResult.certificate.expiry_date" class="flex justify-between items-center">
                                <span class="font-semibold text-gray-700">Valid Until:</span>
                                <span class="text-gray-900">{{ formatDate(verificationResult.certificate.expiry_date) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invalid Certificate -->
                <div v-else class="text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-red-400 to-pink-500 rounded-full mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-red-600 mb-4">Certificate Not Found</h2>
                    <p class="text-gray-600 mb-4">{{ verificationResult.message || 'The certificate number you entered is invalid or has been revoked.' }}</p>
                    <p class="text-sm text-gray-500">Please check the certificate number and try again.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

export default {
    name: 'CertificateVerify',
    setup() {
        const route = useRoute();
        const certificateNumber = ref(route.params.certificateNumber || '');
        const loading = ref(false);
        const verificationResult = ref(null);

        const verifyCertificate = async () => {
            if (!certificateNumber.value.trim()) {
                return;
            }

            loading.value = true;
            verificationResult.value = null;

            try {
                const response = await axios.get(`/api/certificates/verify/${certificateNumber.value.trim()}`);
                if (response.data.success) {
                    verificationResult.value = {
                        valid: true,
                        certificate: response.data.certificate
                    };
                } else {
                    verificationResult.value = {
                        valid: false,
                        message: response.data.message
                    };
                }
            } catch (err) {
                verificationResult.value = {
                    valid: false,
                    message: err.response?.data?.message || 'Certificate not found or invalid'
                };
            } finally {
                loading.value = false;
            }
        };

        const formatDate = (date) => {
            if (!date) return 'N/A';
            return new Date(date).toLocaleDateString('en-IN', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        };

        // Auto-verify if certificate number is in URL
        if (certificateNumber.value) {
            verifyCertificate();
        }

        return {
            certificateNumber,
            loading,
            verificationResult,
            verifyCertificate,
            formatDate
        };
    }
};
</script>







