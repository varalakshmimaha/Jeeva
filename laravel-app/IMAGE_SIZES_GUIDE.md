# Image Sizes Guide - Jiva Birth & Beyond Admin Settings

## CTA Section Background Images (About Us, Services, Testimonials)

**Location in Admin:** Settings → Background Images → "CTA Section Background Image"

**Recommended Size:**
- Dimensions: **1600x900px** or larger (16:9 aspect ratio)
- File Format: JPEG or PNG
- File Size: 500KB - 1MB (compressed)
- Max Upload Size: 5MB

**Display Notes:**
- Used as background image with `background-size: cover` and `background-position: center`
- Overlay gradient (semi-transparent dark green) applied on top
- Text centered on top of the background image
- Responsive scaling - maintains quality on all screen sizes

**Current Implementation:**
- About Us CTA: Label → Title → Description → Button (centered)
- Services CTA: Label → Title → Description → Button (centered)
- Testimonials CTA: Label → Title → Description → Button (centered)

---

## Vision & Mission Section Background Image

**Location in Admin:** Settings → Background Images → "Vision & Mission Section Background Image"

**Recommended Size:**
- Dimensions: **1600x900px** or larger (16:9 aspect ratio)
- File Format: JPEG or PNG
- File Size: 500KB - 1MB (compressed)
- Max Upload Size: 5MB

**Display Notes:**
- Used as background for Vision & Mission section on About page
- Overlay gradient (semi-transparent dark) applied
- Mission and Vision cards displayed on top
- Responsive scaling across devices

---

## Contact Page - Book Consultation Image

**Location in Admin:** Settings → Background Images → "Contact Page - Book Consultation Image"

**Recommended Size:**
- Dimensions: **450x450px** (square format)
- File Format: JPEG or PNG (WebP supported)
- File Size: 150KB - 300KB (compressed)
- Max Upload Size: 3MB

**Display Notes:**
- Displayed on the right side of the Book Consultation form on Contact page
- Square format fits perfectly in the form layout
- Rounded corners applied in CSS (20px border-radius)
- Box shadow for depth
- Responsive layout: stacks vertically on mobile (below 768px)

**Current Structure:**
- Left side: Contact form with name, email, phone, service, date/time, notes fields
- Right side: Book Consultation image (450x450px square)
- Layout: Side-by-side on desktop, stacked on mobile

---

## Other Admin Image Uploads

### Logo
- **Size:** Recommended height 60-80px
- **Format:** PNG (with transparency) or JPEG
- **Max Size:** 2MB
- **Location:** Settings → Logo & Favicon → "Upload Logo"

### Favicon
- **Size:** 32x32px or 64x64px
- **Format:** PNG or ICO
- **Max Size:** 1MB
- **Location:** Settings → Logo & Favicon → "Upload Favicon"

### Certifications/Accreditation Logos
- **Size:** Recommended width ~220px
- **Format:** PNG (transparent background preferred)
- **Max Size:** 2MB
- **Location:** Settings → Logo & Favicon → "Footer Certifications"

---

## Service Icons

**Model:** App\Models\Service

**Size Recommendations:**
- Dimensions: **150x150px** or **200x200px** (square)
- File Format: PNG with transparency
- File Size: 50KB - 150KB
- Max Upload Size: 10MB

**Display Notes:**
- Displayed at the top of each service card in the Services grid
- Centered alignment
- Used in service listing pages

---

## Blog Feature Images

**Model:** App\Models\Blog

**Size Recommendations:**
- Dimensions: **800x600px** or **1200x800px** (4:3 aspect ratio)
- File Format: JPEG or PNG
- File Size: 200KB - 400KB
- Max Upload Size: 10MB

---

## Gallery Images

**Model:** App\Models\GalleryItem

**Size Recommendations:**
- Dimensions: **800x800px** or **1024x1024px** (square)
- File Format: JPEG or PNG
- File Size: 200KB - 500KB
- Max Upload Size: 3MB

---

## Testimonial Images

**Model:** App\Models\Testimonial

**Size Recommendations:**
- Dimensions: **260x260px** (square, for profile pictures)
- File Format: JPEG or PNG
- File Size: 50KB - 150KB
- Max Upload Size: 2MB

**Display Notes:**
- Shown in a circular frame with CDEB8E border
- If no image provided, shows initials in colored background

---

## Summary Table

| Image Type | Recommended Size | Max File Size | Format |
|-----------|------------------|---------------|--------|
| CTA Background | 1600x900px | 5MB | JPEG/PNG |
| Vision & Mission BG | 1600x900px | 5MB | JPEG/PNG |
| Contact Image | 450x450px | 3MB | JPEG/PNG/WebP |
| Logo | 60-80px height | 2MB | PNG/JPEG |
| Favicon | 32-64px | 1MB | PNG/ICO |
| Service Icons | 150-200px | 10MB | PNG |
| Blog Images | 800x600px | 10MB | JPEG/PNG |
| Gallery Images | 800-1024px | 3MB | JPEG/PNG |
| Testimonial Images | 260x260px | 2MB | JPEG/PNG |

---

## Upload Location in Admin

All image uploads (except Banners and Testimonials which have separate modules) are managed in:
**Admin Dashboard → Settings → [Specific Tab]**

### Available Tabs:
1. **General** - Site info, Google Maps, booking slots
2. **Logo & Favicon** - Logo, Favicon, Certifications image
3. **Background Images** - CTA backgrounds, Vision & Mission background, Contact image
4. **Footer & Social** - Social media links
