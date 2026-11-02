<div class="luxury-card rounded-2xl overflow-hidden property-card">
    <!-- Property Image -->
    <div class="relative h-64 overflow-hidden">
        <img src="{{ $property->images[0] ?? 'https://images.unsplash.com/photo-1613977257363-707ba9348227?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
             alt="{{ $property->title }}" 
             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
        
        <!-- Badges -->
        <div class="absolute top-4 left-4 flex flex-col space-y-2">
            @if($property->featured)
            <span class="bg-gold text-black px-3 py-1 rounded-full text-xs font-semibold inline-flex items-center">
                <i class="fas fa-crown mr-1"></i> Featured
            </span>
            @endif
            
            <span class="bg-black/80 text-white px-3 py-1 rounded-full text-xs capitalize">
                {{ $property->listing_type }}
            </span>
        </div>
        
        <!-- Price Badge -->
        <div class="absolute bottom-4 left-4 right-4">
            <div class="bg-black/80 backdrop-blur-sm p-3 rounded-lg">
                <span class="text-xl font-bold text-gold">${{ number_format($property->price / 1000000, 2) }}M</span>
                @if($property->negotiable)
                <span class="text-xs text-gray-300 ml-2">(Negotiable)</span>
                @endif
            </div>
        </div>
        
        <!-- Status Badge -->
        @if($property->status == 'sold')
        <div class="absolute top-4 right-4">
            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                Sold
            </span>
        </div>
        @elseif($property->status == 'rented')
        <div class="absolute top-4 right-4">
            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                Rented
            </span>
        </div>
        @endif
    </div>

    <!-- Property Details -->
    <div class="p-6">
        <!-- Title and Location -->
        <h3 class="text-xl font-semibold mb-2 hover:text-gold transition-colors line-clamp-1">
            <a href="{{ route('properties.show', $property) }}">{{ $property->title }}</a>
        </h3>
        
        <p class="text-gray-400 mb-4 flex items-center">
            <i class="fas fa-map-marker-alt text-gold mr-2 text-sm"></i>
            <span class="line-clamp-1">{{ $property->city }}, {{ $property->province }}</span>
        </p>

        <!-- Features -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            @if($property->bedrooms)
            <div class="text-center">
                <div class="flex items-center justify-center mb-1">
                    <i class="fas fa-bed text-gold mr-2"></i>
                    <span class="font-semibold">{{ $property->bedrooms }}</span>
                </div>
                <div class="text-xs text-gray-400">Bed</div>
            </div>
            @endif
            
            @if($property->bathrooms)
            <div class="text-center">
                <div class="flex items-center justify-center mb-1">
                    <i class="fas fa-bath text-gold mr-2"></i>
                    <span class="font-semibold">{{ $property->bathrooms }}</span>
                </div>
                <div class="text-xs text-gray-400">Bath</div>
            </div>
            @endif
            
            @if($property->land_size)
            <div class="text-center">
                <div class="flex items-center justify-center mb-1">
                    <i class="fas fa-ruler-combined text-gold mr-2"></i>
                    <span class="font-semibold">{{ $property->land_size }}</span>
                </div>
                <div class="text-xs text-gray-400">m²</div>
            </div>
            @endif
        </div>

        <!-- Category and Date -->
        <div class="flex justify-between items-center mb-6">
            @if($property->category)
            <span class="text-sm text-gray-400">
                <i class="fas fa-tag mr-1"></i>
                {{ $property->category->name }}
            </span>
            @endif
            
            <span class="text-sm text-gray-400" title="{{ $property->created_at->format('d F Y') }}">
                <i class="far fa-clock mr-1"></i>
                {{ $property->created_at->diffForHumans() }}
            </span>
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-3">
            <a href="{{ route('properties.show', $property) }}" 
               class="flex-1 bg-gold text-black font-semibold py-3 rounded-lg text-center hover:bg-yellow-500 transition-colors">
                View Details
            </a>
            
            <button onclick="saveProperty({{ $property->id }})" 
                    class="w-12 border border-gray-700 text-gray-400 rounded-lg hover:border-gold hover:text-gold transition-colors flex items-center justify-center"
                    title="Save Property">
                <i class="far fa-heart"></i>
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function saveProperty(propertyId) {
        // Save property to user's favorites
        fetch(`/properties/${propertyId}/save`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                const button = event.target.closest('button');
                button.innerHTML = '<i class="fas fa-heart text-red-500"></i>';
                button.title = 'Saved';
                
                // Show notification
                showNotification('Property saved to favorites!', 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Please login to save properties', 'error');
        });
    }
    
    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 ${type === 'success' ? 'bg-green-600' : 'bg-red-600'} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 10);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
</script>
@endpush