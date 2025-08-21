// Global cart counter management
window.CartCounter = {
    // Update cart count in header
    updateCount: function(count) {
        const cartBadge = document.querySelector('[data-cart-count]');
        if (cartBadge) {
            if (count > 0) {
                cartBadge.textContent = count;
                cartBadge.classList.remove('hidden');
            } else {
                cartBadge.classList.add('hidden');
            }
        }
    },

    // Fetch current cart count from server
    refreshCount: function() {
        fetch('/cart/count', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            this.updateCount(data.count || 0);
        })
        .catch(error => {
            console.error('Error fetching cart count:', error);
        });
    },

    // Initialize cart counter on page load
    init: function() {
        // Refresh count when page loads
        this.refreshCount();
        
        // Listen for custom cart update events
        document.addEventListener('cartUpdated', (event) => {
            if (event.detail && event.detail.count !== undefined) {
                this.updateCount(event.detail.count);
            } else {
                this.refreshCount();
            }
        });
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.CartCounter.init();
});

// Helper function to trigger cart update event
window.triggerCartUpdate = function(count = null) {
    const event = new CustomEvent('cartUpdated', {
        detail: { count: count }
    });
    document.dispatchEvent(event);
};
