<?php get_header(); ?>

<?php
/* ─────────────────────────────────────────────────────────────
   Récupération des champs ACF (avec fallbacks)
──────────────────────────────────────────────────────────────*/
$assets = get_template_directory_uri() . '/assets/images/';

// Hero
$hero_bg_img  = function_exists('get_field') ? get_field('hero_bg_image')  : null;
$hero_bg_url  = $hero_bg_img ? ( is_array($hero_bg_img) ? $hero_bg_img['url'] : wp_get_attachment_url($hero_bg_img) ) : $assets . 'banner_img.jpg';
$hero_eyebrow = function_exists('get_field') ? get_field('hero_eyebrow')     : "Créateur d'espaces vivants";
$hero_title   = function_exists('get_field') ? get_field('hero_title')       : 'Votre jardin,';
$hero_title_em= function_exists('get_field') ? get_field('hero_title_em')    : 'ma passion';
$hero_desc    = function_exists('get_field') ? get_field('hero_description') : "Conception, aménagement et entretien de jardins sur mesure. Je donne vie à vos espaces extérieurs avec harmonie et savoir-faire.";
$hero_eyebrow = $hero_eyebrow ?: "Créateur d'espaces vivants";
$hero_title   = $hero_title   ?: 'Votre jardin,';
$hero_title_em= $hero_title_em?: 'ma passion';
$hero_desc    = $hero_desc    ?: "Conception, aménagement et entretien de jardins sur mesure.";

// About
$about_img_raw = function_exists('get_field') ? get_field('about_image') : null;
$about_img_url = $about_img_raw ? ( is_array($about_img_raw) ? $about_img_raw['url'] : wp_get_attachment_url($about_img_raw) ) : $assets . 'glass-greenhouse.jpg';
$about_title   = function_exists('get_field') ? get_field('about_title')              : 'Passionné par la nature depuis toujours';
$about_desc    = function_exists('get_field') ? get_field('about_description')        : "Jardinier paysagiste indépendant, j'accompagne mes clients dans la création, l'aménagement et l'entretien de leurs jardins et espaces verts.";
$about_exp_num = function_exists('get_field') ? get_field('about_experience_number') : '15+';
$about_exp_txt = function_exists('get_field') ? get_field('about_experience_text')   : "ans d'expérience à votre service";
$about_title   = $about_title   ?: 'Passionné par la nature depuis toujours';
$about_desc    = $about_desc    ?: "Jardinier paysagiste indépendant, j'accompagne mes clients dans la création, l'aménagement et l'entretien de leurs jardins et espaces verts.";
$about_exp_num = $about_exp_num ?: '15+';
$about_exp_txt = $about_exp_txt ?: "ans d'expérience à votre service";

// Services
$services_defaults = array(
    1 => array(
        'title' => 'Création de jardins',
        'desc'  => 'Conception et réalisation de jardins sur mesure, de l\'esquisse à la plantation finale.',
        'tag'   => 'Création',
        'price' => 'À partir de <strong>80 € / m²</strong>',
        'img'   => $assets . 'image_2.jpg',
        'list'  => array('Étude et plan personnalisé','Sélection végétale adaptée','Massifs fleuris & haies','Pelouses et gazons','Terrasses et allées'),
    ),
    2 => array(
        'title' => "Entretien d'espaces verts",
        'desc'  => 'Un jardin entretenu régulièrement est un jardin sain et beau toute l\'année.',
        'tag'   => 'Entretien',
        'price' => 'À partir de <strong>45 € / heure</strong>',
        'img'   => $assets . 'image_3.jpg',
        'list'  => array('Tonte et taille de haies','Désherbage et binage','Arrosage et fertilisation','Élagage d\'arbres','Nettoyage saisonnier'),
    ),
    3 => array(
        'title' => 'Aménagement éco-responsable',
        'desc'  => 'Je privilégie les pratiques respectueuses de l\'environnement.',
        'tag'   => 'Éco-responsable',
        'price' => 'À partir de <strong>65 € / m²</strong>',
        'img'   => $assets . 'image_1.jpg',
        'list'  => array('Jardins naturels & sauvages','Système de récupération d\'eau','Compostage et permaculture','Potagers biologiques','Plantes mellifères'),
    ),
);
$services_icons = array(
    1 => '<svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>',
    2 => '<svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 22 16 8"/><path d="M3.47 12.53 5 11l1.53 1.53a3.5 3.5 0 0 1 0 4.94L5 19l-1.53-1.53a3.5 3.5 0 0 1 0-4.94z"/><path d="M7.47 8.53 9 7l1.53 1.53a3.5 3.5 0 0 1 0 4.94L9 15l-1.53-1.53a3.5 3.5 0 0 1 0-4.94z"/></svg>',
    3 => '<svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 2H22v2a4 4 0 0 1-4 4h-2V6a4 4 0 0 1 4-4z"/><path d="M2 22 16 8"/><path d="M3.47 12.53 5 11l1.53 1.53a3.5 3.5 0 0 1 0 4.94L5 19l-1.53-1.53a3.5 3.5 0 0 1 0-4.94z"/></svg>',
);

