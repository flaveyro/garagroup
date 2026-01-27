This is a custom WordPress theme built with PHP (no builders), using:
- Bootstrap 
- Swiper.js 
- Custom Post Type: Team Members (+ custom taxonomy Department)
- Inquiry form (stores submissions in WP Admin)

## Used

- PHP 8.x (XAMPP)
- MySQL / MariaDB
- WordPress installed locally
- A local web server (Apache/Nginx)

## Quick Install (XAMPP example)

### 1) Put WordPress in your local server
Example (XAMPP macOS):
- WordPress folder:
  `/Applications/XAMPP/xamppfiles/htdocs/wordpress`

Open:
- `http://localhost/wordpress`

Complete the WordPress installer (DB name/user/password).

---

## Install the Theme

### 2) Copy the theme into WordPress
Place this theme folder here:

`wp-content/themes/velovita-example`

So it becomes:

`/Applications/XAMPP/xamppfiles/htdocs/wordpress/wp-content/themes/velovita-example`

### 3) Activate it
WP Admin:
- Appearance → Themes → **Velovita Example** → Activate

---

## Required: Permalinks (important for CPT archives)

Go to:
- Settings → Permalinks → choose **Post name** → Save

This ensures:
- Team archive works (example: `/team/`)

---

## Create Pages + Set the Home Page

### 1) Create pages
WP Admin → Pages → Add New:
- Home
- How it Works
- Blog
- About Us
- Products (optional)

---

#