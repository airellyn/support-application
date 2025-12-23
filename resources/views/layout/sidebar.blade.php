<!-- Sidebar -->
<div x-data="{ 
    open: false,
    menuStates: {
        bagDaily: false,
        antavaya: false,
        grabBag: false,
        processRecon: false,
        dsa: false,
        lpp: false,
        baRekonsiliasi: false
    },
    toggleMenu(menu) {
        // Jika ingin behavior hanya satu menu terbuka
        // Object.keys(this.menuStates).forEach(key => {
        //     if (key !== menu) this.menuStates[key] = false;
        // });
        this.menuStates[menu] = !this.menuStates[menu];
    }
}" class="relative">

    <!-- Mobile Toggle Button -->
    <button @click="open = !open"
        class="md:hidden p-3 text-gray-700 hover:text-black focus:outline-none fixed top-4 left-4 z-50 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 transition-transform duration-300" 
             :class="open ? 'rotate-90' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Overlay untuk mobile -->
    <div x-show="open" @click="open = false"
        class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-30 transition-opacity duration-300">
    </div>

    <!-- Sidebar Container -->
    <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed md:relative md:translate-x-0 top-0 left-0 h-screen w-64 md:w-72 lg:w-80 bg-white 
               border-r border-gray-200 shadow-lg md:shadow-none transition-all duration-300 ease-in-out
               md:static md:block z-40 flex flex-col transform-gpu overflow-hidden">

        <!-- Header dengan logo/icon -->
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Reconciliation System</h1>
                    <p class="text-xs text-gray-500 mt-1">Management Dashboard</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu (scrollable) -->
        <div class="flex-1 overflow-y-auto overflow-x-hidden py-4 px-3">
            <nav class="space-y-1">
                
                <!-- Bag (Antavaya) -->
                <div>
                    <button @click="toggleMenu('bagDaily')"
                        class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-blue-50 
                               rounded-xl hover:text-blue-700 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 
                                       rounded-lg group-hover:bg-blue-200 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <span class="font-medium">Bag (Antavaya)</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transition-transform duration-300" 
                             :class="menuStates.bagDaily ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="menuStates.bagDaily" x-collapse 
                         class="ml-12 mt-1 space-y-2 pl-2 border-l border-gray-200">
                        <a href="{{ route('bag.upload') }}" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-blue-500"></div>
                            <span>Upload</span>
                        </a>
                        <a href="{{ route('bag.index') }}" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-blue-500"></div>
                            <span>View Data</span>
                        </a>
                    </div>
                </div>

                <!-- Grab (Bag) -->
                <div>
                    <button @click="toggleMenu('grabBag')"
                        class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-green-50 
                               rounded-xl hover:text-green-700 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 flex items-center justify-center bg-green-100 text-green-600 
                                       rounded-lg group-hover:bg-green-200 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <span class="font-medium">Grab (Bag)</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transition-transform duration-300" 
                             :class="menuStates.grabBag ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="menuStates.grabBag" x-collapse 
                         class="ml-12 mt-1 space-y-2 pl-2 border-l border-gray-200">
                        <a href="{{ route('grab_bag.upload') }}" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-green-500"></div>
                            <span>Upload</span>
                        </a>
                        <a href="{{ route('grab_bag.index') }}" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-green-500"></div>
                            <span>View Data</span>
                        </a>
                    </div>
                </div>

                <!-- Antavaya -->
                <div>
                    <button @click="toggleMenu('antavaya')"
                        class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-purple-50 
                               rounded-xl hover:text-purple-700 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 flex items-center justify-center bg-purple-100 text-purple-600 
                                       rounded-lg group-hover:bg-purple-200 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <span class="font-medium">Antavaya</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transition-transform duration-300" 
                             :class="menuStates.antavaya ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="menuStates.antavaya" x-collapse 
                         class="ml-12 mt-1 space-y-2 pl-2 border-l border-gray-200">
                        <a href="{{ route('antavaya.upload') }}" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-purple-600 hover:bg-purple-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-purple-500"></div>
                            <span>Upload</span>
                        </a>
                        <a href="{{ route('antavaya.index') }}" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-purple-600 hover:bg-purple-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-purple-500"></div>
                            <span>View Data</span>
                        </a>
                    </div>
                </div>

                <!-- Process Reconciliation -->
                <div>
                    <button @click="toggleMenu('processRecon')"
                        class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-orange-50 
                               rounded-xl hover:text-orange-700 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 flex items-center justify-center bg-orange-100 text-orange-600 
                                       rounded-lg group-hover:bg-orange-200 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="font-medium">Process Reconciliation</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transition-transform duration-300" 
                             :class="menuStates.processRecon ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="menuStates.processRecon" x-collapse 
                         class="ml-12 mt-1 space-y-2 pl-2 border-l border-gray-200">
                        <a href="{{ route('rekon.index') }}" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-orange-600 hover:bg-orange-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-orange-500"></div>
                            <span>BAg & Antavaya</span>
                        </a>
                        <a href="#" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-orange-600 hover:bg-orange-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-orange-500"></div>
                            <span>BAg & Grab</span>
                        </a>
                        <a href="#" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-orange-600 hover:bg-orange-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-orange-500"></div>
                            <span>DSA & Vinotek</span>
                        </a>
                    </div>
                </div>

                <!-- DSA -->
                <div>
                    <button @click="toggleMenu('dsa')"
                        class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-red-50 
                               rounded-xl hover:text-red-700 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-600 
                                       rounded-lg group-hover:bg-red-200 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-3a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
                                </svg>
                            </div>
                            <span class="font-medium">DSA</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transition-transform duration-300" 
                             :class="menuStates.dsa ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="menuStates.dsa" x-collapse 
                         class="ml-12 mt-1 space-y-2 pl-2 border-l border-gray-200">
                        <a href="#" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-red-500"></div>
                            <span>Data DSA</span>
                        </a>
                        <a href="#" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-red-500"></div>
                            <span>Data Vinotek</span>
                        </a>
                    </div>
                </div>

                <!-- LPP -->
                <div>
                    <button @click="toggleMenu('lpp')"
                        class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-teal-50 
                               rounded-xl hover:text-teal-700 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 flex items-center justify-center bg-teal-100 text-teal-600 
                                       rounded-lg group-hover:bg-teal-200 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <span class="font-medium">LPP</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transition-transform duration-300" 
                             :class="menuStates.lpp ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="menuStates.lpp" x-collapse 
                         class="ml-12 mt-1 space-y-2 pl-2 border-l border-gray-200">
                        <a href="{{ route('lpp.index') }}" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-teal-600 hover:bg-teal-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-teal-500"></div>
                            <span>Rekap LPP</span>
                        </a>
                    </div>
                </div>

                <!-- BA Rekonsiliasi -->
                <div>
                    <button @click="toggleMenu('baRekonsiliasi')"
                        class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-indigo-50 
                               rounded-xl hover:text-indigo-700 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 flex items-center justify-center bg-indigo-100 text-indigo-600 
                                       rounded-lg group-hover:bg-indigo-200 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="font-medium">BA Rekonsiliasi</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transition-transform duration-300" 
                             :class="menuStates.baRekonsiliasi ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="menuStates.baRekonsiliasi" x-collapse 
                         class="ml-12 mt-1 space-y-2 pl-2 border-l border-gray-200">
                        <a href="{{ route('ba-rekonsiliasi.index') }}" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-indigo-500"></div>
                            <span>List BA</span>
                        </a>
                        <a href="{{ route('ba-rekonsiliasi.create') }}" 
                           class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 
                                  rounded-lg transition-colors group/sub">
                            <div class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3 group-hover/sub:bg-indigo-500"></div>
                            <span>Buat BA Baru</span>
                        </a>
                    </div>
                </div>

            </nav>
        </div>

        <!-- Footer dengan user info dan logout -->
        <div class="p-4 border-t border-gray-100 bg-gray-50 mt-auto">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-gray-600 to-gray-800 rounded-full flex items-center justify-center">
                    <span class="text-white font-semibold text-sm">{{ substr(auth()->user()->name ?? 'User', 0, 1) }}</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name ?? 'User' }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                </div>
            </div>
            
            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center justify-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 
                               rounded-lg transition-colors border border-gray-300 hover:border-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
            
            <!-- Copyright -->
            <div class="text-xs text-gray-500 text-center mt-3 pt-3 border-t border-gray-200">
                © {{ date('Y') }} Reconciliation System v1.0
            </div>
        </div>

    </aside>

</div>