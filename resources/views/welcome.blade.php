<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomBook — Discussion Room Booking</title>
    <meta name="description" content="Find, check availability, and book discussion rooms in seconds.">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Plus Jakarta Sans"', 'sans-serif'],
                        body: ['"Inter"', 'sans-serif'],
                    },
                    colors: {
                        navy: {
                            950: '#0B1220',
                            900: '#0F1B33',
                            800: '#14264A',
                            700: '#1B3363',
                        },
                        brand: {
                            50:  '#EEF4FF',
                            100: '#E0EBFF',
                            400: '#5B8DEF',
                            500: '#3B6FE0',
                            600: '#2B57C7',
                        },
                        cyan: {
                            400: '#22D3EE',
                        }
                    },
                    boxShadow: {
                        soft: '0 8px 30px -12px rgba(15, 27, 51, 0.25)',
                        card: '0 4px 20px -6px rgba(15, 27, 51, 0.12)',
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-display { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        .grain-line {
            background-image: linear-gradient(to right, rgba(15,27,51,0.06) 1px, transparent 1px);
            background-size: 100% 1px;
        }
    </style>
</head>
<body class="bg-white text-navy-900 antialiased">

    <!-- ===================== NAVBAR ===================== -->
    <header
        x-data="{ open: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 12)"
        :class="scrolled ? 'bg-white/90 backdrop-blur border-b border-slate-200 shadow-sm' : 'bg-white/0 border-b border-transparent'"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    >
        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">

                <!-- Logo -->
                <a href="#" class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-navy-900 flex items-center justify-center">
                        <i data-lucide="door-open" class="w-4.5 h-4.5 text-white" style="width:18px;height:18px"></i>
                    </span>
                    <span class="leading-tight">
                        <span class="block font-display font-bold text-[17px] text-navy-900">RoomBook</span>
                        <span class="block text-[11px] text-slate-500 -mt-0.5">Discussion Room Booking</span>
                    </span>
                </a>

                <!-- Desktop nav -->
                <nav class="hidden md:flex items-center gap-9 text-sm font-medium text-slate-600">
                    <a href="#home" class="hover:text-navy-900 transition-colors">Home</a>
                    <a href="#rooms" class="hover:text-navy-900 transition-colors">Rooms</a>
                    <a href="#schedule" class="hover:text-navy-900 transition-colors">Schedule</a>
                    <a href="#how-it-works" class="hover:text-navy-900 transition-colors">How It Works</a>
                </nav>

                <div class="hidden md:block">
                    <a href="#search" class="inline-flex items-center gap-2 bg-navy-900 hover:bg-navy-800 text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-colors">
                        Book a Room
                        <i data-lucide="arrow-up-right" style="width:15px;height:15px"></i>
                    </a>
                </div>

                <!-- Mobile toggle -->
                <button @click="open = !open" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg text-navy-900">
                    <i x-show="!open" data-lucide="menu" style="width:22px;height:22px"></i>
                    <i x-show="open" x-cloak data-lucide="x" style="width:22px;height:22px"></i>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" x-cloak x-transition class="md:hidden bg-white border-t border-slate-200 px-5 py-5 space-y-4">
            <a @click="open=false" href="#home" class="block text-slate-700 font-medium">Home</a>
            <a @click="open=false" href="#rooms" class="block text-slate-700 font-medium">Rooms</a>
            <a @click="open=false" href="#schedule" class="block text-slate-700 font-medium">Schedule</a>
            <a @click="open=false" href="#how-it-works" class="block text-slate-700 font-medium">How It Works</a>
            <a @click="open=false" href="#search" class="block text-center bg-navy-900 text-white font-semibold px-5 py-3 rounded-full">Book a Room</a>
        </div>
    </header>

    <!-- ===================== HERO ===================== -->
    <section id="home" class="relative pt-32 pb-20 sm:pt-40 sm:pb-28 overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-brand-50/60 via-white to-white"></div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 grid lg:grid-cols-2 gap-14 items-center">

            <div>
                <span class="inline-flex items-center gap-2 text-xs font-semibold text-brand-600 bg-brand-50 px-3.5 py-1.5 rounded-full">
                    <i data-lucide="check-circle-2" style="width:14px;height:14px"></i>
                    Live availability, updated in real time
                </span>

                <h1 class="mt-6 font-display font-bold text-4xl sm:text-5xl lg:text-[3.4rem] leading-[1.1] text-navy-900">
                    Find a room.<br>Book your space.
                </h1>

                <p class="mt-6 text-slate-600 text-base sm:text-lg leading-relaxed max-w-md">
                    Search discussion rooms and meeting spaces across campus, check what's free right now, and confirm your booking in under a minute.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="#search" class="inline-flex items-center justify-center gap-2 bg-navy-900 hover:bg-navy-800 text-white font-semibold px-6 py-3.5 rounded-full transition-colors">
                        Book a Room
                        <i data-lucide="arrow-right" style="width:16px;height:16px"></i>
                    </a>
                    <a href="#schedule" class="inline-flex items-center justify-center gap-2 bg-white border border-slate-200 hover:border-navy-900 text-navy-900 font-semibold px-6 py-3.5 rounded-full transition-colors">
                        View Schedule
                    </a>
                </div>

                <div class="mt-10 flex items-center gap-8 text-sm text-slate-500">
                    <div>
                        <p class="font-display font-bold text-2xl text-navy-900">24</p>
                        <p>Rooms available</p>
                    </div>
                    <div class="w-px h-9 bg-slate-200"></div>
                    <div>
                        <p class="font-display font-bold text-2xl text-navy-900">3</p>
                        <p>Buildings covered</p>
                    </div>
                    <div class="w-px h-9 bg-slate-200"></div>
                    <div>
                        <p class="font-display font-bold text-2xl text-navy-900">2 min</p>
                        <p>Average booking time</p>
                    </div>
                </div>
            </div>

            <!-- Hero mockup -->
            <div class="relative">
                <div class="absolute -top-6 -right-6 w-40 h-40 bg-brand-100 rounded-full blur-3xl opacity-60 -z-10"></div>

                <div class="bg-white border border-slate-200 rounded-2xl shadow-soft p-6 max-w-sm ml-auto">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-display font-semibold text-navy-900">Discussion Room 02</p>
                            <p class="text-xs text-slate-500 mt-0.5">Level 2 · Capacity 8</p>
                        </div>
                        <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Available</span>
                    </div>

                    <div class="mt-5 space-y-2">
                        <div class="flex items-center justify-between text-sm px-3 py-2.5 rounded-xl bg-slate-50 border border-slate-100">
                            <span class="text-slate-500">10:00 AM – 12:00 PM</span>
                            <span class="text-xs font-medium text-rose-500">Booked</span>
                        </div>
                        <div class="flex items-center justify-between text-sm px-3 py-2.5 rounded-xl bg-brand-50 border border-brand-100">
                            <span class="text-navy-900 font-medium">12:00 PM – 02:00 PM</span>
                            <span class="text-xs font-medium text-emerald-600">Available</span>
                        </div>
                        <div class="flex items-center justify-between text-sm px-3 py-2.5 rounded-xl bg-brand-50 border border-brand-100">
                            <span class="text-navy-900 font-medium">02:00 PM – 04:00 PM</span>
                            <span class="text-xs font-medium text-emerald-600">Available</span>
                        </div>
                    </div>

                    <button class="mt-5 w-full bg-navy-900 text-white text-sm font-semibold py-2.5 rounded-xl hover:bg-navy-800 transition-colors">
                        Book This Slot
                    </button>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl shadow-card p-4 max-w-[220px] mt-4 -translate-x-4">
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-2">
                        <i data-lucide="calendar-days" style="width:14px;height:14px"></i>
                        Today's Schedule
                    </div>
                    <div class="flex items-center gap-2 text-xs text-navy-900 mb-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
                        10:00 — Room 01
                    </div>
                    <div class="flex items-center gap-2 text-xs text-navy-900">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                        14:00 — Meeting Room A
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== QUICK AVAILABILITY / SEARCH ===================== -->
    <section id="search" class="px-5 sm:px-8 -mt-6 sm:mt-0 relative z-10">
        <div class="max-w-5xl mx-auto bg-navy-900 rounded-3xl shadow-soft p-6 sm:p-10">
            <div class="flex items-center gap-2 text-brand-400 text-xs font-semibold mb-2">
                <i data-lucide="search" style="width:14px;height:14px"></i>
                Quick availability check
            </div>
            <h2 class="font-display font-bold text-white text-2xl sm:text-3xl mb-6">
                Check what's free before you commit
            </h2>

            <form class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="lg:col-span-1">
                    <label class="block text-xs font-medium text-slate-300 mb-1.5">Date</label>
                    <input type="date" class="w-full rounded-xl border-0 bg-white/95 px-4 py-3 text-sm text-navy-900 focus:ring-2 focus:ring-brand-400 outline-none">
                </div>
                <div class="lg:col-span-1">
                    <label class="block text-xs font-medium text-slate-300 mb-1.5">Start Time</label>
                    <input type="time" class="w-full rounded-xl border-0 bg-white/95 px-4 py-3 text-sm text-navy-900 focus:ring-2 focus:ring-brand-400 outline-none">
                </div>
                <div class="lg:col-span-1">
                    <label class="block text-xs font-medium text-slate-300 mb-1.5">End Time</label>
                    <input type="time" class="w-full rounded-xl border-0 bg-white/95 px-4 py-3 text-sm text-navy-900 focus:ring-2 focus:ring-brand-400 outline-none">
                </div>
                <div class="lg:col-span-1">
                    <label class="block text-xs font-medium text-slate-300 mb-1.5">Participants</label>
                    <input type="number" min="1" placeholder="e.g. 6" class="w-full rounded-xl border-0 bg-white/95 px-4 py-3 text-sm text-navy-900 placeholder:text-slate-400 focus:ring-2 focus:ring-brand-400 outline-none">
                </div>
                <div class="lg:col-span-1 flex items-end">
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-semibold px-5 py-3 rounded-xl transition-colors">
                        Check Availability
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- ===================== AVAILABLE ROOMS ===================== -->
    <section id="rooms" class="max-w-7xl mx-auto px-5 sm:px-8 pt-24 pb-16">
        <div class="max-w-xl mb-12">
            <p class="text-xs font-semibold text-brand-600 mb-2">Available now</p>
            <h2 class="font-display font-bold text-3xl sm:text-4xl text-navy-900">Rooms ready to book</h2>
            <p class="mt-3 text-slate-600">A snapshot of spaces across the building, with capacity and facilities at a glance.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="group bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-card hover:border-brand-200 transition-all">
                <div class="flex items-start justify-between">
                    <span class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center">
                        <i data-lucide="users" class="text-brand-600" style="width:20px;height:20px"></i>
                    </span>
                    <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Available</span>
                </div>
                <h3 class="font-display font-semibold text-lg text-navy-900 mt-4">Discussion Room 01</h3>
                <p class="text-sm text-slate-500 mt-1">Level 1 · Capacity 6</p>
                <div class="flex flex-wrap gap-2 mt-4">
                    <span class="text-xs text-slate-600 bg-slate-50 border border-slate-100 px-2.5 py-1 rounded-full">Whiteboard</span>
                    <span class="text-xs text-slate-600 bg-slate-50 border border-slate-100 px-2.5 py-1 rounded-full">Display</span>
                </div>
                <a href="#" class="mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-navy-900 group-hover:text-brand-600 transition-colors">
                    View Room
                    <i data-lucide="arrow-right" style="width:14px;height:14px"></i>
                </a>
            </div>

            <div class="group bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-card hover:border-brand-200 transition-all">
                <div class="flex items-start justify-between">
                    <span class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center">
                        <i data-lucide="monitor" class="text-brand-600" style="width:20px;height:20px"></i>
                    </span>
                    <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Available</span>
                </div>
                <h3 class="font-display font-semibold text-lg text-navy-900 mt-4">Discussion Room 02</h3>
                <p class="text-sm text-slate-500 mt-1">Level 2 · Capacity 8</p>
                <div class="flex flex-wrap gap-2 mt-4">
                    <span class="text-xs text-slate-600 bg-slate-50 border border-slate-100 px-2.5 py-1 rounded-full">Smart TV</span>
                    <span class="text-xs text-slate-600 bg-slate-50 border border-slate-100 px-2.5 py-1 rounded-full">Whiteboard</span>
                </div>
                <a href="#" class="mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-navy-900 group-hover:text-brand-600 transition-colors">
                    View Room
                    <i data-lucide="arrow-right" style="width:14px;height:14px"></i>
                </a>
            </div>

            <div class="group bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-card hover:border-brand-200 transition-all">
                <div class="flex items-start justify-between">
                    <span class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center">
                        <i data-lucide="presentation" class="text-brand-600" style="width:20px;height:20px"></i>
                    </span>
                    <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Available</span>
                </div>
                <h3 class="font-display font-semibold text-lg text-navy-900 mt-4">Meeting Room A</h3>
                <p class="text-sm text-slate-500 mt-1">Level 3 · Capacity 12</p>
                <div class="flex flex-wrap gap-2 mt-4">
                    <span class="text-xs text-slate-600 bg-slate-50 border border-slate-100 px-2.5 py-1 rounded-full">Projector</span>
                    <span class="text-xs text-slate-600 bg-slate-50 border border-slate-100 px-2.5 py-1 rounded-full">Video Conference</span>
                </div>
                <a href="#" class="mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-navy-900 group-hover:text-brand-600 transition-colors">
                    View Room
                    <i data-lucide="arrow-right" style="width:14px;height:14px"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- ===================== SCHEDULE / CALENDAR PREVIEW ===================== -->
    <section id="schedule" class="bg-navy-950 py-24">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 grid lg:grid-cols-2 gap-12 items-center">

            <div>
                <p class="text-xs font-semibold text-cyan-400 mb-2">Full visibility</p>
                <h2 class="font-display font-bold text-3xl sm:text-4xl text-white">See the week at a glance</h2>
                <p class="mt-4 text-slate-400 leading-relaxed max-w-md">
                    Every booking is reflected instantly on a shared calendar, so you always know which slots are open before you plan around them.
                </p>
                <a href="#" class="mt-7 inline-flex items-center gap-2 bg-white text-navy-900 font-semibold px-5 py-3 rounded-full hover:bg-slate-100 transition-colors">
                    View Full Schedule
                    <i data-lucide="arrow-right" style="width:15px;height:15px"></i>
                </a>
            </div>

            <div class="bg-navy-900 border border-white/10 rounded-2xl p-5 sm:p-6">
                <div class="grid grid-cols-5 gap-2 text-center text-xs font-semibold text-slate-400 mb-4">
                    <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span>
                </div>
                <div class="grid grid-cols-5 gap-2">
                    <div class="space-y-2">
                        <div class="bg-brand-500/20 border border-brand-400/30 rounded-lg px-2 py-2">
                            <p class="text-[10px] text-brand-300 font-medium">10:00</p>
                            <p class="text-[11px] text-white">Room 01</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="bg-white/5 border border-white/10 rounded-lg h-16"></div>
                    </div>
                    <div class="space-y-2">
                        <div class="bg-cyan-400/10 border border-cyan-400/30 rounded-lg px-2 py-2">
                            <p class="text-[10px] text-cyan-300 font-medium">14:00</p>
                            <p class="text-[11px] text-white">Meeting Room A</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="bg-white/5 border border-white/10 rounded-lg h-16"></div>
                    </div>
                    <div class="space-y-2">
                        <div class="bg-brand-500/20 border border-brand-400/30 rounded-lg px-2 py-2">
                            <p class="text-[10px] text-brand-300 font-medium">09:00</p>
                            <p class="text-[11px] text-white">Room 02</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ===================== HOW IT WORKS ===================== -->
    <section id="how-it-works" class="max-w-7xl mx-auto px-5 sm:px-8 py-24">
        <div class="max-w-xl mb-14">
            <p class="text-xs font-semibold text-brand-600 mb-2">Process</p>
            <h2 class="font-display font-bold text-3xl sm:text-4xl text-navy-900">Booking a room takes three steps</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="relative pl-14">
                <span class="absolute left-0 top-0 w-10 h-10 rounded-full bg-navy-900 text-white flex items-center justify-center font-display font-bold text-sm">1</span>
                <h3 class="font-display font-semibold text-lg text-navy-900">Choose a Room</h3>
                <p class="mt-2 text-sm text-slate-600">Browse rooms by location, capacity, or facilities.</p>
            </div>
            <div class="relative pl-14">
                <span class="absolute left-0 top-0 w-10 h-10 rounded-full bg-navy-900 text-white flex items-center justify-center font-display font-bold text-sm">2</span>
                <h3 class="font-display font-semibold text-lg text-navy-900">Select Date & Time</h3>
                <p class="mt-2 text-sm text-slate-600">Pick a slot that's open and fits your schedule.</p>
            </div>
            <div class="relative pl-14">
                <span class="absolute left-0 top-0 w-10 h-10 rounded-full bg-navy-900 text-white flex items-center justify-center font-display font-bold text-sm">3</span>
                <h3 class="font-display font-semibold text-lg text-navy-900">Confirm Booking</h3>
                <p class="mt-2 text-sm text-slate-600">Review the details and your room is reserved.</p>
            </div>
        </div>
    </section>

    <!-- ===================== FEATURES / BENEFITS ===================== -->
    <section class="bg-slate-50 py-20">
        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="flex items-start gap-3">
                    <span class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="radar" class="text-brand-600" style="width:18px;height:18px"></i>
                    </span>
                    <div>
                        <p class="font-display font-semibold text-navy-900">Real-time Availability</p>
                        <p class="text-sm text-slate-500 mt-1">Slots update the moment a room is booked.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <span class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="mouse-pointer-click" class="text-brand-600" style="width:18px;height:18px"></i>
                    </span>
                    <div>
                        <p class="font-display font-semibold text-navy-900">Easy Booking</p>
                        <p class="text-sm text-slate-500 mt-1">Reserve a room in a few clicks, no paperwork.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <span class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="calendar-check-2" class="text-brand-600" style="width:18px;height:18px"></i>
                    </span>
                    <div>
                        <p class="font-display font-semibold text-navy-900">Clear Schedule</p>
                        <p class="text-sm text-slate-500 mt-1">See every booking laid out on one calendar.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <span class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="info" class="text-brand-600" style="width:18px;height:18px"></i>
                    </span>
                    <div>
                        <p class="font-display font-semibold text-navy-900">Room Information</p>
                        <p class="text-sm text-slate-500 mt-1">Capacity and facilities listed before you book.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===================== CALL TO ACTION ===================== -->
    <section class="max-w-7xl mx-auto px-5 sm:px-8 py-20">
        <div class="bg-navy-900 rounded-3xl px-8 sm:px-16 py-16 text-center relative overflow-hidden">
            <div class="absolute -top-10 -left-10 w-56 h-56 bg-brand-500/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -right-10 w-56 h-56 bg-cyan-400/10 rounded-full blur-3xl"></div>

            <h2 class="relative font-display font-bold text-3xl sm:text-4xl text-white max-w-xl mx-auto">
                Need a space for your next discussion?
            </h2>
            <p class="relative mt-4 text-slate-400 max-w-md mx-auto">
                Check availability and book a room before your next class or project meeting.
            </p>
            <a href="#search" class="relative mt-8 inline-flex items-center gap-2 bg-white text-navy-900 font-semibold px-7 py-3.5 rounded-full hover:bg-slate-100 transition-colors">
                Find a Room
                <i data-lucide="arrow-right" style="width:16px;height:16px"></i>
            </a>
        </div>
    </section>

    <!-- ===================== FOOTER ===================== -->
    <footer class="border-t border-slate-200 py-12">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">

            <div>
                <div class="flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-lg bg-navy-900 flex items-center justify-center">
                        <i data-lucide="door-open" class="text-white" style="width:15px;height:15px"></i>
                    </span>
                    <span class="font-display font-bold text-navy-900">RoomBook</span>
                </div>
                <p class="text-sm text-slate-500 mt-2">Discussion Room Booking System</p>
                <p class="text-xs text-slate-400 mt-4">&copy; 2026 RoomBook. All rights reserved.</p>
            </div>

            <div class="flex gap-8 text-sm text-slate-600">
                <a href="#rooms" class="hover:text-navy-900 transition-colors">Rooms</a>
                <a href="#schedule" class="hover:text-navy-900 transition-colors">Schedule</a>
                <a href="#" class="hover:text-navy-900 transition-colors">Booking Guide</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();
        });
    </script>

</body>
</html>