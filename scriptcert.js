// Enhanced Certificate Cards Animation
document.addEventListener('DOMContentLoaded', function() {
    
    // Intersection Observer for fade-in animation
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -80px 0px'
    };

    const fadeInObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all certificate cards
    const certCards = document.querySelectorAll('.cert-card');
    certCards.forEach(card => {
        fadeInObserver.observe(card);
    });

    // Optional: Add click event to open certificates in modal or new tab
    certCards.forEach(card => {
        card.addEventListener('click', function() {
            const img = this.querySelector('.cert-image-wrapper img');
            if (img && img.src) {
                // You can implement a modal here or open in new tab
                // For now, we'll just add a subtle scale effect on click
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            }
        });
    });

    // Parallax effect on scroll (optional enhancement)
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        certCards.forEach((card, index) => {
            const cardTop = card.getBoundingClientRect().top;
            const cardVisible = cardTop < window.innerHeight;
            
            if (cardVisible) {
                const speed = 0.05;
                const yPos = -(scrolled * speed);
                card.style.transform = `translateY(${yPos * (index % 2 === 0 ? 1 : -1)}px)`;
            }
        });
    });
});