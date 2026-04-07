document.addEventListener("DOMContentLoaded", function() {
    // Sticky Header
    const header = document.querySelector("header");

    window.addEventListener("scroll", function() {
        header.classList.toggle("sticky", window.scrollY > 0);
    });

    // Mobile Menu Toggle
    let menu = document.querySelector('#menu-icon');
    let navlist = document.querySelector('.navlist');

    menu.onclick = () => {
        menu.classList.toggle('bx-x');
        navlist.classList.toggle('active');
    };

    window.onscroll = () => {
        menu.classList.remove('bx-x');
        navlist.classList.remove('active');
    };

    // Scroll Reveal Animations
    const sr = ScrollReveal({
        distance: '45px',
        duration: 2700,
        reset: true
    });

    sr.reveal('.home-text', { delay: 350, origin: 'left' });
    sr.reveal('.home-img', { delay: 350, origin: 'right' });
    sr.reveal('.sub-service, .about, .experience, .portfolio, .skills, .achievement, .contact', { delay: 200, origin: 'bottom' });

    // MixItUp Filter Initialization
    var mixer = mixitup('.achievement-container', {
        selectors: {
            target: '.mix'
        },
        animation: {
            duration: 300
        }
    });

    // Fix: Active Achievement List Item
    const linework = document.querySelectorAll('.list-item');

    if (linework.length > 0) { // Ensure elements exist
        function activework() {
            linework.forEach((a) => {
                a.classList.remove('active-achievement');
            });
            this.classList.add('active-achievement');
        }

        linework.forEach((a) => { // Fix: Changed linkwork to linework
            a.addEventListener('click', activework);
        });
    }
});
