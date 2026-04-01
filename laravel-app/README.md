# Western Dental & Orthodontics - Laravel Website

A modern, responsive dental clinic website built with **Laravel 11** and **Blade Templates**, featuring a professional design with smooth animations, banners for all pages, and mobile-friendly navigation.

## 🎨 Design Features

- **Modern Dark Theme**: Navy, teal, and gold color scheme with gradient backgrounds
- **Responsive Design**: Mobile-first approach with adaptive layouts
- **Smooth Animations**: Scroll reveal effects, hover interactions, and micro-animations
- **Professional Banners**: Consistent page headers with breadcrumbs and descriptions
- **Navigation**: Fixed navbar with mobile hamburger menu
- **CTA Sections**: Call-to-action strips on every page
- **Blog Grid**: Colorful card-based blog layout
- **Contact Forms**: Fully functional contact form with Laravel validation

## 📁 Project Structure

```
laravel-app/
├── app/Http/Controllers/
│   ├── PageController.php      # Routes pages to views
│   └── ContactController.php    # Handles contact form submissions
├── public/
│   ├── css/style.css            # Complete CSS styling
│   └── js/script.js             # Navigation, animations
├── resources/views/
│   ├── layouts/app.blade.php    # Main layout with navbar & footer
│   └── pages/
│       ├── home.blade.php       # Home with hero section
│       ├── services.blade.php   # Services page with banner
│       ├── about.blade.php      # About page with banner
│       ├── doctors.blade.php    # Team page with banner
│       ├── blog.blade.php       # Blog listing with banner
│       └── contact.blade.php    # Contact form with banner
└── routes/web.php               # All application routes
```

## 🎯 Pages Overview

### 1. **Home Page** (`/`)
- Hero section with animated background
- Services grid
- "Why Choose Us" section
- Statistics strip
- CTA section

### 2. **Services Page** (`/services`)
- Page header banner
- Full services grid with descriptions
- CTA section

### 3. **About Page** (`/about`)
- Page header banner
- About content
- Mission cards
- CTA section

### 4. **Doctors Page** (`/doctors`)
- Page header banner
- Doctor cards with specializations
- CTA section

### 5. **Blog Page** (`/blog`)
- Page header banner
- Blog card grid
- Colorful thumbnails
- CTA section

### 6. **Contact Page** (`/contact`)
- Page header banner
- Contact info section
- Contact form with validation
- Opening hours
- Map placeholder

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- SQLite (included)

### Installation

1. **Navigate to project**
   ```bash
   cd laravel-app
   ```

2. **Dependencies already installed during setup**

3. **Start development server**
   ```bash
   php artisan serve
   ```

   Visit: `http://localhost:8000`

## 🎯 Key Features

### Consistent Layout
- **Shared Navbar**: Fixed nav with logo and CTA button
- **Page Banners**: Professional headers on all pages
- **Footer**: Dark footer with info and links

### Responsive Design
- Mobile hamburger menu
- Adaptive grid layouts
- Touch-friendly buttons

### Animations
- Scroll reveal effects
- Hover interactions
- Smooth scrolling
- Cursor glow effect

### Form Validation
- Client-side validation
- Server-side Laravel validation
- Error messages
- Success feedback

## 🔧 Customization

### Update Contact Info
Edit [resources/views/layouts/app.blade.php](resources/views/layouts/app.blade.php):
```php
<a href="tel:+917483211870" class="phone-chip">📞 +91 74832 11870</a>
```

### Change Colors
Edit [public/css/style.css](public/css/style.css) CSS variables.

### Add Real Blog Posts
Create a Blog model and update PageController.

## 📱 Responsive Breakpoints

- Mobile: < 640px
- Tablet: 640px - 860px
- Desktop: > 860px

## 🎨 Color Palette

- **Navy**: `#0a1628`
- **Teal**: `#18b4d4`
- **Gold**: `#f0a030`
- **Cream**: `#f5f8fc`

## 📝 Sources

Layout and design adapted from: **western_dental_v3.html**

## 🛠 Technologies

- Laravel 11
- Blade Templates
- CSS3 with animations
- Vanilla JavaScript
- Responsive design

## 📧 Contact Form

Currently validates and displays success message. To enable:

1. Configure database for storage
2. Set up mail for notifications
3. Update ContactController

---

**Created**: March 30, 2026  
**Laravel**: 11.51.0  
**PHP**: 8.2.12


Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
