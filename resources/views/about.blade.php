@extends('layouts.app')

@section('title', 'About Us - Luxury Real Estate')
@section('meta_description', 'Learn about LuxuryEstate - your premier destination for luxury real estate with years of experience in premium properties.')

@section('content')
<div class="bg-black min-h-screen">
    <!-- Hero Section -->
    <section class="relative py-24 bg-gradient-to-br from-black via-gray-900 to-black border-b border-gray-800">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-block mb-6">
                    <span class="text-yellow-500 font-bold text-sm tracking-widest uppercase border border-yellow-500/30 px-4 py-2 rounded-full">
                        About Us
                    </span>
                </div>
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-8 leading-tight">
                    Crafting <span class="text-yellow-500">Dreams</span>,<br>
                    Building <span class="text-yellow-500">Legacies</span>
                </h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Premier luxury real estate brokerage specializing in exclusive properties for discerning clients worldwide.
                </p>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-black to-transparent"></div>
    </section>

    <!-- Our Story -->
    <section class="py-20 bg-black">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <!-- Large Number -->
                    <div class="absolute -left-6 -top-6 text-[200px] font-bold text-yellow-500/10 -z-10">
                        01
                    </div>
                    
                    <div class="relative z-10">
                        <span class="text-yellow-500 font-semibold tracking-widest uppercase text-sm mb-4 block">
                            Our Story
                        </span>
                        <h2 class="text-4xl md:text-5xl font-bold text-white mb-8 leading-tight">
                            Redefining Luxury<br>
                            <span class="text-yellow-500">Real Estate Excellence</span>
                        </h2>
                        
                        <div class="space-y-6">
                            <p class="text-gray-300 text-lg">
                                Founded with a vision to transform the luxury real estate experience, LuxuryEstate has been connecting 
                                discerning clients with exceptional properties for over 15 years.
                            </p>
                            <p class="text-gray-300">
                                Our commitment to <span class="text-yellow-500 font-medium">excellence, discretion, and personalized service</span> 
                                has established us as a leader in premium real estate worldwide.
                            </p>
                            <p class="text-gray-300">
                                We understand that luxury is more than just a price tag—it's about <span class="text-yellow-500 font-medium">exceptional quality, 
                                unique features, and creating spaces that inspire</span>. Our team combines local expertise with global connections 
                                to deliver unparalleled service.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Image -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-yellow-500 to-transparent rounded-3xl blur opacity-30 group-hover:opacity-50 transition duration-500"></div>
                    <div class="relative overflow-hidden rounded-2xl border border-gray-800 bg-black">
                        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                             alt="Luxury Estate Office" 
                             class="w-full h-[500px] object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        
                        <!-- Overlay Content -->
                        <div class="absolute bottom-8 left-8 right-8">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 rounded-full bg-yellow-500/20 border border-yellow-500/30 flex items-center justify-center">
                                    <i class="fas fa-crown text-yellow-500"></i>
                                </div>
                                <h3 class="text-xl font-bold text-white">Since 2008</h3>
                            </div>
                            <p class="text-gray-300">Over 15 years of luxury real estate excellence</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="py-20 bg-gray-900/30 border-y border-gray-800">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-yellow-500 font-semibold tracking-widest uppercase text-sm mb-4 block">
                    Our Philosophy
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    The LuxuryEstate <span class="text-yellow-500">Difference</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    What sets us apart in the world of luxury real estate
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="group bg-black border border-gray-800 rounded-2xl p-8 hover:border-yellow-500/50 transition-all duration-500 hover:transform hover:-translate-y-2">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center group-hover:bg-yellow-500/20 transition-all">
                            <i class="fas fa-user-shield text-yellow-500 text-3xl"></i>
                        </div>
                        <div class="absolute -right-2 -top-2 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold">
                            01
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-yellow-500 transition-colors">
                        Discretion & Privacy
                    </h3>
                    <p class="text-gray-400 leading-relaxed">
                        We understand the paramount importance of confidentiality in luxury real estate transactions. 
                        Our clients enjoy complete privacy and discretion throughout their journey.
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="group bg-black border border-gray-800 rounded-2xl p-8 hover:border-yellow-500/50 transition-all duration-500 hover:transform hover:-translate-y-2">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center group-hover:bg-yellow-500/20 transition-all">
                            <i class="fas fa-award text-yellow-500 text-3xl"></i>
                        </div>
                        <div class="absolute -right-2 -top-2 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold">
                            02
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-yellow-500 transition-colors">
                        Expertise & Experience
                    </h3>
                    <p class="text-gray-400 leading-relaxed">
                        Our elite team combines decades of specialized experience in luxury markets, 
                        providing unparalleled market analysis, valuation, and negotiation expertise.
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="group bg-black border border-gray-800 rounded-2xl p-8 hover:border-yellow-500/50 transition-all duration-500 hover:transform hover:-translate-y-2">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center group-hover:bg-yellow-500/20 transition-all">
                            <i class="fas fa-globe text-yellow-500 text-3xl"></i>
                        </div>
                        <div class="absolute -right-2 -top-2 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold">
                            03
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-yellow-500 transition-colors">
                        Global Network
                    </h3>
                    <p class="text-gray-400 leading-relaxed">
                        Access to an exclusive worldwide network of ultra-luxury properties, 
                        high-net-worth individuals, and premium investment opportunities through 
                        our international partnerships.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-black">
        <div class="container mx-auto px-6">
            <div class="bg-gradient-to-br from-gray-900 to-black border border-gray-800 rounded-3xl p-8 md:p-12 relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23D4AF37" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                </div>
                
                <div class="relative z-10">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                            By The <span class="text-yellow-500">Numbers</span>
                        </h2>
                        <p class="text-gray-400">Our legacy of excellence in numbers</p>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        @php
                            $stats = [
                                ['value' => '15+', 'label' => 'Years Experience', 'icon' => 'fas fa-calendar-star'],
                                ['value' => '$2.5B+', 'label' => 'Properties Sold', 'icon' => 'fas fa-home'],
                                ['value' => '500+', 'label' => 'Happy Clients', 'icon' => 'fas fa-user-tie'],
                                ['value' => '25+', 'label' => 'Countries Served', 'icon' => 'fas fa-flag'],
                            ];
                        @endphp
                        
                        @foreach($stats as $stat)
                        <div class="text-center group">
                            <div class="w-20 h-20 rounded-full bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center mx-auto mb-6 group-hover:bg-yellow-500/20 transition-all">
                                <i class="{{ $stat['icon'] }} text-yellow-500 text-2xl"></i>
                            </div>
                            <div class="text-4xl md:text-5xl font-bold text-yellow-500 mb-2">{{ $stat['value'] }}</div>
                            <div class="text-gray-300 font-medium">{{ $stat['label'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20 bg-gray-900/30">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-yellow-500 font-semibold tracking-widest uppercase text-sm mb-4 block">
                    Our Elite Team
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Meet Our Luxury <span class="text-yellow-500">Specialists</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    A team of dedicated professionals committed to delivering exceptional service
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $agents = [
                        ['name' => 'Ahmad Hidayat', 'title' => 'Luxury Property Specialist', 'location' => 'Bali & Jakarta'],
                        ['name' => 'Siti Nurhaliza', 'title' => 'Luxury Property Specialist', 'location' => 'Singapore & Malaysia'],
                        ['name' => 'Budi Santoso', 'title' => 'Luxury Property Specialist', 'location' => 'Dubai & Middle East'],
                        ['name' => 'Dewi Lestari', 'title' => 'Luxury Property Specialist', 'location' => 'Europe & UK'],
                    ];
                @endphp
                
                @foreach($agents as $agent)
                <div class="group bg-black border border-gray-800 rounded-2xl overflow-hidden hover:border-yellow-500/50 transition-all duration-500">
                    <!-- Agent Image -->
                    <div class="relative h-64 overflow-hidden bg-gray-900">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="{{ $agent['name'] }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        
                        <!-- Location Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-yellow-500 text-black text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                {{ $agent['location'] }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Agent Info -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-yellow-500 transition-colors">
                            {{ $agent['name'] }}
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">{{ $agent['title'] }}</p>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-800">
                            <div class="text-yellow-500 text-sm font-medium">
                                <i class="fas fa-star mr-1"></i>
                                <span>4.9/5 Rating</span>
                            </div>
                            <div class="flex space-x-3">
                                <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-yellow-500 hover:text-black transition-all">
                                    <i class="fab fa-linkedin-in text-sm"></i>
                                </a>
                                <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-yellow-500 hover:text-black transition-all">
                                    <i class="fas fa-envelope text-sm"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="relative overflow-hidden rounded-3xl border border-gray-800 bg-gradient-to-r from-gray-900 to-black">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23D4AF37" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                </div>
                
                <div class="relative z-10 py-16 px-8 text-center">
                    <div class="max-w-3xl mx-auto">
                        <div class="w-20 h-20 rounded-full bg-yellow-500/20 border border-yellow-500/30 flex items-center justify-center mx-auto mb-8">
                            <i class="fas fa-crown text-yellow-500 text-2xl"></i>
                        </div>
                        
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                            Ready to Begin Your <span class="text-yellow-500">Luxury Journey</span>?
                        </h2>
                        <p class="text-gray-300 text-lg mb-8 max-w-2xl mx-auto">
                            Contact our team of luxury property specialists for personalized service 
                            and exclusive access to the world's finest properties.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('contact') }}" 
                               class="px-8 py-4 bg-yellow-500 text-black font-bold rounded-xl hover:bg-yellow-400 transition-all transform hover:-translate-y-1 shadow-lg shadow-yellow-500/20">
                                <i class="fas fa-phone-alt mr-2"></i>
                                Contact Our Team
                            </a>
                            <a href="{{ route('properties.index') }}" 
                               class="px-8 py-4 bg-transparent border-2 border-yellow-500 text-yellow-500 font-bold rounded-xl hover:bg-yellow-500 hover:text-black transition-all">
                                <i class="fas fa-search mr-2"></i>
                                Browse Properties
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection