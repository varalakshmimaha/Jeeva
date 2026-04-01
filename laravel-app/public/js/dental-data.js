// Dental admin data manager.
// Reads localStorage data saved by public/admin.html and updates the frontend.

const DentalData = {
    getDefaultBanners: function (page = 'home') {
        const defaults = {
            home: [
                {
                    id: 'default-home-1',
                    title: 'Advanced Dental Care for Every Smile',
                    subtitle: 'Trusted Orthodontics in Tippasandra',
                    description: 'From preventive checkups to smile makeovers, our specialists provide precision care with modern technology.',
                    image: '/images/dentist_checking_patient.png',
                    buttonText: 'Book Appointment',
                    link: '/contact',
                    order: 1,
                    enabled: true,
                    page: 'home'
                },
                {
                    id: 'default-home-2',
                    title: 'Braces, Implants, and Cosmetic Dentistry',
                    subtitle: 'Complete Smile Solutions',
                    description: 'Comfort-focused treatments with transparent pricing and personalized treatment plans for every patient.',
                    image: '/images/blog_implants.png',
                    buttonText: 'View Services',
                    link: '/services',
                    order: 2,
                    enabled: true,
                    page: 'home'
                },
                {
                    id: 'default-home-3',
                    title: 'Your Brightest Smile Starts Here',
                    subtitle: 'Award-Winning Clinic',
                    description: 'Smile designing, teeth whitening, veneers, and orthodontic treatment — all in one trusted clinic in Bangalore.',
                    image: '/images/blog_dental_hygiene.png',
                    buttonText: 'See Gallery',
                    link: '/gallery',
                    order: 3,
                    enabled: true,
                    page: 'home'
                }
            ]
        };

        return defaults[page] || [];
    },

    getDefaultBlogs: function () {
        return [
            {
                id: 'default-blog-1',
                title: 'Tips for Dental Hygiene',
                category: 'Hygiene',
                excerpt: 'Learn the best practices for maintaining healthy teeth and keeping your smile bright forever',
                image: '/images/blog-dental-hygiene.svg',
                date: 'Mar 28, 2025',
                slug: 'tips-for-dental-hygiene',
                status: 'published'
            },
            {
                id: 'default-blog-2',
                title: 'Understanding Braces',
                category: 'Orthodontics',
                excerpt: 'Everything you need to know about orthodontic treatment and straightening your smile perfectly',
                image: '/images/blog-braces.svg',
                date: 'Mar 25, 2025',
                slug: 'understanding-braces',
                status: 'published'
            },
            {
                id: 'default-blog-3',
                title: 'Benefits of Dental Implants',
                category: 'Implants',
                excerpt: 'Discover why dental implants are the best long-term solution for missing teeth today',
                image: '/images/blog-implants.svg',
                date: 'Mar 20, 2025',
                slug: 'benefits-of-dental-implants',
                status: 'published'
            },
            {
                id: 'default-blog-4',
                title: 'The Benefits of Invisalign Over Traditional Braces',
                category: 'Orthodontics',
                excerpt: 'Discover why transparent aligners are becoming the preferred choice for teeth straightening, with benefits in comfort, aesthetics, and daily convenience.',
                image: '/images/blog-invisalign.svg',
                date: 'Mar 15, 2025',
                slug: 'benefits-of-invisalign-over-traditional-braces',
                status: 'published'
            },
            {
                id: 'default-blog-5',
                title: 'Complete Guide to Root Canal Treatment',
                category: 'General Care',
                excerpt: 'Everything you need to know about root canal treatment, including the procedure, pain management, recovery, and long-term results.',
                image: '/images/blog-root-canal.svg',
                date: 'Mar 10, 2025',
                slug: 'complete-guide-to-root-canal-treatment',
                status: 'published'
            },
            {
                id: 'default-blog-6',
                title: 'Teeth Whitening: Professional vs At-Home Methods',
                category: 'Cosmetic',
                excerpt: 'Compare professional whitening with DIY kits and understand which option is safer, faster, and more effective for your smile.',
                image: '/images/blog-whitening.svg',
                date: 'Mar 05, 2025',
                slug: 'teeth-whitening-professional-vs-at-home-methods',
                status: 'published'
            },
            {
                id: 'default-blog-7',
                title: 'Dental Implants: A Permanent Solution for Missing Teeth',
                category: 'Implants',
                excerpt: 'Learn how dental implants restore chewing function, preserve bone support, and provide a long-lasting replacement for missing teeth.',
                image: '/images/blog-implants.svg',
                date: 'Feb 28, 2025',
                slug: 'dental-implants-a-permanent-solution-for-missing-teeth',
                status: 'published'
            },
            {
                id: 'default-blog-8',
                title: 'Making Dental Visits Fun for Children',
                category: 'Kids Dentistry',
                excerpt: 'Practical tips for helping children feel relaxed and confident before, during, and after dental visits.',
                image: '/images/blog-prevention.svg',
                date: 'Feb 20, 2025',
                slug: 'making-dental-visits-fun-for-children',
                status: 'published'
            },
            {
                id: 'default-blog-9',
                title: 'Daily Habits for a Lifetime of Healthy Teeth',
                category: 'Prevention',
                excerpt: 'Small daily choices in brushing, flossing, diet, and routine checkups can protect your smile for the long term.',
                image: '/images/blog-prevention.svg',
                date: 'Feb 15, 2025',
                slug: 'daily-habits-for-a-lifetime-of-healthy-teeth',
                status: 'published'
            },
            {
                id: 'default-blog-10',
                title: 'Sedation Dentistry: A Relaxing Dental Experience',
                category: 'General Care',
                excerpt: 'Learn how modern sedation techniques can make your dental visit anxiety-free and completely comfortable.',
                image: '/images/dentist_checking_patient.png',
                date: 'Apr 01, 2025',
                slug: 'sedation-dentistry-a-closer-look',
                status: 'published'
            },
            {
                id: 'default-blog-11',
                title: 'How to Choose the Right Toothbrush',
                category: 'Hygiene',
                excerpt: 'Manual or electric? Soft or medium bristles? We help you navigate the aisles to find the perfect brush for your smile.',
                image: '/images/blog_dental_hygiene.png',
                date: 'Mar 31, 2025',
                slug: 'how-to-choose-the-right-toothbrush',
                status: 'published'
            },
            {
                id: 'default-blog-12',
                title: 'The Impact of Diet on Oral Health',
                category: 'Prevention',
                excerpt: 'What you eat directly affects the health of your teeth and gums. Discover the best (and worst) foods for your smile.',
                image: '/images/blog_implants.png',
                date: 'Mar 30, 2025',
                slug: 'the-impact-of-diet-on-oral-health',
                status: 'published'
            }
        ];
    },

    getData: function () {
        try {
            const stored = localStorage.getItem('dentalAdminData');
            if (stored) {
                const data = JSON.parse(stored);
                console.log('[DentalData] Admin data retrieved:', data);
                return data;
            } else {
                console.log('[DentalData] No admin data in localStorage yet');
                return null;
            }
        } catch (error) {
            console.warn('[DentalData] Unable to parse dental admin data.', error);
            return null;
        }
    },

    getBanners: function (page = null) {
        const banners = this.getData()?.banners;
        let filteredBanners = Array.isArray(banners)
            ? banners.slice().sort((a, b) => (a.order || 0) - (b.order || 0))
            : [];

        if (page) {
            // Backward compatibility: old saved banners may not have page.
            // Treat missing page as "home" so existing data keeps working.
            filteredBanners = filteredBanners.filter((b) => (b.page || 'home') === page);
        }

        if (filteredBanners.length > 0) {
            return filteredBanners;
        }

        if (page) {
            return this.getDefaultBanners(page);
        }

        return this.getDefaultBanners('home');
    },

    getGallery: function () {
        const gallery = this.getData()?.gallery;
        return Array.isArray(gallery) ? gallery : [];
    },

    getServices: function () {
        const services = this.getData()?.services;
        return Array.isArray(services) ? services : [];
    },

    getBlogs: function () {
        const blogs = this.getData()?.blogs;
        const storedBlogs = Array.isArray(blogs) ? blogs : [];

        // If no stored blogs, return default blogs
        if (storedBlogs.length === 0) {
            return this.getDefaultBlogs();
        }

        return storedBlogs;
    },

    getSettings: function () {
        return this.getData()?.settings || null;
    },

    normalizeGalleryCategory: function (category) {
        const value = String(category || '').trim().toLowerCase();

        if (
            value.includes('clinic') ||
            value.includes('interior') ||
            value.includes('reception') ||
            value.includes('waiting')
        ) {
            return 'clinic-interior';
        }

        if (
            value.includes('equipment') ||
            value.includes('chair') ||
            value.includes('unit') ||
            value.includes('treatment') ||
            value.includes('lab') ||
            value.includes('room') ||
            value.includes('steril')
        ) {
            return 'equipment';
        }

        if (
            value.includes('before') ||
            value.includes('after') ||
            value.includes('braces') ||
            value.includes('implant') ||
            value.includes('cosmetic') ||
            value.includes('makeover') ||
            value.includes('result') ||
            value.includes('smile')
        ) {
            return 'before-after';
        }

        return 'clinic-interior';
    },

    getGalleryToneClass: function (index) {
        return `tone-${(index % 6) + 1}`;
    },

    getGalleryIcon: function (category) {
        const normalizedCategory = this.normalizeGalleryCategory(category);

        if (normalizedCategory === 'equipment') {
            return '&#128715;';
        }

        if (normalizedCategory === 'before-after') {
            return '&#10024;';
        }

        return '&#127973;';
    },

    attachReveal: function (root) {
        if (window.attachRevealAnimations) {
            window.attachRevealAnimations(root);
        }
    },

    applySettings: function () {
        const settings = this.getSettings();

        if (!settings) {
            return;
        }

        if (settings.clinicName) {
            document.querySelectorAll('.logo-name, .site-footer-brand-name').forEach((element) => {
                element.textContent = settings.clinicName;
            });
        }

        if (!settings.logo) {
            return;
        }

        const injectLogo = (selector, imageClass) => {
            document.querySelectorAll(selector).forEach((element) => {
                element.innerHTML = '';

                const image = document.createElement('img');
                image.src = settings.logo;
                image.alt = `${settings.clinicName || 'Clinic'} logo`;
                image.className = imageClass;

                element.appendChild(image);
            });
        };

        injectLogo('.logo-mark', 'logo-image');
        injectLogo('.site-footer-brand-mark', 'site-footer-brand-image');
    },

    renderBanners: function (containerId, page) {
        const section = document.getElementById('home-banners-section');
        const container = document.getElementById(containerId);

        if (!container) {
            return;
        }

        if (container._bannerTimer) {
            clearInterval(container._bannerTimer);
            container._bannerTimer = null;
        }

        const defaultBanners = this.getDefaultBanners(page).filter((banner) => banner && banner.enabled && banner.image);
        const fallbackImages = defaultBanners.map((banner) => banner.image).filter(Boolean);

        let banners = this.getBanners(page)
            .filter((banner) => banner && banner.enabled)
            .map((banner) => ({
                ...banner,
                image: String(banner.image || '').trim(),
            }))
            // Stored blob URLs from previous sessions are not reusable after reload.
            .filter((banner) => banner.image && !banner.image.startsWith('blob:'));

        console.log(`[DentalData] renderBanners called for page: ${page}`);
        console.log(`[DentalData] Found ${banners.length} stored banners, ${defaultBanners.length} default banners available`);

        // If admin data exists but banner images are empty, use default image banners.
        if (banners.length === 0) {
            console.log('[DentalData] No stored banners with valid images. Using default banners.');
            banners = defaultBanners;
        }

        if (banners.length === 0) {
            console.warn('[DentalData] No banners to display. Hiding banner section.');
            container.innerHTML = '';
            if (section) {
                section.hidden = true;
            }
            return;
        }

        console.log(`[DentalData] Rendering ${banners.length} banners`);
        console.log('[DentalData] Banner data:', banners);
        if (section) {
            section.hidden = false;
        }

        const slides = banners.map((banner, index) => {
            console.log(`[DentalData] Creating banner slide ${index + 1}:`, {
                title: banner.title,
                description: banner.description?.substring(0, 50),
                image: banner.image?.substring(0, 100),
                enabled: banner.enabled
            });

            const eyebrow = banner.subtitle
                ? `<p class="banner-slide-eyebrow">${banner.subtitle}</p>`
                : '';
            const title = banner.title
                ? `<h1 class="banner-slide-title">${banner.title}</h1>`
                : '';
            const description = banner.description
                ? `<p class="banner-slide-description">${banner.description}</p>`
                : '';
            const button = banner.buttonText
                ? `<a href="${banner.link || '#'}" class="banner-slide-button">${banner.buttonText} <span>&rarr;</span></a>`
                : '';
            const content = eyebrow || title || description || button
                ? `
                    <div class="banner-slide-overlay"></div>
                    <div class="banner-slide-shell">
                        <div class="banner-slide-content">
                            ${eyebrow}
                            ${title}
                            ${description}
                            ${button}
                        </div>
                    </div>
                `
                : '<div class="banner-slide-overlay"></div>';

            const fallbackImage = fallbackImages[index % fallbackImages.length] || '';
            const imageSrc = banner.image || fallbackImage;

            console.log(`[DentalData] Banner ${index + 1} image src length: ${imageSrc?.length || 0}, starts with: ${imageSrc?.substring(0, 80) || 'empty'}`);

            // Build inline style with background-image - use single quotes to avoid conflicts
            let styleAttr = '';
            if (imageSrc && imageSrc.trim()) {
                // Build style string with proper escaping
                // Use single quotes in the attribute to avoid conflicts with double quotes in URLs
                styleAttr = `style="background-image: url('${imageSrc.replace(/'/g, "&apos;")}')"`;
            }

            const slide = `<div class="banner-slide${index === 0 ? ' is-active' : ''}" ${styleAttr}>
                    ${content}
                </div>`;

            console.log(`[DentalData] Slide ${index + 1} created with style: ${styleAttr ? 'yes' : 'no'}`);
            return slide;
        }).join('');

        console.log(`[DentalData] Total slides HTML length: ${slides.length}`);
        if (slides.length === 0) {
            console.error('[DentalData] ERROR: slides HTML is empty! Banners:', banners);
        }

        const dots = banners.length > 1
            ? `
                <div class="banner-slider-dots">
                    ${banners.map((_, index) => `
                        <button type="button" class="banner-dot${index === 0 ? ' is-active' : ''}" data-slide-index="${index}" aria-label="Show banner ${index + 1}"></button>
                    `).join('')}
                </div>
            `
            : '';

        const controls = banners.length > 1
            ? `
                <button type="button" class="banner-slider-control is-prev" data-direction="prev" aria-label="Previous banner">&#8249;</button>
                <button type="button" class="banner-slider-control is-next" data-direction="next" aria-label="Next banner">&#8250;</button>
            `
            : '';

        container.innerHTML = `
            <div class="banner-slider reveal">
                <div class="banner-slider-track">
                    ${slides}
                </div>
                ${controls}
                ${dots}
            </div>
        `;

        console.log('[DentalData] Banner HTML inserted into container');
        console.log(`[DentalData] Track children count: ${container.querySelector('.banner-slider-track')?.children.length}`);
        console.log('[DentalData] First slide element:', container.querySelector('.banner-slide'));

        this.attachReveal(container);

        const slideElements = Array.from(container.querySelectorAll('.banner-slide'));
        const dotElements = Array.from(container.querySelectorAll('.banner-dot'));

        if (slideElements.length <= 1) {
            return;
        }

        let currentIndex = 0;

        const showSlide = (index) => {
            currentIndex = (index + slideElements.length) % slideElements.length;

            slideElements.forEach((slide, slideIndex) => {
                slide.classList.toggle('is-active', slideIndex === currentIndex);
            });

            dotElements.forEach((dot, dotIndex) => {
                dot.classList.toggle('is-active', dotIndex === currentIndex);
            });
        };

        const startAutoplay = () => {
            container._bannerTimer = window.setInterval(() => {
                showSlide(currentIndex + 1);
            }, 5000);
        };

        const stopAutoplay = () => {
            if (container._bannerTimer) {
                clearInterval(container._bannerTimer);
                container._bannerTimer = null;
            }
        };

        dotElements.forEach((dot) => {
            dot.addEventListener('click', () => {
                stopAutoplay();
                showSlide(Number(dot.dataset.slideIndex));
                startAutoplay();
            });
        });

        container.querySelectorAll('.banner-slider-control').forEach((button) => {
            button.addEventListener('click', () => {
                stopAutoplay();
                showSlide(currentIndex + (button.dataset.direction === 'next' ? 1 : -1));
                startAutoplay();
            });
        });

        const slider = container.querySelector('.banner-slider');
        slider.addEventListener('mouseenter', stopAutoplay);
        slider.addEventListener('mouseleave', startAutoplay);

        startAutoplay();
    },

    renderGallery: function (containerId) {
        const container = document.getElementById(containerId);
        if (!container) {
            return;
        }

        const gallery = this.getGallery();
        if (gallery.length === 0) {
            return;
        }

        container.innerHTML = gallery.map((item, index) => {
            const title = item.caption || 'Gallery Highlight';
            const filterCategory = this.normalizeGalleryCategory(item.category);
            const toneClass = this.getGalleryToneClass(index);
            const categoryLabel = item.category || 'Clinic Interior';

            return `
                <article class="gallery-showcase-card reveal d${(index % 6) + 1}" data-gallery-category="${filterCategory}" tabindex="0" style="cursor:pointer; outline:none; position:relative; overflow:hidden; border-radius:20px;">
                    <div class="gallery-showcase-surface ${toneClass}${item.image ? ' has-image' : ''}" style="position:relative; aspect-ratio:4/3;">
                        ${item.image
                    ? `<img src="${item.image}" alt="${title}" class="gallery-showcase-image" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; transition:transform 0.6s cubic-bezier(0.2, 0.7, 0.2, 1);">
                               <div class="gallery-info-overlay" style="position:absolute; inset:0; background:linear-gradient(to top, rgba(10, 22, 40, 0.95), transparent 70%); display:flex; align-items:flex-end; padding:24px; opacity:0; pointer-events:none; transition:all 0.4s ease; transform:translateY(15px);">
                                   <div style="display:flex; flex-direction:column; gap:4px;">
                                       <div class="gallery-showcase-tag" style="font-size:11px; color:rgba(255,255,255,0.7); text-transform:uppercase; letter-spacing:0.1em;">${categoryLabel}</div>
                                       <h3 class="gallery-showcase-title" style="color:white !important; font-size:18px; font-weight:600; margin:0; text-shadow:0 2px 4px rgba(0,0,0,0.3);">${title}</h3>
                                   </div>
                               </div>`
                    : `<div style="background:var(--grad-hero); width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
                                 <h3 style="color:white; font-size:18px;">${title}</h3>
                               </div>`}
                    </div>
                </article>
            `;
        }).join('');

        this.attachReveal(container);
        this.initGalleryFilters();
    },

    initGalleryFilters: function () {
        const buttons = Array.from(document.querySelectorAll('[data-gallery-filter]'));
        const cards = Array.from(document.querySelectorAll('[data-gallery-category]'));

        if (buttons.length === 0 || cards.length === 0) {
            return;
        }

        const applyFilter = (filter) => {
            buttons.forEach((button) => {
                button.classList.toggle('is-active', button.dataset.galleryFilter === filter);
            });

            cards.forEach((card) => {
                const matches = filter === 'all' || card.dataset.galleryCategory === filter;
                card.classList.toggle('is-hidden', !matches);
            });
        };

        buttons.forEach((button) => {
            if (button.dataset.galleryBound === 'true') {
                return;
            }

            button.dataset.galleryBound = 'true';
            button.addEventListener('click', () => {
                applyFilter(button.dataset.galleryFilter);
            });
        });

        const activeButton = buttons.find((button) => button.classList.contains('is-active')) || buttons[0];
        applyFilter(activeButton.dataset.galleryFilter);
    },

    renderServices: function (containerId) {
        const container = document.getElementById(containerId);
        if (!container) {
            return;
        }

        const services = this.getServices();
        if (services.length === 0) {
            return;
        }

        container.innerHTML = services.map((service) => `
            <div class="svc-card">
                <div class="svc-ico">${service.icon || '+'}</div>
                <div class="svc-nm">${service.title}</div>
                <div class="svc-ds">${service.description}</div>
                <div class="svc-price">${service.price || ''}</div>
            </div>
        `).join('');

        this.attachReveal(container);
    },

    renderBlogs: function (containerId) {
        const container = document.getElementById(containerId);
        if (!container) {
            return;
        }

        const blogs = this.getBlogs().filter((blog) => {
            // Check both status and published fields for compatibility
            return (blog.status === 'published') || (blog.published === true);
        });

        if (blogs.length === 0) {
            container.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: #999; padding: 40px;">No blogs published yet.</p>';
            return;
        }

        const defaultImages = this.getDefaultBlogs().reduce((map, blog) => {
            map[blog.category.toLowerCase()] = blog.image;
            return map;
        }, {});

        container.innerHTML = blogs.map((blog, index) => {
            const fallbackImage = defaultImages[(blog.category || 'Dental Tips').toLowerCase()] || '/images/blog-oral-health.svg';
            const imageSrc = blog.image || fallbackImage;
            const slug = blog.slug || blog.title.toLowerCase().replace(/\s+/g, '-');

            // Use summary or excerpt (full text, no truncation)
            const blogContent = blog.summary || blog.excerpt || '';

            return `
                <article class="blog-card reveal d${(index % 6) + 1}">
                    <div class="blog-thumb">
                        <img src="${imageSrc}" alt="${blog.title}" class="blog-image" data-fallback="${fallbackImage}" onerror="if(this.dataset.fallback && this.src !== this.dataset.fallback){this.src=this.dataset.fallback;}">
                    </div>
                    <div class="blog-body">
                        <div class="blog-cat">${blog.category || 'Dental Tips'}</div>
                        <h3>${blog.title}</h3>
                        <p>${blogContent}</p>
                        <div class="blog-footer">
                            <span class="blog-meta">${blog.date || ''}</span>
                            <a href="/blog/${slug}" class="read-more-btn">
                                Read <span class="arrow">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </article>
            `;
        }).join('');

        this.attachReveal(container);
    },

    setupStorageListener: function () {
        const self = this;

        console.log('[DentalData] Setting up real-time storage listeners...');

        const getPageName = () => {
            return document.body.dataset.pageName || document.body.dataset['page-name'] || 'home';
        };

        window.addEventListener('storage', function (event) {
            // Listen for changes from admin panel (different tab/window)
            if (event.key === 'dentalAdminData' && event.newValue) {
                console.log('[DentalData] Storage event detected: Admin data changed. Re-rendering all content...');

                const pageName = getPageName();

                // Re-render banners immediately
                if (document.getElementById('dental-banners')) {
                    self.renderBanners('dental-banners', pageName);
                }

                // Re-render gallery
                if (document.getElementById('dental-gallery')) {
                    self.renderGallery('dental-gallery');
                }

                // Re-render services
                if (document.getElementById('dental-services')) {
                    self.renderServices('dental-services');
                }

                // Re-render blogs
                if (document.getElementById('dental-blogs')) {
                    self.renderBlogs('dental-blogs');
                }

                // Update settings (clinic name, logo, etc)
                self.applySettings();
            }
        });

        // Also listen for changes within the same tab (via BroadcastChannel as fallback)
        if (window.BroadcastChannel) {
            try {
                const channel = new BroadcastChannel('dental_admin_updates');
                console.log('[DentalData] BroadcastChannel listener registered for admin updates');
                channel.onmessage = function (event) {
                    if (event.data.type === 'dataUpdated') {
                        console.log('[DentalData] Broadcast received: Admin data was just updated. Re-rendering...');

                        const pageName = getPageName();

                        if (document.getElementById('dental-banners')) {
                            self.renderBanners('dental-banners', pageName);
                        }

                        if (document.getElementById('dental-gallery')) {
                            self.renderGallery('dental-gallery');
                        }

                        if (document.getElementById('dental-services')) {
                            self.renderServices('dental-services');
                        }

                        if (document.getElementById('dental-blogs')) {
                            self.renderBlogs('dental-blogs');
                        }

                        self.applySettings();
                    }
                };
            } catch (e) {
                // BroadcastChannel not available in all browsers
                console.warn('[DentalData] BroadcastChannel not available:', e.message);
            }
        }
    },

    init: function () {
        this.applySettings();

        if (document.getElementById('dental-gallery')) {
            this.initGalleryFilters();
        }

        const hasData = !!this.getData();

        // Get page name from data-page-name or data-pageName attribute
        const pageName = document.body.dataset.pageName || document.body.dataset['page-name'] || 'home';
        console.log('[DentalData] Current page:', pageName);

        if (document.getElementById('dental-banners')) {
            this.renderBanners('dental-banners', pageName);
        }

        if (!hasData) {
            // Setup storage listener even if no data yet (for real-time updates when admin adds data)
            this.setupStorageListener();
            return;
        }

        if (document.getElementById('dental-gallery')) {
            this.renderGallery('dental-gallery');
        }

        if (document.getElementById('dental-services')) {
            this.renderServices('dental-services');
        }

        if (document.getElementById('dental-blogs')) {
            this.renderBlogs('dental-blogs');
        }

        // Setup storage listener for real-time updates
        this.setupStorageListener();
    }
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
        DentalData.init();
    });
} else {
    DentalData.init();
}
