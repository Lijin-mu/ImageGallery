/* JavaScript Document

Image Gallery

*/

// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const navLinks = document.getElementById('navLinks');

if (mobileMenuBtn && navLinks) {
   mobileMenuBtn.addEventListener('click', () => {
      navLinks.classList.toggle('active');
   });
}

// Smooth scroll for navigation links
document.querySelectorAll('.nav-links a').forEach(link => {
   link.addEventListener('click', (e) => {
      e.preventDefault();
      const targetId = link.getAttribute('href');
      const targetSection = document.querySelector(targetId);

      if (targetSection) {
         targetSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
         });

         // Close mobile menu if open
         navLinks.classList.remove('active');
      }
   });
});

// Logo click handler
const logo = document.querySelector('.logo');
if (logo) {
   logo.addEventListener('click', (e) => {
      e.preventDefault();
      const home = document.querySelector('#home');
      if (home) home.scrollIntoView({ behavior: 'smooth', block: 'start' });
      if (navLinks) navLinks.classList.remove('active');
   });
}

// Scroll spy for active menu states
const sections = document.querySelectorAll('section[id]');
const navLinksArray = document.querySelectorAll('.nav-links a');

function setActiveLink() {
   let currentSection = '';

   sections.forEach(section => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;
      if (window.scrollY >= sectionTop - 200) {
         currentSection = section.getAttribute('id');
      }
   });

   navLinksArray.forEach(link => {
      link.classList.remove('active');
      if (link.getAttribute('href') === `#${currentSection}`) {
         link.classList.add('active');
      }
   });
}

window.addEventListener('scroll', setActiveLink);
setActiveLink(); // Set initial active state


// Contact form submission
const contactForm = document.querySelector('.contact-form');
if(contactForm){

   contactForm.addEventListener('submit', (e) => {
   e.preventDefault();

   // Get form data
   const formData = new FormData(contactForm);
   const name = formData.get('name');

   // Show success message (in real implementation, this would send to a server)
   alert(`Thank you ${name}! Your message has been sent. We will get back to you soon.`);

   // Reset form
   contactForm.reset();
});

}





   const galleries = document.querySelectorAll('.gallery-container');

   galleries.forEach(gallery => {

      const filterBtns = gallery.querySelectorAll('.filter-btn');
      const galleryItems = gallery.querySelectorAll('.gallery-item');

      const lightbox = gallery.querySelector('.lightbox');
      const lightboxImage = gallery.querySelector('.lightboxImage');
      const lightboxTitle = gallery.querySelector('.lightboxTitle');
      const lightboxCategory = gallery.querySelector('.lightboxCategory');
      const closeLightbox = gallery.querySelector('.closeLightbox');
      const prevImage = gallery.querySelector('.prevImage');
      const nextImage = gallery.querySelector('.nextImage');

      let currentImageIndex = 0;
      let visibleImages = [];

      function updateVisibleImages() {
         visibleImages = Array.from(galleryItems).filter(item =>
            item.style.display !== 'none'
         );
      }

      // --------------------
      // FILTER FUNCTIONALITY
      // --------------------
      if (filterBtns.length) {
         filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {

               filterBtns.forEach(b => b.classList.remove('active'));
               btn.classList.add('active');

               const filterValue = btn.getAttribute('data-filter');

               galleryItems.forEach(item => {
                  if (
                     filterValue === 'all' ||
                     item.getAttribute('data-category') === filterValue
                  ) {
                     item.style.display = 'block';
                  } else {
                     item.style.display = 'none';
                  }
               });

               updateVisibleImages();
            });
         });
      }

      // --------------------
      // LIGHTBOX FUNCTIONALITY
      // --------------------
      if (lightbox && lightboxImage && lightboxTitle && lightboxCategory) {

         galleryItems.forEach(item => {
            item.addEventListener('click', (e) => {
               e.preventDefault();
               updateVisibleImages();
               const idx = visibleImages.indexOf(item);
               currentImageIndex = idx >= 0 ? idx : 0;
               openLightbox(item);
            });
         });

         function openLightbox(item) {
            const img = item.querySelector('img');
            if (!img) return;
            const title = item.querySelector('.gallery-title');
            const category = item.querySelector('.gallery-category');

            lightboxImage.src = img.src;
            lightboxImage.alt = img.alt;

            lightboxTitle.textContent = title ? title.textContent : '';
            lightboxCategory.textContent = category ? category.textContent : '';

            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
         }

         function close() {
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
         }

         closeLightbox?.addEventListener('click', (e) => {
            e.stopPropagation();
            close();
         });

         lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) close();
         });

         lightbox.querySelector('.lightbox-content')?.addEventListener('click', (e) => {
            e.stopPropagation();
         });

         prevImage?.addEventListener('click', () => {
            if (!visibleImages.length) return;
            currentImageIndex =
               (currentImageIndex - 1 + visibleImages.length) %
               visibleImages.length;
            openLightbox(visibleImages[currentImageIndex]);
         });

         nextImage?.addEventListener('click', () => {
            if (!visibleImages.length) return;
            currentImageIndex =
               (currentImageIndex + 1) %
               visibleImages.length;
            openLightbox(visibleImages[currentImageIndex]);
         });

         document.addEventListener('keydown', (e) => {
            if (!lightbox.classList.contains('active')) return;

            if (e.key === 'Escape') close();
            else if (e.key === 'ArrowLeft') prevImage?.click();
            else if (e.key === 'ArrowRight') nextImage?.click();
         });
      }

      updateVisibleImages();
   });

