<?php
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header py-3">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between gap-3">

      <!-- Brand -->
      <a class="site-brand d-flex align-items-center gap-2" href="<?php echo esc_url(home_url('/')); ?>">
        <span class="fw-bold"><?php bloginfo('name'); ?></span>
      </a>

      <!-- Desktop menu -->
      <nav class="d-none d-lg-block" aria-label="Primary">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'depth'          => 2,
            'fallback_cb'    => false,
            'walker'         => new VVT_Navwalker(),
            'menu_class'     => 'nav gap-4 site-header-nav',
          ]);
        ?>
      </nav>

      <!-- Desktop CTA -->
      <a class="site-header-cta d-none d-lg-inline-block" href="#">
        Sign in
      </a>

      <!-- Mobile toggle -->
      <button
        class="btn btn-outline-secondary d-lg-none"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#mobileMenu"
        aria-controls="mobileMenu"
        aria-label="Open menu"
      >
        Menu
      </button>

    </div>
  </div>
</header>

<!-- Mobile -->
<div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body">
    <?php
      wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'depth'          => 2,
        'fallback_cb'    => false,
        'walker'         => new VVT_Navwalker(),
        'menu_class'     => 'nav flex-column gap-2 site-header-nav-mobile',
      ]);
    ?>

    <a class="site-header-cta mt-3 d-inline-block" href="#">
      Sign in
    </a>
  </div>
</div>