// Portfolio
$port_feat_img_raw = function_exists('get_field') ? get_field('portfolio_featured_image')    : null;
$port_feat_img_url = $port_feat_img_raw ? ( is_array($port_feat_img_raw) ? $port_feat_img_raw['url'] : wp_get_attachment_url($port_feat_img_raw) ) : $assets . 'image_6.jpg';
$port_feat_title   = function_exists('get_field') ? get_field('portfolio_featured_title')    : 'Aménagement de jardin contemporain';
$port_feat_location= function_exists('get_field') ? get_field('portfolio_featured_location') : 'Lyon (69)';
$port_feat_title    = $port_feat_title    ?: 'Aménagement de jardin contemporain';
$port_feat_location = $port_feat_location ?: 'Lyon (69)';

$portfolio_cards_defaults = array(
    1 => array('img' => $assets . 'colorful-flower-garden.jpg', 'title' => 'Jardin naturel & fleuri',   'location' => 'Villeurbanne (69)'),
    2 => array('img' => $assets . 'beautiful-green-park.jpg',   'title' => 'Jardin à la française',     'location' => 'Caluire-et-Cuire (69)'),
    3 => array('img' => $assets . 'image_2.jpg',                'title' => 'Cour & allée paysagère',    'location' => 'Écully (69)'),
    4 => array('img' => $assets . 'image_3.jpg',                'title' => 'Massifs & plantations',     'location' => 'Tassin-la-Demi-Lune (69)'),
);
$portfolio_cards_icons = array(
    1 => '<svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>',
    2 => '<svg viewBox="0 0 24 24"><path d="M2 22 16 8"/><path d="M3.47 12.53 5 11l1.53 1.53a3.5 3.5 0 0 1 0 4.94L5 19l-1.53-1.53a3.5 3.5 0 0 1 0-4.94z"/></svg>',
    3 => '<svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>',
    4 => '<svg viewBox="0 0 24 24"><path d="M12 22V12"/><path d="M12 12C12 7 17 4 17 4S14 9 12 12"/><path d="M12 12C12 7 7 4 7 4S10 9 12 12"/><line x1="5" y1="22" x2="19" y2="22"/></svg>',
);

// Témoignages
$temo_defaults = array(
    1 => array(
        'text'     => "Lucas a complètement transformé notre jardin. Un professionnel à l'écoute, des conseils précieux et un résultat qui dépasse nos attentes. Notre terrasse est maintenant un véritable havre de paix.",
        'author'   => 'Sophie M.',
        'location' => 'Propriétaire à Lyon',
        'initials' => 'SM',
    ),
    2 => array(
        'text'     => "Contrat d'entretien depuis 2 ans, mon jardin est impeccable en toutes saisons. Lucas est ponctuel, sérieux et passionné par son métier. Je le recommande sans hésitation à tous mes voisins.",
        'author'   => 'Pierre D.',
        'location' => 'Maison de campagne, Ain',
        'initials' => 'PD',
    ),
    3 => array(
        'text'     => "Notre potager bio a été créé avec beaucoup de soin et de professionnalisme. Lucas a su nous conseiller sur les meilleures variétés et l'organisation des cultures. Résultat magnifique et pratique.",
        'author'   => 'Marie L.',
        'location' => 'Résidence à Caluire',
        'initials' => 'ML',
    ),
);

