// Initialize AOS (Animate On Scroll)
document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100,
        easing: 'cubic-bezier(0.4, 0, 0.2, 1)'
    });
});

// Navbar change background on scroll
window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Smooth scroll for anchor links with offset
document.querySelectorAll('a[href*="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        // Parse the URL
        const url = new URL(this.href, window.location.origin);
        
        // Only apply smooth scrolling if the link is on the same path
        if (url.pathname === window.location.pathname || url.pathname === window.location.pathname + '/') {
            const targetId = url.hash;
            if (targetId && targetId !== '#') {
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    const navbarHeight = document.querySelector('.navbar').offsetHeight;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - (navbarHeight - 20);

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                        bsCollapse.hide();
                    }
                }
            }
        }
    });
});

// Custom ScrollSpy to highlight active menu based on scroll position
window.addEventListener('scroll', function () {
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const navbarHeight = document.querySelector('.navbar') ? document.querySelector('.navbar').offsetHeight : 0;
    
    // Find all sections that have a corresponding nav link
    let sections = [];
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && href.includes('#')) {
            const hash = href.substring(href.indexOf('#'));
            if (hash !== '#') {
                const section = document.querySelector(hash);
                if (section) sections.push({ id: hash, element: section, link: link });
            }
        }
    });

    let currentSectionId = null;

    // Determine which section is currently in view
    sections.forEach(item => {
        const sectionTop = item.element.offsetTop;
        // If we scrolled past the section top (adjusted for navbar and some buffer)
        if (window.scrollY >= (sectionTop - navbarHeight - 150)) {
            currentSectionId = item.id;
        }
    });

    // Update active class
    if (currentSectionId) {
        sections.forEach(item => {
            if (item.id === currentSectionId) {
                item.link.classList.add('active');
            } else {
                item.link.classList.remove('active');
            }
        });
    } else {
        // If we are at the very top (before the first section), maybe make the first one active or remove all
        if (window.scrollY < 100 && sections.length > 0) {
            sections.forEach(item => item.link.classList.remove('active'));
            sections[0].link.classList.add('active');
        }
    }
});

// Optional: Add parallax effect to hero images or other elements
window.addEventListener('scroll', function () {
    const scrolled = window.pageYOffset;
    const heroImg = document.querySelector('.hero-image-container img');
    if (heroImg) {
        heroImg.style.transform = `translateY(${scrolled * 0.1}px)`;
    }
});

