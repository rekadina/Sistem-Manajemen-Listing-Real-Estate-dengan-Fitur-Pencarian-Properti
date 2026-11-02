<footer class="bg-dark-gray mt-20">
    <!-- Main Footer -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <div class="flex items-center space-x-2 mb-6">
                    <div class="w-10 h-10 bg-gold rounded-lg flex items-center justify-center">
                        <span class="text-black font-bold text-xl">L</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white">Luxury<span class="text-gold">Estate</span></h3>
                </div>
                <p class="text-gray-400 mb-6">
                    Your premier destination for luxury real estate. Find exclusive properties that match your lifestyle.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-gold transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gold transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gold transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gold transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-semibold text-lg mb-6">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-gold transition-colors">Browse Properties</a></li>
                    <li><a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-gold transition-colors">Property Categories</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-gold transition-colors">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-gold transition-colors">Contact Us</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-gold transition-colors">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Property Types -->
            <div>
                <h4 class="text-white font-semibold text-lg mb-6">Property Types</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-400 hover:text-gold transition-colors">Luxury Villas</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-gold transition-colors">Penthouse Apartments</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-gold transition-colors">Waterfront Properties</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-gold transition-colors">Commercial Real Estate</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-gold transition-colors">Luxury Condos</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="text-white font-semibold text-lg mb-6">Stay Updated</h4>
                <p class="text-gray-400 mb-4">Subscribe to our newsletter for exclusive property listings.</p>
                <form class="space-y-3">
                    <input type="email" placeholder="Your email address" 
                           class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-gold">
                    <button type="submit" class="bg-gold text-black px-6 py-3 rounded-lg w-full hover:bg-yellow-500 transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <div class="section-divider my-12"></div>

        <!-- Contact Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gold/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-phone text-gold"></i>
                </div>
                <div>
                    <p class="text-gray-400">Phone</p>
                    <p class="text-white">+1 (555) 123-4567</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gold/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-envelope text-gold"></i>
                </div>
                <div>
                    <p class="text-gray-400">Email</p>
                    <p class="text-white">info@luxuryestate.com</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gold/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-gold"></i>
                </div>
                <div>
                    <p class="text-gray-400">Location</p>
                    <p class="text-white">Beverly Hills, CA 90210</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="bg-black py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} LuxuryEstate. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-gold text-sm">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-gold text-sm">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-gold text-sm">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>