<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- HEADER -->
<header id="header">
  <div class="container">
    <nav class="nav-inner">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg"
             alt="Les Jardins du Chêne — Jardinier Paysagiste"
             style="height:48px;width:auto;display:block;" />
      </a>

      <?php
      if ( has_nav_menu( 'primary' ) ) :
          wp_nav_menu( array(
              'theme_location' => 'primary',
              'container'      => false,
              'menu_class'     => 'nav-links',
              'items_wrap'     => '<ul class="nav-links">%3$s</ul>',
              'depth'          => 1,
          ) );
      else : ?>
      <ul class="nav-links">
        <li><a href="#about">À propos</a></li>
        <li><a href="#prestations">Prestations</a></li>
        <li><a href="#realisations">Réalisations</a></li>
        <li><a href="#temoignages">Témoignages</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#devis" class="nav-cta">Devis gratuit</a></li>
      </ul>
      <?php endif; ?>

      <button class="nav-burger" id="burger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </nav>
  </div>

  <!-- Mobile menu -->
  <nav class="mobile-menu" id="mobileMenu">
    <a href="#about"        class="mobile-link">À propos</a>
    <a href="#prestations"  class="mobile-link">Prestations</a>
    <a href="#realisations" class="mobile-link">Réalisations</a>
    <a href="#temoignages"  class="mobile-link">Témoignages</a>
    <a href="#contact"      class="mobile-link">Contact</a>
    <a href="#devis"        class="mobile-cta">Devis gratuit</a>
  </nav>
</header>