// Devis form image
$devis_img_raw = function_exists('get_field') ? get_field('devis_form_image') : null;
$devis_img_url = $devis_img_raw ? ( is_array($devis_img_raw) ? $devis_img_raw['url'] : wp_get_attachment_url($devis_img_raw) ) : $assets . 'grassland-landscape-greening-environment-park-background.jpg';

// Contact
$contact_phone = function_exists('get_field') ? get_field('contact_phone') : '06 12 34 56 78';
$contact_email = function_exists('get_field') ? get_field('contact_email') : 'contact@jardins-du-chene.fr';
$contact_zone  = function_exists('get_field') ? get_field('contact_zone')  : 'Lyon et alentours (40 km)';
$contact_hours = function_exists('get_field') ? get_field('contact_hours') : 'Lun – Sam, 8h – 18h';
$contact_phone = $contact_phone ?: '06 12 34 56 78';
$contact_email = $contact_email ?: 'contact@jardins-du-chene.fr';
$contact_zone  = $contact_zone  ?: 'Lyon et alentours (40 km)';
$contact_hours = $contact_hours ?: 'Lun – Sam, 8h – 18h';
?>

<!-- ══════════════════════════════════════════════════════════
     HERO
══════════════════════════════════════════════════════════════ -->
<section id="hero">
  <div class="hero-bg" style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>')">
    <div class="hero-bg-pattern"></div>
    <svg style="position:absolute;bottom:80px;right:5%;opacity:.08;width:480px;height:480px;pointer-events:none" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="100" cy="100" r="90" stroke="white" stroke-width="1.5"/>
      <path d="M100 40 C80 55 65 70 60 90 C55 110 65 130 80 145 C90 155 100 160 100 160 C100 160 110 155 120 145 C135 130 145 110 140 90 C135 70 120 55 100 40Z" stroke="white" stroke-width="1.5" fill="none"/>
      <path d="M100 40 L100 160" stroke="white" stroke-width="1" opacity=".5"/>
      <path d="M70 75 C85 70 100 68 115 72" stroke="white" stroke-width="1" opacity=".5"/>
      <path d="M65 100 C80 95 100 93 120 97" stroke="white" stroke-width="1" opacity=".5"/>
      <path d="M70 125 C85 120 100 118 115 122" stroke="white" stroke-width="1" opacity=".5"/>
      <line x1="30" y1="180" x2="170" y2="180" stroke="white" stroke-width="1.5"/>
      <path d="M40 180 C40 170 50 160 60 155 C60 160 55 170 55 180" stroke="white" stroke-width="1.5" fill="none"/>
      <path d="M155 180 C155 165 145 155 135 148 C135 158 140 170 140 180" stroke="white" stroke-width="1.5" fill="none"/>
    </svg>
  </div>
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <div class="hero-eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></div>
    <h1 class="hero-title">
      <?php echo esc_html( $hero_title ); ?><br>
      <em><?php echo esc_html( $hero_title_em ); ?></em>
    </h1>
    <p class="hero-desc"><?php echo esc_html( $hero_desc ); ?></p>
    <div class="hero-actions">
      <a href="#prestations" class="btn btn-primary">Découvrir mes prestations</a>
      <a href="#rdv" class="btn btn-outline" style="border-color:rgba(255,255,255,.5);color:var(--white);">Prendre rendez-vous</a>
    </div>
  </div>
  <div class="hero-services">
    <div class="hero-services-inner">
      <div class="hero-service-card">
        <div class="hero-service-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>
        </div>
        <div class="hero-service-text">
          <strong>Création</strong>
          <span>Jardins sur mesure</span>
        </div>
      </div>
      <div class="hero-service-card">
        <div class="hero-service-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
        </div>
        <div class="hero-service-text">
          <strong>Entretien</strong>
          <span>Espaces verts</span>
        </div>
      </div>
      <div class="hero-service-card">
        <div class="hero-service-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 22 16 8"/><path d="M3.47 12.53 5 11l1.53 1.53a3.5 3.5 0 0 1 0 4.94L5 19l-1.53-1.53a3.5 3.5 0 0 1 0-4.94z"/><path d="M7.47 8.53 9 7l1.53 1.53a3.5 3.5 0 0 1 0 4.94L9 15l-1.53-1.53a3.5 3.5 0 0 1 0-4.94z"/><path d="M11.47 4.53 13 3l1.53 1.53a3.5 3.5 0 0 1 0 4.94L13 11l-1.53-1.53a3.5 3.5 0 0 1 0-4.94z"/><path d="M20 2H22v2a4 4 0 0 1-4 4h-2V6a4 4 0 0 1 4-4z"/></svg>
        </div>
        <div class="hero-service-text">
          <strong>Éco-responsable</strong>
          <span>Des choix durables</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     À PROPOS
