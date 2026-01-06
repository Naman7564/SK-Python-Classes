<template>
    <footer class="bg-gradient-to-br from-gray-900 via-blue-900 to-indigo-900 text-white relative overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="py-8 sm:py-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                    <!-- About Section -->
                    <div class="lg:col-span-1">
                        <div class="flex items-center space-x-2 mb-3">
                            <img 
                                v-if="brandSettings.brand_logo_url" 
                                :src="brandSettings.brand_logo_url" 
                                :alt="brandSettings.brand_name"
                                class="h-10 sm:h-12 w-auto object-contain"
                            />
                            <div 
                                v-else
                                class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center"
                            >
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">
                                {{ brandSettings.brand_name || 'SK Python Classes' }}
                            </h3>
                        </div>
                        <p class="text-gray-300 text-xs sm:text-sm leading-relaxed mb-3">
                            {{ brandSettings.tagline || 'Premier coaching institute for Python programming. Learn from experts and build your career in tech.' }}
                        </p>
                        <!-- Social Media -->
                        <div class="flex space-x-2">
                            <a 
                                v-if="brandSettings.facebook" 
                                :href="brandSettings.facebook" 
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-9 h-9 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center hover:scale-110 transition-transform shadow-lg hover:shadow-blue-500/50"
                            >
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <div 
                                v-else
                                class="w-9 h-9 bg-gradient-to-br from-blue-600/50 to-blue-700/50 rounded-lg flex items-center justify-center opacity-60 cursor-not-allowed"
                            >
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </div>
                            
                            <a 
                                v-if="brandSettings.instagram" 
                                :href="brandSettings.instagram" 
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-9 h-9 bg-gradient-to-br from-pink-600 to-purple-600 rounded-lg flex items-center justify-center hover:scale-110 transition-transform shadow-lg hover:shadow-pink-500/50"
                            >
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </a>
                            <div 
                                v-else
                                class="w-9 h-9 bg-gradient-to-br from-pink-600/50 to-purple-600/50 rounded-lg flex items-center justify-center opacity-60 cursor-not-allowed"
                            >
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </div>
                            
                            <a 
                                v-if="brandSettings.youtube" 
                                :href="brandSettings.youtube" 
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-9 h-9 bg-gradient-to-br from-red-600 to-red-700 rounded-lg flex items-center justify-center hover:scale-110 transition-transform shadow-lg hover:shadow-red-500/50"
                            >
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                            <div 
                                v-else
                                class="w-9 h-9 bg-gradient-to-br from-red-600/50 to-red-700/50 rounded-lg flex items-center justify-center opacity-60 cursor-not-allowed"
                            >
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </div>
                            
                            <a 
                                v-if="brandSettings.twitter" 
                                :href="brandSettings.twitter" 
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-9 h-9 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-lg flex items-center justify-center hover:scale-110 transition-transform shadow-lg hover:shadow-cyan-500/50"
                            >
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <div 
                                v-else
                                class="w-9 h-9 bg-gradient-to-br from-cyan-500/50 to-blue-500/50 rounded-lg flex items-center justify-center opacity-60 cursor-not-allowed"
                            >
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-base sm:text-lg font-bold mb-4 text-blue-300 flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            Quick Links
                        </h4>
                        <ul class="space-y-2">
                            <li>
                                <router-link to="/" class="text-gray-300 hover:text-blue-400 transition flex items-center group">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition"></span>
                                    <span>Home</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/courses" class="text-gray-300 hover:text-blue-400 transition flex items-center group">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition"></span>
                                    <span>Courses</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/contact" class="text-gray-300 hover:text-blue-400 transition flex items-center group">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition"></span>
                                    <span>Contact</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/inquiry" class="text-gray-300 hover:text-blue-400 transition flex items-center group">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition"></span>
                                    <span>Inquiry</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/about-us" class="text-gray-300 hover:text-blue-400 transition flex items-center group">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition"></span>
                                    <span>About Us</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h4 class="text-base sm:text-lg font-bold mb-4 text-indigo-300 flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Contact Us
                        </h4>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <div class="w-7 h-7 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 mr-2.5 mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-300 text-xs sm:text-sm">
                                        <a v-if="contactInfo.email" :href="`mailto:${contactInfo.email}`" class="hover:text-blue-400 transition break-all">
                                            {{ contactInfo.email }}
                                        </a>
                                        <span v-else class="text-gray-500 italic">Not set</span>
                                    </p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="w-7 h-7 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0 mr-2.5 mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-300 text-xs sm:text-sm">
                                        <a v-if="contactInfo.phone" :href="`tel:${contactInfo.phone}`" class="hover:text-green-400 transition">
                                            {{ contactInfo.phone }}
                                        </a>
                                        <span v-else class="text-gray-500 italic">Not set</span>
                                    </p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="w-7 h-7 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center flex-shrink-0 mr-2.5 mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p v-if="contactInfo.address" class="text-gray-300 text-xs sm:text-sm">{{ contactInfo.address }}</p>
                                    <p v-else class="text-gray-500 italic text-xs sm:text-sm">Not set</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Newsletter/Info -->
                    <div>
                        <h4 class="text-base sm:text-lg font-bold mb-4 text-purple-300 flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Stay Updated
                        </h4>
                        <p class="text-gray-300 text-xs sm:text-sm mb-3 leading-relaxed">
                            Follow us on social media to stay updated with the latest courses, tips, and programming resources.
                        </p>
                        <router-link 
                            to="/inquiry"
                            class="inline-flex items-center px-3 sm:px-4 py-2 sm:py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-lg text-xs sm:text-sm font-semibold text-white transition shadow-lg hover:shadow-xl transform hover:scale-105"
                        >
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Get In Touch
                        </router-link>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700/50 pt-5 sm:pt-6 pb-4 sm:pb-5">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                    <p class="text-gray-400 text-xs sm:text-sm">
                        &copy; {{ currentYear }} <span class="font-semibold text-blue-400">{{ brandSettings.brand_name || 'SK Python Classes' }}</span>. All rights reserved.
                    </p>
                    <div class="flex items-center space-x-4 sm:space-x-6 text-xs sm:text-sm text-gray-400">
                        <a href="/inquiry" class="hover:text-blue-400 transition">Privacy Policy</a>
                        <a href="/inquiry" class="hover:text-blue-400 transition">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'Footer',
    setup() {
        const currentYear = computed(() => {
            return new Date().getFullYear();
        });

        const brandSettings = ref({
            brand_name: 'SK Python Classes',
            brand_logo_url: null,
            tagline: '',
            facebook: '',
            instagram: '',
            youtube: '',
            twitter: ''
        });

        const contactInfo = ref({
            email: '',
            phone: '',
            address: ''
        });

        const fetchBrandSettings = async () => {
            try {
                const response = await axios.get('/api/brand-settings');
                if (response.data.success && response.data.settings) {
                    const settings = response.data.settings;
                    brandSettings.value = {
                        brand_name: settings.brand_name || 'SK Python Classes',
                        brand_logo_url: settings.brand_logo_url || (settings.brand_logo ? `/storage/${settings.brand_logo}` : null),
                        tagline: settings.tagline || '',
                        facebook: settings.facebook || '',
                        instagram: settings.instagram || '',
                        youtube: settings.youtube || '',
                        twitter: settings.twitter || ''
                    };
                    contactInfo.value = {
                        email: settings.email || '',
                        phone: settings.phone || '',
                        address: settings.address || ''
                    };
                    // Debug: Log social media links
                    console.log('Social Media Links:', {
                        facebook: brandSettings.value.facebook,
                        instagram: brandSettings.value.instagram,
                        youtube: brandSettings.value.youtube,
                        twitter: brandSettings.value.twitter
                    });
                }
            } catch (error) {
                console.error('Error fetching brand settings:', error);
            }
        };

        onMounted(() => {
            fetchBrandSettings();
        });

        return {
            currentYear,
            brandSettings,
            contactInfo
        };
    }
};
</script>

<style scoped>
.container {
    max-width: 1200px;
    margin: 0 auto;
}
</style>



