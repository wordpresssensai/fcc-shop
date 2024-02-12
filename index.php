<?php get_header(); ?>

<div class="container-fluid">

<?php

    get_template_part ( 'template-parts/feature-products');

?>

<div class="container my-5">

  <div class="p-5 text-center bg-body-tertiary rounded-3">

    <svg class="bi mt-4 mb-3" style="color: var(--bs-indigo);" width="100" height="100"><use xlink:href="#bootstrap"/></svg>

    <h1 class="text-body-emphasis">Jumbotron with icon</h1>

    <p class="col-lg-8 mx-auto fs-5 text-muted">

      This is a custom jumbotron featuring an SVG image at the top, some longer text that wraps early thanks to a responsive <code>.col-*</code> class, and a customized call to action.

    </p>

    <div class="d-inline-flex gap-2 mb-5">

      <button class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
        Sign up for this month discount
        <svg class="bi ms-2" width="24" height="24"><use xlink:href="#arrow-right-short"/></svg>
      </button>
    </div>
  </div>
</div>

</div>

<?php get_footer() ?>
