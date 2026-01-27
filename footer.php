<footer class="site-footer py-5 border-top mt-5">
  <div class="container">
    <div class="row g-4 align-items-start">

      <div class="col-12 col-lg-4">
        <div class="fw-bold mb-2"><?php bloginfo('name'); ?></div>
        <p class="text-muted mb-3">Subscribe to our newsletter</p>

        <form class="d-flex gap-2" action="#" method="post">
          <input class="form-control" type="email" placeholder="Email" required>
          <button class="btn btn-primary" type="submit">Button</button>
        </form>
      </div>

      <div class="col-12 col-sm-4 col-lg-2">
        <div class="fw-semibold mb-2">Product</div>
        <?php
          wp_nav_menu([
            'theme_location' => 'footer_product',
            'container'      => false,
            'menu_class'     => 'list-unstyled m-0',
            'fallback_cb'    => false,
          ]);
        ?>
      </div>

      <div class="col-12 col-sm-4 col-lg-2">
        <div class="fw-semibold mb-2">Company</div>
        <?php
          wp_nav_menu([
            'theme_location' => 'footer_company',
            'container'      => false,
            'menu_class'     => 'list-unstyled m-0',
            'fallback_cb'    => false,
          ]);
        ?>
      </div>

      <div class="col-12 col-sm-4 col-lg-2">
        <div class="fw-semibold mb-2">Resources</div>
        <?php
          wp_nav_menu([
            'theme_location' => 'footer_resources',
            'container'      => false,
            'menu_class'     => 'list-unstyled m-0',
            'fallback_cb'    => false,
          ]);
        ?>
      </div>
    </div>

    <div class="footer-bottom mt-4 small text-muted">
		<div class="footer-legal">
			<a href="#">Terms &amp; Condition</a>
			<span class="mx-2">•</span>
			<a href="#">Privacy Policy</a>
		</div>

		<div class="footer-copy text-lg-end">
			&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Right Reserved
		</div>
	</div>

  </div>
  <?php wp_footer(); ?>
</body>
</html>