══════════════════════════════════════════════════════════════ -->
<section id="about" style="background-image: url('<?php echo esc_url( $assets . 'contact_section_img.png' ); ?>')">
  <div class="container">
    <div class="about-grid">
      <!-- Image -->
      <div class="about-img-wrap fade-in">
        <div class="about-img-card">
          <img src="<?php echo esc_url( $about_img_url ); ?>" alt="Jardin aménagé par Lucas Morel, Les Jardins du Chêne" class="about-img-photo" />
          <div class="about-img-bottom">
            <div class="about-img-bottom-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>
            </div>
            <div>
              <span class="about-img-bottom-num"><?php echo esc_html( $about_exp_num ); ?></span>
              <span class="about-img-bottom-sub"><?php echo esc_html( $about_exp_txt ); ?></span>
            </div>
          </div>
        </div>
      </div>
      <!-- Texte -->
      <div class="about-text fade-in fade-in-delay-1">
        <div class="about-label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>
          À propos
        </div>
        <h2 class="section-title"><?php echo esc_html( $about_title ); ?></h2>
        <p class="section-sub"><?php echo esc_html( $about_desc ); ?></p>
        <div class="about-values">
          <div class="about-value">
            <div class="about-value-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <div class="about-value-content">
              <p>Écoute &amp; conseil <span class="about-value-dot"></span></p>
              <span>Chaque projet<br>est unique</span>
            </div>
          </div>
          <div class="about-value">
            <div class="about-value-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 22V12"/><path d="M12 12C12 7 17 4 17 4S14 9 12 12"/><path d="M12 12C12 7 7 4 7 4S10 9 12 12"/><line x1="5" y1="22" x2="19" y2="22"/></svg>
            </div>
            <div class="about-value-content">
              <p>Savoir-faire artisanal <span class="about-value-dot"></span></p>
              <span>Maîtrise des techniques<br>et du détail</span>
            </div>
          </div>
          <div class="about-value">
            <div class="about-value-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>
            </div>
            <div class="about-value-content">
              <p>Plantes locales <span class="about-value-dot"></span></p>
              <span>Espèces adaptées<br>au climat</span>
            </div>
          </div>
          <div class="about-value">
            <div class="about-value-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
            </div>
            <div class="about-value-content">
              <p>Délais respectés <span class="about-value-dot"></span></p>
              <span>Ponctualité<br>et engagement</span>
            </div>
          </div>
        </div>
        <a href="#devis" class="btn-devis-full">
          <span class="btn-devis-full-left">
            <span class="btn-devis-full-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>
            </span>
            Demander un devis
          </span>
          <span class="btn-devis-full-arrow">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
          </span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     PRESTATIONS
══════════════════════════════════════════════════════════════ -->
<section id="prestations">
  <div class="container">
    <div class="prestations-head fade-in">
      <div class="section-label">Mes services</div>
      <h2 class="section-title">Mes prestations</h2>
      <p class="section-sub">De la conception à l'entretien, je vous propose un accompagnement complet pour transformer vos espaces extérieurs.</p>
    </div>
    <div class="prestations-grid">
      <?php
      $delay_classes = array(1 => '', 2 => ' fade-in-delay-1', 3 => ' fade-in-delay-2');
      for ($n = 1; $n <= 3; $n++) :
        $s_img_raw = function_exists('get_field') ? get_field("service_{$n}_image") : null;
        $s_img_url = $s_img_raw ? ( is_array($s_img_raw) ? $s_img_raw['url'] : wp_get_attachment_url($s_img_raw) ) : $services_defaults[$n]['img'];
        $s_title   = function_exists('get_field') ? get_field("service_{$n}_title") : null;
        $s_title   = $s_title ?: $services_defaults[$n]['title'];
        $s_price   = function_exists('get_field') ? get_field("service_{$n}_price") : null;
        $s_price   = $s_price ?: $services_defaults[$n]['price'];
      ?>
      <div class="prestation-card fade-in<?php echo $delay_classes[$n]; ?>">
        <div class="prestation-img">
          <img src="<?php echo esc_url($s_img_url); ?>" alt="<?php echo esc_attr($s_title); ?>" />
          <span class="prestation-tag"><?php echo esc_html($services_defaults[$n]['tag']); ?></span>
        </div>
        <div class="prestation-body">
          <div class="prestation-icon">
            <?php echo $services_icons[$n]; ?>
          </div>
          <h3><?php echo esc_html($s_title); ?></h3>
          <p><?php echo esc_html($services_defaults[$n]['desc']); ?></p>
          <ul class="prestation-list">
            <?php foreach ($services_defaults[$n]['list'] as $item) : ?>
            <li><?php echo esc_html($item); ?></li>
            <?php endforeach; ?>
          </ul>
          <div class="prestation-price">À partir de <?php echo $s_price; ?></div>
          <a href="#devis" class="prestation-link">
            Demander un devis
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
          </a>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     RÉALISATIONS
