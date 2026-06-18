<?php get_header(); ?>

<?php
$legal_content = function_exists('get_field') ? get_field('legal_content') : '';
$legal_content = $legal_content ?: '
<p>J\'utilise uniquement des cookies Google Analytics pour comprendre comment vous naviguez sur mon site — nombre de visites, pages consultées — afin de l\'améliorer. Aucun cookie publicitaire ou de réseaux sociaux n\'est déposé.</p>

<h2>Cookies déposés</h2>
<ul>
  <li><strong>_ga, _ga_* :</strong> identifient votre session de manière anonyme (durée : 2 ans)</li>
  <li><strong>_gid :</strong> idem, sur 24 heures</li>
</ul>
<p>Ces données sont traitées par Google LLC. <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">En savoir plus</a>.</p>

<h2>Gérer vos préférences</h2>
<p>Vous pouvez refuser ou supprimer ces cookies à tout moment depuis les paramètres de votre navigateur (<a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener">Chrome</a>, <a href="https://support.mozilla.org/fr/kb/activer-desactiver-cookies" target="_blank" rel="noopener">Firefox</a>, <a href="https://support.apple.com/fr-fr/guide/safari/sfri11471/mac" target="_blank" rel="noopener">Safari</a>, <a href="https://support.microsoft.com/fr-fr/windows/supprimer-et-g%C3%A9rer-les-cookies-168dab11-0753-043d-7c16-ede5947fc64d" target="_blank" rel="noopener">Edge</a>).</p>

<h2>Contact</h2>
<p>Une question ? Écrivez-moi à <a href="mailto:contact@jardins-du-chene.fr">contact@jardins-du-chene.fr</a></p>

<p><em>Dernière mise à jour : juin 2026</em></p>
';
?>

<main class="legal-page">
  <div class="legal-hero">
    <div class="container">
      <p class="section-eyebrow">Transparence &amp; cookies</p>
      <h1 class="section-title"><?php the_title(); ?></h1>
    </div>
  </div>

  <div class="container legal-content">
    <div class="legal-body"><?php echo wp_kses_post( $legal_content ); ?></div>
  </div>
</main>

<?php get_footer(); ?>
