<?php get_header(); ?>

<main>

  <!-- HERO -->
  <section class="py-5">
    <div class="container text-center">
      <h1 class="display-5 fw-semibold mb-3">Headline of Website Will Goes Here<br>in Two Line and Centered</h1>
      <p class="text-muted mx-auto" style="max-width: 640px;">
        Lorem ipsum dolor sit amet consectetur. Elementum risus tempor at vivamus curabitur viverra diam nec.
      </p>
      <a class="btn btn-primary px-4 mt-2" href="#">Button</a>

      <div class="mt-5 rounded-4 bg-light" style="height: 280px;"></div>
    </div>
  </section>

  <!-- SECTION 1: image left, list right -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center fw-semibold mb-4" data-aos="fade-up">Headline of Website Will<br>Goes Here in Two Line</h2>

      <div class="row align-items-center g-4" data-aos="fade-right">
        <div class="col-lg-5">
          <div class="rounded-4 bg-light" style="height: 340px;"></div>
        </div>
        <div class="col-lg-7">
          <?php for ($i=1; $i<=4; $i++): ?>
            <div class="d-flex gap-3 py-3 border-bottom">
              <div class="rounded-circle bg-light flex-shrink-0" style="width:56px;height:56px;"></div>
              <div>
                <div class="fw-semibold">List Number <?php echo $i === 1 ? 'One' : ($i===2?'Two':($i===3?'Three':'Four')); ?></div>
                <div class="text-muted small">Lorem ipsum dolor sit amet consectetur. Laoreet rhoncus faucibus aliquet faucibus aliquam nibh elementum nunc.</div>
              </div>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 2: collage left, text right -->
  <section class="py-5" data-aos="fade-left">
  <div class="container">
    <div class="row align-items-center g-4">

      <!-- Collage  -->
      <div class="col-lg-6">
        <div class="vvt-collage">
          <div class="vvt-collage-tall rounded-4 bg-light"></div>

          <div class="vvt-collage-stack">
            <div class="vvt-collage-square rounded-4 bg-light"></div>
            <div class="vvt-collage-square rounded-4 bg-light"></div>
          </div>
        </div>
      </div>

      <!-- Text -->
      <div class="col-lg-6">
        <h2 class="fw-semibold mb-3">Headline of Website Will<br>Goes Here in Two Line</h2>
        <p class="text-muted">
          Lorem ipsum dolor sit amet consectetur. Elementum risus tempor at vivamus curabitur viverra diam nec.
        </p>

        <ul class="list-unstyled mt-4">
          <li class="d-flex gap-3 mb-3">
            <span class="vvt-bullet"></span>
            <div>
              <div class="fw-semibold">List Number One</div>
              <div class="text-muted small">Lorem ipsum dolor sit amet consectetur. Laoreet rhoncus faucibus aliquet faucibus.</div>
            </div>
          </li>

          <li class="d-flex gap-3 mb-3">
            <span class="vvt-bullet"></span>
            <div>
              <div class="fw-semibold">List Number Two</div>
              <div class="text-muted small">Lorem ipsum dolor sit amet consectetur. Laoreet rhoncus faucibus aliquet faucibus.</div>
            </div>
          </li>
        </ul>

      </div>

    </div>
  </div>
</section>


  <!-- TEAM -->
  <section class="py-5 bg-light" data-aos="fade-up">
	<div class="container">
		<div class="row align-items-end g-4">
		<div class="col-lg-4">
			<h3 class="fw-semibold">Meet Our Team</h3>
			<p class="text-muted">Lorem ipsum dolor sit amet consectetur. Elementum risus tempor at vivamus curabitur viverra diam nec.</p>
			<a href="<?php echo esc_url(get_post_type_archive_link('team_member')); ?>" class="link-primary text-decoration-none">Link Button</a>
		</div>

		<div class="col-lg-8">
		<div class="swiper team-swiper">
  <div class="swiper-wrapper">
    <?php
      $team = new WP_Query([
        'post_type' => 'team_member',
        'posts_per_page' => 8,
        'post_status' => 'publish',
      ]);

      if ($team->have_posts()):
        while ($team->have_posts()): $team->the_post();
          $role = get_post_meta(get_the_ID(), 'vvt_role', true);
    ?>
      <div class="swiper-slide" style="width:260px;">
        <article class="rounded-4 bg-white p-3 h-100">
          <div class="team-card-media rounded-4 bg-light mb-3">
            <?php if (has_post_thumbnail()): ?>
              <?php the_post_thumbnail('medium'); ?>
            <?php endif; ?>
          </div>

          <h4 class="h6 fw-semibold mb-1"><?php the_title(); ?></h4>
          <?php if ($role): ?>
            <div class="text-muted small mb-2"><?php echo esc_html($role); ?></div>
          <?php endif; ?>

          <a class="small text-decoration-none" href="<?php the_permalink(); ?>">View profile</a>
        </article>
      </div>
    <?php
        endwhile;
        wp_reset_postdata();
      else:
        echo '<div class="text-muted">Add Team Members in the Admin to populate this section.</div>';
      endif;
    ?>
  </div>

  <div class="team-swiper-pagination mt-3"></div>
</div>

		</div>
		</div>
	</div>
	</section>


  <!-- FEATURES  -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center fw-semibold mb-4">Headline of Website Will<br>Goes Here in Two Line</h2>

      <div class="row g-4">
        <?php for ($i=1; $i<=4; $i++): ?>
          <div class="col-12 col-md-6 col-lg-3">
            <div class="p-4 rounded-4 bg-light h-100">
              <div class="rounded-circle bg-white mb-3" style="width:48px;height:48px;"></div>
              <div class="fw-semibold">List Number <?php echo $i === 1 ? 'One' : ($i===2?'Two':($i===3?'Three':'Four')); ?></div>
              <div class="text-muted small">Lorem ipsum dolor sit amet consectetur. Bibendum feugiat ipsum sodales at libero.</div>
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <section class="py-5" data-aos="fade-up">
	<div class="container" style="max-width:720px;">
		<?php if (isset($_GET['sent'])): ?>
			<?php if ($_GET['sent'] == '1'): ?>
				<div class="alert alert-success">Thanks! Your message was sent.</div>
				<?php else: ?>
					<div class="alert alert-danger">Please fill all fields correctly.</div>
					<?php endif; ?>
					<?php endif; ?>
					
		<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="p-4 rounded-4 bg-light">
			<h2 class="text-center fw-semibold mb-4">Please leave a message to us<br>We'll be happy to hear from you</h2>
		<input type="hidden" name="action" value="vvt_inquiry">
		<?php wp_nonce_field('vvt_inquiry', 'vvt_inquiry_nonce'); ?>

		<!-- honeypot -->
		<input type="text" name="company" value="" style="display:none !important" tabindex="-1" autocomplete="off">

		<div class="mb-3">
			<label class="form-label">Name</label>
			<input class="form-control" type="text" name="name" required>
		</div>

		<div class="mb-3">
			<label class="form-label">Email</label>
			<input class="form-control" type="email" name="email" required>
		</div>

		<div class="mb-3">
			<label class="form-label">Message</label>
			<textarea class="form-control" name="message" rows="4" required></textarea>
		</div>

		<button class="btn btn-primary" type="submit">Send inquiry</button>
		</form>
	</div>
  </section>


</main>

<?php get_footer(); ?>