══════════════════════════════════════════════════════════════ -->
<section id="realisations" style="background-image: url('<?php echo esc_url( $assets . 'réalisations_img.png' ); ?>')">
  <div class="container">
    <div class="realisations-head fade-in">
      <div class="real-header-left">
        <div class="real-portfolio-label">Portfolio</div>
        <h2 class="section-title">Mes réalisations</h2>
        <p class="section-sub">Découvrez une sélection de projets récents qui reflètent mon savoir-faire et ma passion pour les espaces verts.</p>
        <div class="real-stats">
          <div class="real-stat-item">
            <div class="real-stat-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>
            </div>
            <div class="real-stat-text">
              <strong>Projets sur mesure</strong>
              <span>100% personnalisés</span>
            </div>
          </div>
          <div class="real-stat-item">
            <div class="real-stat-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 22V12"/><path d="M12 12C12 7 17 4 17 4S14 9 12 12"/><path d="M12 12C12 7 7 4 7 4S10 9 12 12"/><line x1="5" y1="22" x2="19" y2="22"/></svg>
            </div>
            <div class="real-stat-text">
              <strong>Approche durable</strong>
              <span>Respect de la nature</span>
            </div>
          </div>
          <div class="real-stat-item">
            <div class="real-stat-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9,16 11,18 15,14"/></svg>
            </div>
            <div class="real-stat-text">
              <strong>Satisfaction client</strong>
              <span>Engagement &amp; suivi</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Grille -->
    <div class="realisations-grid fade-in">
      <!-- Grande carte -->
      <div class="real-featured">
        <img src="<?php echo esc_url($port_feat_img_url); ?>" alt="<?php echo esc_attr($port_feat_title); ?>" />
        <div class="real-featured-overlay">
          <div class="real-featured-info">
            <div class="real-featured-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21,15 16,10 5,21"/></svg>
            </div>
            <h4><?php echo esc_html($port_feat_title); ?></h4>
            <span><?php echo esc_html($port_feat_location); ?></span>
          </div>
        </div>
      </div>
      <!-- 4 petites cartes -->
      <div class="real-small-grid">
        <?php for ($n = 1; $n <= 4; $n++) :
          $c_img_raw = function_exists('get_field') ? get_field("portfolio_card_{$n}_image") : null;
          $c_img_url = $c_img_raw ? ( is_array($c_img_raw) ? $c_img_raw['url'] : wp_get_attachment_url($c_img_raw) ) : $portfolio_cards_defaults[$n]['img'];
          $c_title   = function_exists('get_field') ? get_field("portfolio_card_{$n}_title")    : null;
          $c_title   = $c_title ?: $portfolio_cards_defaults[$n]['title'];
          $c_loc     = function_exists('get_field') ? get_field("portfolio_card_{$n}_location") : null;
          $c_loc     = $c_loc   ?: $portfolio_cards_defaults[$n]['location'];
        ?>
        <div class="real-small-card">
          <img src="<?php echo esc_url($c_img_url); ?>" alt="<?php echo esc_attr($c_title); ?>" />
          <div class="real-small-overlay">
            <div class="real-small-icon">
              <?php echo $portfolio_cards_icons[$n]; ?>
            </div>
            <div class="real-small-info">
              <h4><?php echo esc_html($c_title); ?></h4>
              <span><?php echo esc_html($c_loc); ?></span>
            </div>
          </div>
        </div>
        <?php endfor; ?>
      </div>
    </div>
    <!-- Barre CTA -->
    <div class="real-cta-bar fade-in">
      <div class="real-cta-left">
        <div class="real-cta-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>
        </div>
        <div>
          <strong>Un projet en tête ?</strong>
          <span>Discutons de vos idées et créons ensemble un espace qui vous ressemble.</span>
        </div>
      </div>
      <a href="#devis" class="btn-real-devis">
        Demander un devis
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     TÉMOIGNAGES
══════════════════════════════════════════════════════════════ -->
<section id="temoignages">
  <div class="container">
    <div class="temoignages-head fade-in">
      <div class="section-label">Témoignages</div>
      <h2 class="section-title">Ce que disent mes clients</h2>
    </div>
    <div class="temoignages-grid">
      <?php
      $temo_delay = array(1 => '', 2 => ' fade-in-delay-1', 3 => ' fade-in-delay-2');
      for ($n = 1; $n <= 3; $n++) :
        $t_text     = function_exists('get_field') ? get_field("temo_{$n}_text")     : null;
        $t_author   = function_exists('get_field') ? get_field("temo_{$n}_author")   : null;
        $t_location = function_exists('get_field') ? get_field("temo_{$n}_location") : null;
        $t_initials = function_exists('get_field') ? get_field("temo_{$n}_initials") : null;
        $t_text     = $t_text     ?: $temo_defaults[$n]['text'];
        $t_author   = $t_author   ?: $temo_defaults[$n]['author'];
        $t_location = $t_location ?: $temo_defaults[$n]['location'];
        $t_initials = $t_initials ?: $temo_defaults[$n]['initials'];
      ?>
      <div class="temoignage-card fade-in<?php echo $temo_delay[$n]; ?>">
        <div class="temo-quote">"</div>
        <div class="temo-stars">
          <?php for ($s = 0; $s < 5; $s++) : ?>
          <svg viewBox="0 0 24 24"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>
          <?php endfor; ?>
        </div>
        <p class="temo-text"><?php echo esc_html($t_text); ?></p>
        <div class="temo-author">
          <div class="temo-avatar"><?php echo esc_html($t_initials); ?></div>
          <div class="temo-author-info">
            <strong><?php echo esc_html($t_author); ?></strong>
            <span><?php echo esc_html($t_location); ?></span>
          </div>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     DEVIS
