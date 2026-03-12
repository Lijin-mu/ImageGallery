<?php
/**
 * Template Name: Gallery Page Backup
 * Description: Custom page template to display all Gallery posts in a grid layout.
 */

get_header(); ?>

<!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-bg"></div>
        <div class="hero-bg"></div>
        <div class="hero-content">
            <h1>Winter Moments</h1>
            <p>A Collection of Frozen Beauty</p>
        </div>
    </section>

<div class="gallery-page-wrapper">

    <div class="gallery-wrapper">

        <?php 
        /*
        $gallery_query = new WP_Query([
            'post_type'      => 'gallery',
            'posts_per_page' => -1,
        ]);

        if ($gallery_query->have_posts()) :
            while ($gallery_query->have_posts()) :
                $gallery_query->the_post(); ?>

                <div class="gallery-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) :
                            the_post_thumbnail('large');
                        endif; ?>
                        <div class="gallery-title"><?php the_title(); ?></div>
                    </a>
                </div>

            <?php endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No galleries found.</p>';
        endif;
        */
        ?>


    <!-- Gallery Section -->
    <section class="gallery-container" id="gallery">


    <!-- About Section -->
        <div class="about-section" id="about">
        <h2>About</h2>
        <div class="about-intro">
            <div class="about-text">
                <p>Capturing the serene beauty of winter landscapes has been my passion for over a decade. Each photograph tells a story of frozen moments, quiet snowfalls, and the peaceful stillness that blankets the world during the coldest months.</p>
                <p>From the majestic mountain peaks covered in pristine snow to intimate family moments wrapped in winter warmth, my work celebrates the unique beauty that this season brings. Through my lens, I aim to preserve the fleeting magic of winter—the way light dances on ice crystals, the cozy comfort of holiday gatherings, and the breathtaking landscapes transformed by snow.</p>
                <p>My photography has been featured in various publications and exhibitions, and I continue to explore new ways to capture the essence of winter's wonder.</p>
            </div>
            <div>
            </div>
        </div>
    </div>



        <!-- Filter Section -->
    <div class="filter-container">
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="landscapes">Landscapes</button>
            <button class="filter-btn" data-filter="decorations">Decorations</button>
            <button class="filter-btn" data-filter="food">Food</button>
            <button class="filter-btn" data-filter="family">Family</button>
        </div>
    </div>


        <div class="gallery-grid" id="galleryGrid">
            <!-- Landscapes -->


            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy 1</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy 2</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy 3</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
             <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy 3</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>

            
            <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?w=800&q=80" alt="Mountain Snow">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Mountain Snow</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>

            <div class="gallery-item" data-category="decorations">
                <img src="https://images.unsplash.com/photo-1512389142860-9c449e58a543?w=800&q=80" alt="Ornament Detail">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Ornament Detail</h3>
                    <p class="gallery-category">Decorations</p>
                </div>
            </div>

            <div class="gallery-item" data-category="food">
                <img src="https://images.unsplash.com/photo-1542990253-0d0f5be5f0ed?w=800&q=80" alt="Winter Warmth">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Winter Warmth</h3>
                    <p class="gallery-category">Food</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="food">
                <img src="https://images.unsplash.com/photo-1514517521153-1be72277b32f?w=800&q=80" alt="Festive Treats">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Festive Treats</h3>
                    <p class="gallery-category">Food</p>
                </div>
            </div>

             <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?w=800&q=80" alt="Mountain Snow">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Mountain Snow</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>


            <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1491002052546-bf38f186af56?w=800&q=80" alt="Frozen Lake">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Frozen Lake</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>

             <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?w=800&q=80" alt="Mountain Snow">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Mountain Snow</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>

            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>

            <div class="gallery-item" data-category="decorations">
                <img src="https://images.unsplash.com/photo-1543589077-47d81606c1bf?w=800&q=80" alt="Holiday Lights">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Holiday Lights</h3>
                    <p class="gallery-category">Decorations</p>
                </div>
            </div>

            <div class="gallery-item" data-category="food">
                <img src="https://images.unsplash.com/photo-1514517521153-1be72277b32f?w=800&q=80" alt="Festive Treats">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Festive Treats</h3>
                    <p class="gallery-category">Food</p>
                </div>
            </div>

            <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?w=800&q=80" alt="Winter Forest">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Winter Forest</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>

            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1544776193-352d25ca82cd?w=800&q=80" alt="Winter Together">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Winter Together</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>

            <div class="gallery-item" data-category="decorations">
                <img src="https://images.unsplash.com/photo-1512909006721-3d6018887383?w=800&q=80" alt="Gift Wrapping">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Gift Wrapping</h3>
                    <p class="gallery-category">Decorations</p>
                </div>
            </div>

            <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1476820865390-c52aeebb9891?w=800&q=80" alt="Snowy Path">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Snowy Path</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>

            <div class="gallery-item" data-category="food">
                <img src="https://images.unsplash.com/photo-1514517220017-8ce97a34a7b6?w=800&q=80" alt="Cozy Drinks">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Cozy Drinks</h3>
                    <p class="gallery-category">Food</p>
                </div>
            </div>
        </div>
         <!-- Lightbox -->
        <div class="lightbox">
            <button class="lightbox-close closeLightbox">×</button>
            <button class="lightbox-nav lightbox-prev prevImage">‹</button>
            <button class="lightbox-nav lightbox-next nextImage">›</button>
            <div class="lightbox-content">
                <img class="lightboxImage" src="" alt="">
                <div class="lightbox-info">
                    <h3 class="lightboxTitle"></h3>
                    <span class="lightboxCategory"></span>
                </div>
            </div>
        </div>
    </section>








        <!-- Gallery Section -->
    <section class="gallery-container" id="gallery">




    <!-- About Section -->
        <div class="about-section" id="about">
        <h2>About</h2>
        <div class="about-intro">
            <div class="about-text">
                <p>Capturing the serene beauty of winter landscapes has been my passion for over a decade. Each photograph tells a story of frozen moments, quiet snowfalls, and the peaceful stillness that blankets the world during the coldest months.</p>
                <p>From the majestic mountain peaks covered in pristine snow to intimate family moments wrapped in winter warmth, my work celebrates the unique beauty that this season brings. Through my lens, I aim to preserve the fleeting magic of winter—the way light dances on ice crystals, the cozy comfort of holiday gatherings, and the breathtaking landscapes transformed by snow.</p>
                <p>My photography has been featured in various publications and exhibitions, and I continue to explore new ways to capture the essence of winter's wonder.</p>
            </div>
            <div>
            </div>
        </div>
    </div>

            <!-- Filter Section -->
    <div class="filter-container">
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="landscapes">Landscapes</button>
            <button class="filter-btn" data-filter="decorations">Decorations</button>
            <button class="filter-btn" data-filter="food">Food</button>
            <button class="filter-btn" data-filter="family">Family</button>
        </div>
    </div>



        <div class="gallery-two-column-grid" id="galleryGrid">
            <!-- Landscapes -->
             <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy 3</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>

             <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?w=800&q=80" alt="Mountain Snow">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Mountain Snow</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>


            <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?w=800&q=80" alt="Winter Forest">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Winter Forest</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>

            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1544776193-352d25ca82cd?w=800&q=80" alt="Winter Together">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Winter Together</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
        </div>
         <!-- Lightbox -->
        <div class="lightbox">
            <button class="lightbox-close closeLightbox">×</button>
            <button class="lightbox-nav lightbox-prev prevImage">‹</button>
            <button class="lightbox-nav lightbox-next nextImage">›</button>
            <div class="lightbox-content">
                <img class="lightboxImage" src="" alt="">
                <div class="lightbox-info">
                    <h3 class="lightboxTitle"></h3>
                    <span class="lightboxCategory"></span>
                </div>
            </div>
        </div>
    </section>



        <!-- Gallery Section -->
    <section class="gallery-container" id="gallery">





    <!-- About Section -->
        <div class="about-section" id="about">
        <h2>About</h2>
        <div class="about-intro">
            <div class="about-text">
                <p>Capturing the serene beauty of winter landscapes has been my passion for over a decade. Each photograph tells a story of frozen moments, quiet snowfalls, and the peaceful stillness that blankets the world during the coldest months.</p>
                <p>From the majestic mountain peaks covered in pristine snow to intimate family moments wrapped in winter warmth, my work celebrates the unique beauty that this season brings. Through my lens, I aim to preserve the fleeting magic of winter—the way light dances on ice crystals, the cozy comfort of holiday gatherings, and the breathtaking landscapes transformed by snow.</p>
                <p>My photography has been featured in various publications and exhibitions, and I continue to explore new ways to capture the essence of winter's wonder.</p>
            </div>
            <div>
            </div>
        </div>
    </div>

                <!-- Filter Section -->
    <div class="filter-container">
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="landscapes">Landscapes</button>
            <button class="filter-btn" data-filter="decorations">Decorations</button>
            <button class="filter-btn" data-filter="food">Food</button>
            <button class="filter-btn" data-filter="family">Family</button>
        </div>
    </div>




        <div class="gallery-four-column-grid" id="galleryGrid">
            <!-- Landscapes -->
             <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy 3</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>

            
            <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?w=800&q=80" alt="Mountain Snow">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Mountain Snow</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>

            <div class="gallery-item" data-category="decorations">
                <img src="https://images.unsplash.com/photo-1512389142860-9c449e58a543?w=800&q=80" alt="Ornament Detail">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Ornament Detail</h3>
                    <p class="gallery-category">Decorations</p>
                </div>
            </div>

            <div class="gallery-item" data-category="food">
                <img src="https://images.unsplash.com/photo-1542990253-0d0f5be5f0ed?w=800&q=80" alt="Winter Warmth">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Winter Warmth</h3>
                    <p class="gallery-category">Food</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="food">
                <img src="https://images.unsplash.com/photo-1514517521153-1be72277b32f?w=800&q=80" alt="Festive Treats">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Festive Treats</h3>
                    <p class="gallery-category">Food</p>
                </div>
            </div>

             <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?w=800&q=80" alt="Mountain Snow">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Mountain Snow</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>


            <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1491002052546-bf38f186af56?w=800&q=80" alt="Frozen Lake">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Frozen Lake</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>

             <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?w=800&q=80" alt="Mountain Snow">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Mountain Snow</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>

            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=800&q=80" alt="Family Joy">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Family Joy</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>

            <div class="gallery-item" data-category="decorations">
                <img src="https://images.unsplash.com/photo-1543589077-47d81606c1bf?w=800&q=80" alt="Holiday Lights">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Holiday Lights</h3>
                    <p class="gallery-category">Decorations</p>
                </div>
            </div>

            <div class="gallery-item" data-category="food">
                <img src="https://images.unsplash.com/photo-1514517521153-1be72277b32f?w=800&q=80" alt="Festive Treats">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Festive Treats</h3>
                    <p class="gallery-category">Food</p>
                </div>
            </div>

            <div class="gallery-item" data-category="landscapes">
                <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?w=800&q=80" alt="Winter Forest">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Winter Forest</h3>
                    <p class="gallery-category">Landscapes</p>
                </div>
            </div>

            <div class="gallery-item" data-category="family">
                <img src="https://images.unsplash.com/photo-1544776193-352d25ca82cd?w=800&q=80" alt="Winter Together">
                <div class="gallery-overlay">
                    <h3 class="gallery-title">Winter Together</h3>
                    <p class="gallery-category">Family</p>
                </div>
            </div>
        </div>
         <!-- Lightbox -->
        <div class="lightbox">
            <button class="lightbox-close closeLightbox">×</button>
            <button class="lightbox-nav lightbox-prev prevImage">‹</button>
            <button class="lightbox-nav lightbox-next nextImage">›</button>
            <div class="lightbox-content">
                <img class="lightboxImage" src="" alt="">
                <div class="lightbox-info">
                    <h3 class="lightboxTitle"></h3>
                    <span class="lightboxCategory"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <h2>About</h2>
        <div class="about-content">
            <div class="about-text">
                <p>Capturing the serene beauty of winter landscapes has been my passion for over a decade. Each photograph tells a story of frozen moments, quiet snowfalls, and the peaceful stillness that blankets the world during the coldest months.</p>
                <p>From the majestic mountain peaks covered in pristine snow to intimate family moments wrapped in winter warmth, my work celebrates the unique beauty that this season brings. Through my lens, I aim to preserve the fleeting magic of winter—the way light dances on ice crystals, the cozy comfort of holiday gatherings, and the breathtaking landscapes transformed by snow.</p>
                <p>My photography has been featured in various publications and exhibitions, and I continue to explore new ways to capture the essence of winter's wonder.</p>
            </div>
            <div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1452802447250-470a88ac82bc?w=800&q=80" alt="Photographer">
                </div>
                <div class="about-stats">
                    <div class="stat-box">
                        <div class="stat-number">10+</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Photos Captured</div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="contact-section" id="contact">
        <h2>Get in Touch</h2>
        <p>Let's work together to capture your winter moments</p>

        <div class="contact-form-wrapper">
            <?php echo do_shortcode('[contact-form-7 id="fe951f9" title="Contact form 1"]'); ?>
        </div>

        <div class="contact-info">
            <div class="contact-item">
                <span>📧</span>
                <a href="mailto:hello@winterportfolio.com">hello@winterportfolio.com</a>
            </div>
            <div class="contact-item">
                <span>📱</span>
                <a href="tel:+15551234567">+1 (555) 123-4567</a>
            </div>
            <div class="contact-item">
                <span>📍</span>
                <a href="https://www.google.com/maps/search/?api=1&amp;query=Colorado+USA" target="_blank">Colorado, USA</a>
            </div>
        </div>
    </section>


    

    </div>

</div>

<?php get_footer(); ?>