══════════════════════════════════════════════════════════════ -->
<section id="devis">
  <div class="container">
    <div class="devis-grid">
      <!-- Colonne info -->
      <div class="devis-info fade-in">
        <div class="section-label left">Tarification</div>
        <h2 class="section-title">Votre devis<br>gratuit &amp; sans engagement</h2>
        <p class="section-sub">Décrivez votre projet en quelques mots et je vous réponds sous 48h avec une estimation personnalisée et transparente.</p>
        <div class="devis-features">
          <div class="devis-feature">
            <div class="devis-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div class="devis-feature-text">
              <strong>Devis 100% gratuit</strong>
              <span>Aucun engagement, réponse sous 48h</span>
            </div>
          </div>
          <div class="devis-feature">
            <div class="devis-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
            </div>
            <div class="devis-feature-text">
              <strong>Visite sur place offerte</strong>
              <span>Pour les projets de création ou grands travaux</span>
            </div>
          </div>
          <div class="devis-feature">
            <div class="devis-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <div class="devis-feature-text">
              <strong>Tarifs transparents</strong>
              <span>Prix clairs, pas de mauvaise surprise</span>
            </div>
          </div>
          <div class="devis-feature">
            <div class="devis-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div class="devis-feature-text">
              <strong>Déplacement inclus</strong>
              <span>Dans un rayon de 40 km autour de Lyon</span>
            </div>
          </div>
        </div>
        <div class="devis-stats">
          <div class="devis-stat">
            <div class="devis-stat-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>
            </div>
            <div class="devis-stat-value">+250</div>
            <div class="devis-stat-label">projets réalisés</div>
          </div>
          <div class="devis-stat">
            <div class="devis-stat-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <div class="devis-stat-value">4,9/5</div>
            <div class="devis-stat-label">avis clients</div>
          </div>
          <div class="devis-stat">
            <div class="devis-stat-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
            </div>
            <div class="devis-stat-label">Réponse sous</div>
            <div class="devis-stat-value">48h</div>
          </div>
        </div>
      </div>
      <!-- Formulaire -->
      <div class="devis-form-wrap fade-in fade-in-delay-1">
        <img src="<?php echo esc_url($devis_img_url); ?>" alt="Jardin aménagé par Les Jardins du Chêne" class="devis-form-img" />
        <div class="devis-form-body">
          <h3 class="devis-form-title">
            Décrivez votre projet
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
          </h3>
          <form id="devisForm" novalidate>
            <?php wp_nonce_field( 'jardins_devis', 'devis_nonce' ); ?>
            <div class="form-row">
              <div class="form-group">
                <label for="d-prenom">Prénom *</label>
                <input type="text" id="d-prenom" name="d-prenom" placeholder="Jean" required />
              </div>
              <div class="form-group">
                <label for="d-nom">Nom *</label>
                <input type="text" id="d-nom" name="d-nom" placeholder="Dupont" required />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="d-email">Email *</label>
                <input type="email" id="d-email" name="d-email" placeholder="jean@email.fr" required />
              </div>
              <div class="form-group">
                <label for="d-tel">Téléphone</label>
                <input type="tel" id="d-tel" name="d-tel" placeholder="06 00 00 00 00" />
              </div>
            </div>
            <div class="form-group">
              <label for="d-ville">Ville / Code postal *</label>
              <input type="text" id="d-ville" name="d-ville" placeholder="Lyon, 69000" required />
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="d-service">Type de prestation *</label>
                <select id="d-service" name="d-service" required>
                  <option value="">Choisir une prestation...</option>
                  <option>Création de jardin</option>
                  <option>Entretien régulier</option>
                  <option>Aménagement éco-responsable</option>
                  <option>Potager biologique</option>
                  <option>Taille &amp; élagage</option>
                  <option>Autre</option>
                </select>
              </div>
              <div class="form-group">
                <label for="d-surface">Surface approximative</label>
                <select id="d-surface" name="d-surface">
                  <option value="">Je ne sais pas encore</option>
                  <option>Moins de 50 m²</option>
                  <option>50 – 200 m²</option>
                  <option>200 – 500 m²</option>
                  <option>Plus de 500 m²</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="d-message">Décrivez votre projet *</label>
              <textarea id="d-message" name="d-message" placeholder="Parlez-moi de votre espace extérieur, vos envies, vos contraintes, votre budget estimatif..." required></textarea>
            </div>
            <button type="submit" class="form-submit">
              <span class="form-submit-left">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>
                Envoyer ma demande de devis
              </span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </button>
            <p class="form-note">* Champs obligatoires — Vos données restent confidentielles</p>
          </form>
          <div class="form-success" id="devisSuccess">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
            <p><strong>Demande envoyée avec succès !</strong><br>Je vous réponds sous 48h. À bientôt !</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     RDV / CALENDRIER
══════════════════════════════════════════════════════════════ -->
<section id="rdv" style="background-image: url('<?php echo esc_url( $assets . 'background_plaaning.png' ); ?>')">
  <div class="container">
    <div class="rdv-head fade-in">
      <div class="section-label">Planning</div>
      <h2 class="section-title">Prendre rendez-vous</h2>
      <p class="section-sub">Choisissez un créneau disponible pour une visite sur place, une consultation ou un rendez-vous de suivi.</p>
    </div>
    <div class="rdv-container fade-in">
      <!-- Calendrier -->
      <div class="rdv-calendar-wrap">
        <div class="cal-header">
          <div class="cal-title" id="calTitle"></div>
          <div class="cal-nav">
            <button id="calPrev" aria-label="Mois précédent">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </button>
            <button id="calNext" aria-label="Mois suivant">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>
          </div>
        </div>
        <div class="cal-grid" id="calGrid"></div>
      </div>
      <!-- Créneaux -->
      <div class="rdv-slots-wrap">
        <div class="rdv-slots-title" id="slotsTitle">Créneaux disponibles</div>
        <div id="slotsContent"></div>
        <button class="rdv-confirm-btn" id="rdvConfirmBtn">Confirmer ce créneau</button>
      </div>
    </div>
    <!-- Trois arguments -->
    <div class="rdv-features">
      <div class="rdv-feature-item">
        <div class="rdv-feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>
        </div>
        <div class="rdv-feature-text">
          <strong>Intervention sur mesure</strong>
          <span>Chaque projet est unique, comme votre jardin.</span>
        </div>
      </div>
      <div class="rdv-feature-item">
        <div class="rdv-feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 22V12"/><path d="M12 12C12 7 17 4 17 4S14 9 12 12"/><path d="M12 12C12 7 7 4 7 4S10 9 12 12"/><line x1="5" y1="22" x2="19" y2="22"/></svg>
        </div>
        <div class="rdv-feature-text">
          <strong>Conseils d'expert</strong>
          <span>Bénéficiez de mon expertise et de mon accompagnement.</span>
        </div>
      </div>
      <div class="rdv-feature-item">
        <div class="rdv-feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9,16 11,18 15,14"/></svg>
        </div>
        <div class="rdv-feature-text">
          <strong>Prise de rendez-vous simple</strong>
          <span>Choisissez le créneau qui vous convient en quelques clics.</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     CONTACT
══════════════════════════════════════════════════════════════ -->
<section id="contact">
  <div class="container">
    <div class="contact-grid">
      <!-- Colonne infos -->
      <div class="contact-info fade-in">
        <div class="section-label left">Contact</div>
        <h2 class="contact-title-large">Parlons de<br>votre projet</h2>
        <div class="contact-divider"></div>
        <p class="section-sub">Vous avez une question, un projet à concrétiser ou vous souhaitez un conseil ? Je suis à votre écoute et vous réponds dans les meilleurs délais.</p>
        <div class="contact-items">
          <div class="contact-item">
            <div class="contact-item-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2H6.6a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.08 6.08l.95-.95a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 17z"/></svg>
            </div>
            <div class="contact-item-text">
              <strong>Téléphone</strong>
              <span><?php echo esc_html($contact_phone); ?></span>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div class="contact-item-text">
              <strong>Email</strong>
              <span><?php echo esc_html($contact_email); ?></span>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div class="contact-item-text">
              <strong>Zone d'intervention</strong>
              <span><?php echo esc_html($contact_zone); ?></span>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
            </div>
            <div class="contact-item-text">
              <strong>Horaires</strong>
              <span><?php echo esc_html($contact_hours); ?></span>
            </div>
          </div>
        </div>
      </div>
      <!-- Colonne carte -->
      <div class="contact-map-wrap fade-in fade-in-delay-1">
        <div class="contact-map">
          <div class="contact-map-popup">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <div>
              <strong>Basé à Lyon</strong>
              <span>Intervention dans un rayon de 40 km</span>
            </div>
          </div>
          <div class="contact-map-circle"></div>
          <iframe
            src="https://www.openstreetmap.org/export/embed.html?bbox=4.58%2C45.60%2C5.10%2C45.92&amp;layer=mapnik&amp;marker=45.7640%2C4.8357"
            allowfullscreen
            loading="lazy"
            title="Zone d'intervention Les Jardins du Chêne – Lyon"
            style="width:100%;height:100%;min-height:300px;border:0;display:block;"></iframe>
        </div>
        <div class="contact-map-features">
          <div class="contact-map-feature">
            <div class="contact-map-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <span>Écoute &amp; conseil personnalisés</span>
          </div>
          <div class="contact-map-feature">
            <div class="contact-map-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9,12 11,14 15,10"/></svg>
            </div>
            <span>Accompagnement de A à Z</span>
          </div>
          <div class="contact-map-feature">
            <div class="contact-map-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/></svg>
            </div>
            <span>Solutions durables &amp; responsables</span>
          </div>
        </div>
      </div>
    </div>
    <!-- CTA -->
    <div class="contact-cta" style="margin-top:24px;">
      <div class="contact-cta-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
      </div>
      <div class="contact-cta-text">
        <strong>Une réponse rapide garantie</strong>
        <span>Je m'engage à vous répondre sous 24h ouvrées.</span>
      </div>
      <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="contact-cta-btn">
        M'écrire
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
