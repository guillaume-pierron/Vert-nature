<?php
/**
 * Les Jardins du Chêne — functions.php
 */

/* ─────────────────────────────────────────────────────────────
   1. THEME SUPPORT
──────────────────────────────────────────────────────────────*/
function jardins_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) );

    // Image sizes for portfolio
    add_image_size( 'portfolio-featured', 800, 600, true );
    add_image_size( 'portfolio-card',     400, 300, true );
    add_image_size( 'about-photo',        600, 460, true );
    add_image_size( 'prestation-img',     600, 220, true );

    // Navigation menu
    register_nav_menus( array(
        'primary' => __( 'Menu principal', 'lesjardinsduchenee' ),
    ) );
}
add_action( 'after_setup_theme', 'jardins_setup' );

/* ─────────────────────────────────────────────────────────────
   2. ENQUEUE SCRIPTS & STYLES
──────────────────────────────────────────────────────────────*/
function jardins_enqueue_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'jardins-google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Main CSS
    wp_enqueue_style(
        'jardins-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array( 'jardins-google-fonts' ),
        '1.0'
    );

    // Main JS
    wp_enqueue_script(
        'jardins-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0',
        true
    );

    // Pass AJAX URL and nonce to JS
    wp_localize_script( 'jardins-main', 'jardinsAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'jardins_devis_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'jardins_enqueue_scripts' );

/* ─────────────────────────────────────────────────────────────
   3. AJAX HANDLER — FORMULAIRE DEVIS
──────────────────────────────────────────────────────────────*/
add_action( 'wp_ajax_jardins_send_devis',        'jardins_handle_devis' );
add_action( 'wp_ajax_nopriv_jardins_send_devis', 'jardins_handle_devis' );

function jardins_handle_devis() {
    check_ajax_referer( 'jardins_devis_nonce', 'nonce' );

    $to      = function_exists( 'get_field' ) ? ( get_field( 'contact_email', 'option' ) ?: 'contact@jardins-du-chene.fr' ) : 'contact@jardins-du-chene.fr';
    $subject = 'Nouvelle demande de devis - Les Jardins du Chêne';

    $body  = "Prénom: "   . sanitize_text_field( $_POST['d-prenom']  ?? '' ) . "\n";
    $body .= "Nom: "      . sanitize_text_field( $_POST['d-nom']     ?? '' ) . "\n";
    $body .= "Email: "    . sanitize_email(      $_POST['d-email']   ?? '' ) . "\n";
    $body .= "Téléphone: ". sanitize_text_field( $_POST['d-tel']     ?? '' ) . "\n";
    $body .= "Ville: "    . sanitize_text_field( $_POST['d-ville']   ?? '' ) . "\n";
    $body .= "Service: "  . sanitize_text_field( $_POST['d-service'] ?? '' ) . "\n";
    $body .= "Surface: "  . sanitize_text_field( $_POST['d-surface'] ?? '' ) . "\n";
    $body .= "Message: "  . sanitize_textarea_field( $_POST['d-message'] ?? '' ) . "\n";

    wp_mail( $to, $subject, $body );
    wp_send_json_success();
}

/* ─────────────────────────────────────────────────────────────
   4. BIBLIOTHÈQUE D'ICÔNES SVG
   Source unique de vérité pour les pictogrammes du thème : on ne
   stocke que la géométrie (le viewBox est toujours 0 0 24 24), la
   couleur / taille / épaisseur de trait étant gérées par le CSS du
   conteneur. Évite la duplication du markup SVG dans les templates.
──────────────────────────────────────────────────────────────*/
function ljc_icon_path( $name ) {
    static $icons = array(
        'leaf'           => '<path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 2 12"/><path d="M12 2C8 6 7 10 8 14c1 3 3 5 4 8"/><path d="M12 2c4 4 5 8 4 12-1 3-3 5-4 8"/>',
        'leaves'         => '<path d="M2 22 16 8"/><path d="M3.47 12.53 5 11l1.53 1.53a3.5 3.5 0 0 1 0 4.94L5 19l-1.53-1.53a3.5 3.5 0 0 1 0-4.94z"/>',
        'eco'            => '<path d="M2 22 16 8"/><path d="M3.47 12.53 5 11l1.53 1.53a3.5 3.5 0 0 1 0 4.94L5 19l-1.53-1.53a3.5 3.5 0 0 1 0-4.94z"/><path d="M7.47 8.53 9 7l1.53 1.53a3.5 3.5 0 0 1 0 4.94L9 15l-1.53-1.53a3.5 3.5 0 0 1 0-4.94z"/><path d="M11.47 4.53 13 3l1.53 1.53a3.5 3.5 0 0 1 0 4.94L13 11l-1.53-1.53a3.5 3.5 0 0 1 0-4.94z"/><path d="M20 2H22v2a4 4 0 0 1-4 4h-2V6a4 4 0 0 1 4-4z"/>',
        'sprout'         => '<path d="M12 22V12"/><path d="M12 12C12 7 17 4 17 4S14 9 12 12"/><path d="M12 12C12 7 7 4 7 4S10 9 12 12"/><line x1="5" y1="22" x2="19" y2="22"/>',
        'grid'           => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>',
        'message'        => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
        'file-text'      => '<path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/>',
        'clock'          => '<circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/>',
        'arrow-right'    => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'calendar-check' => '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9,16 11,18 15,14"/>',
        'image'          => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21,15 16,10 5,21"/>',
        'star'           => '<polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>',
        'shield'         => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
        'shield-check'   => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9,12 11,14 15,10"/>',
        'euro'           => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
        'map-pin'        => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
        'check'          => '<polyline points="20,6 9,17 4,12"/>',
        'users'          => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'phone'          => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2H6.6a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.08 6.08l.95-.95a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 17z"/>',
        'mail'           => '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>',
        'quote'          => '<path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/>',
    );
    return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

/**
 * Renvoie le markup d'une icône SVG du thème.
 *
 * @param string $name  Clé de l'icône (voir ljc_icon_path()).
 * @param string $class Classe CSS optionnelle ajoutée au <svg>.
 * @return string
 */
function ljc_icon( $name, $class = '' ) {
    $path = ljc_icon_path( $name );
    if ( '' === $path ) {
        return '';
    }
    $class_attr = $class ? ' class="' . esc_attr( $class ) . '"' : '';
    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"' . $class_attr . '>' . $path . '</svg>';
}

/* ─────────────────────────────────────────────────────────────
   5. ACF LOCAL FIELD GROUPS
──────────────────────────────────────────────────────────────*/
if ( function_exists( 'acf_add_local_field_group' ) ) :

/* ── Groupe 1 : Hero ── */
acf_add_local_field_group( array(
    'key'      => 'group_hero',
    'title'    => 'Section Hero',
    'fields'   => array(
        array(
            'key'   => 'field_hero_bg_image',
            'name'  => 'hero_bg_image',
            'label' => 'Image de fond du hero',
            'type'  => 'image',
        ),
        array(
            'key'           => 'field_hero_eyebrow',
            'name'          => 'hero_eyebrow',
            'label'         => 'Texte au-dessus du titre',
            'type'          => 'text',
            'default_value' => "Créateur d'espaces vivants",
        ),
        array(
            'key'           => 'field_hero_title',
            'name'          => 'hero_title',
            'label'         => 'Titre ligne 1',
            'type'          => 'text',
            'default_value' => 'Votre jardin,',
        ),
        array(
            'key'           => 'field_hero_title_em',
            'name'          => 'hero_title_em',
            'label'         => 'Titre ligne 2 (italique)',
            'type'          => 'text',
            'default_value' => 'ma passion',
        ),
        array(
            'key'           => 'field_hero_description',
            'name'          => 'hero_description',
            'label'         => 'Description',
            'type'          => 'textarea',
            'default_value' => "Conception, aménagement et entretien de jardins sur mesure. Je donne vie à vos espaces extérieurs avec harmonie et savoir-faire.",
        ),
    ),
    'location' => array( array( array(
        'param'    => 'page_type',
        'operator' => '==',
        'value'    => 'front_page',
    ) ) ),
) );

/* ── Groupe 2 : À propos ── */
acf_add_local_field_group( array(
    'key'      => 'group_about',
    'title'    => 'Section À propos',
    'fields'   => array(
        array(
            'key'   => 'field_about_image',
            'name'  => 'about_image',
            'label' => 'Photo principale',
            'type'  => 'image',
        ),
        array(
            'key'           => 'field_about_title',
            'name'          => 'about_title',
            'label'         => 'Titre',
            'type'          => 'text',
            'default_value' => 'Passionné par la nature depuis toujours',
        ),
        array(
            'key'           => 'field_about_description',
            'name'          => 'about_description',
            'label'         => 'Description',
            'type'          => 'textarea',
            'default_value' => "Jardinier paysagiste indépendant, j'accompagne mes clients dans la création, l'aménagement et l'entretien de leurs jardins et espaces verts.",
        ),
        array(
            'key'           => 'field_about_experience_number',
            'name'          => 'about_experience_number',
            'label'         => "Nombre d'années",
            'type'          => 'text',
            'default_value' => '15+',
        ),
        array(
            'key'           => 'field_about_experience_text',
            'name'          => 'about_experience_text',
            'label'         => 'Texte expérience',
            'type'          => 'text',
            'default_value' => 'ans d\'expérience à votre service',
        ),
    ),
    'location' => array( array( array(
        'param'    => 'page_type',
        'operator' => '==',
        'value'    => 'front_page',
    ) ) ),
) );

/* ── Groupe 3 : Services / Prestations ── */
$services_fields = array();
for ( $n = 1; $n <= 3; $n++ ) {
    $services_fields[] = array(
        'key'   => "field_service_{$n}_image",
        'name'  => "service_{$n}_image",
        'label' => "Image prestation {$n}",
        'type'  => 'image',
    );
    $services_fields[] = array(
        'key'   => "field_service_{$n}_title",
        'name'  => "service_{$n}_title",
        'label' => "Titre prestation {$n}",
        'type'  => 'text',
    );
    $services_fields[] = array(
        'key'   => "field_service_{$n}_description",
        'name'  => "service_{$n}_description",
        'label' => "Description prestation {$n}",
        'type'  => 'textarea',
    );
    $services_fields[] = array(
        'key'   => "field_service_{$n}_price",
        'name'  => "service_{$n}_price",
        'label' => "Prix indicatif ex: 80 € / m²",
        'type'  => 'text',
    );
}
acf_add_local_field_group( array(
    'key'      => 'group_services',
    'title'    => 'Section Prestations',
    'fields'   => $services_fields,
    'location' => array( array( array(
        'param'    => 'page_type',
        'operator' => '==',
        'value'    => 'front_page',
    ) ) ),
) );

/* ── Groupe 4 : Réalisations / Portfolio ── */
$portfolio_fields = array(
    array(
        'key'   => 'field_portfolio_featured_image',
        'name'  => 'portfolio_featured_image',
        'label' => 'Grande image (featured)',
        'type'  => 'image',
    ),
    array(
        'key'           => 'field_portfolio_featured_title',
        'name'          => 'portfolio_featured_title',
        'label'         => 'Titre projet principal',
        'type'          => 'text',
        'default_value' => 'Aménagement de jardin contemporain',
    ),
    array(
        'key'           => 'field_portfolio_featured_location',
        'name'          => 'portfolio_featured_location',
        'label'         => 'Ville',
        'type'          => 'text',
        'default_value' => 'Lyon (69)',
    ),
);
for ( $n = 1; $n <= 4; $n++ ) {
    $portfolio_fields[] = array(
        'key'   => "field_portfolio_card_{$n}_image",
        'name'  => "portfolio_card_{$n}_image",
        'label' => "Image carte {$n}",
        'type'  => 'image',
    );
    $portfolio_fields[] = array(
        'key'   => "field_portfolio_card_{$n}_title",
        'name'  => "portfolio_card_{$n}_title",
        'label' => "Titre carte {$n}",
        'type'  => 'text',
    );
    $portfolio_fields[] = array(
        'key'   => "field_portfolio_card_{$n}_location",
        'name'  => "portfolio_card_{$n}_location",
        'label' => "Localisation carte {$n}",
        'type'  => 'text',
    );
}
acf_add_local_field_group( array(
    'key'      => 'group_portfolio',
    'title'    => 'Section Réalisations',
    'fields'   => $portfolio_fields,
    'location' => array( array( array(
        'param'    => 'page_type',
        'operator' => '==',
        'value'    => 'front_page',
    ) ) ),
) );

/* ── Groupe 5 : Témoignages ── */
$temo_fields = array();
for ( $n = 1; $n <= 3; $n++ ) {
    $temo_fields[] = array(
        'key'   => "field_temo_{$n}_text",
        'name'  => "temo_{$n}_text",
        'label' => 'Texte témoignage',
        'type'  => 'textarea',
    );
    $temo_fields[] = array(
        'key'   => "field_temo_{$n}_author",
        'name'  => "temo_{$n}_author",
        'label' => "Nom de l'auteur",
        'type'  => 'text',
    );
    $temo_fields[] = array(
        'key'   => "field_temo_{$n}_location",
        'name'  => "temo_{$n}_location",
        'label' => 'Ville / contexte',
        'type'  => 'text',
    );
    $temo_fields[] = array(
        'key'   => "field_temo_{$n}_initials",
        'name'  => "temo_{$n}_initials",
        'label' => 'Initiales avatar (ex: SM)',
        'type'  => 'text',
    );
}
acf_add_local_field_group( array(
    'key'      => 'group_temoignages',
    'title'    => 'Section Témoignages',
    'fields'   => $temo_fields,
    'location' => array( array( array(
        'param'    => 'page_type',
        'operator' => '==',
        'value'    => 'front_page',
    ) ) ),
) );

/* ── Groupe 6 : Formulaire Devis ── */
acf_add_local_field_group( array(
    'key'    => 'group_devis',
    'title'  => 'Section Devis',
    'fields' => array(
        array(
            'key'   => 'field_devis_form_image',
            'name'  => 'devis_form_image',
            'label' => 'Image en haut du formulaire',
            'type'  => 'image',
        ),
    ),
    'location' => array( array( array(
        'param'    => 'page_type',
        'operator' => '==',
        'value'    => 'front_page',
    ) ) ),
) );

/* ── Groupe 7 : Contact ── */
acf_add_local_field_group( array(
    'key'    => 'group_contact',
    'title'  => 'Section Contact',
    'fields' => array(
        array(
            'key'           => 'field_contact_phone',
            'name'          => 'contact_phone',
            'label'         => 'Téléphone',
            'type'          => 'text',
            'default_value' => '06 12 34 56 78',
        ),
        array(
            'key'           => 'field_contact_email',
            'name'          => 'contact_email',
            'label'         => 'Email',
            'type'          => 'email',
            'default_value' => 'contact@jardins-du-chene.fr',
        ),
        array(
            'key'           => 'field_contact_zone',
            'name'          => 'contact_zone',
            'label'         => "Zone d'intervention",
            'type'          => 'text',
            'default_value' => 'Lyon et alentours (40 km)',
        ),
        array(
            'key'           => 'field_contact_hours',
            'name'          => 'contact_hours',
            'label'         => 'Horaires',
            'type'          => 'text',
            'default_value' => 'Lun – Sam, 8h – 18h',
        ),
    ),
    'location' => array( array( array(
        'param'    => 'page_type',
        'operator' => '==',
        'value'    => 'front_page',
    ) ) ),
) );

/* ── Mentions légales ── */
acf_add_local_field_group( array(
    'key'    => 'group_mentions_legales',
    'title'  => 'Contenu de la page',
    'fields' => array( array(
        'key'          => 'field_mentions_content',
        'name'         => 'legal_content',
        'label'        => 'Contenu',
        'type'         => 'wysiwyg',
        'toolbar'      => 'full',
        'media_upload' => 0,
    ) ),
    'location' => array( array( array(
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'page-mentions-legales.php',
    ) ) ),
) );

/* ── Politique de confidentialité ── */
acf_add_local_field_group( array(
    'key'    => 'group_politique_confidentialite',
    'title'  => 'Contenu de la page',
    'fields' => array( array(
        'key'          => 'field_politique_content',
        'name'         => 'legal_content',
        'label'        => 'Contenu',
        'type'         => 'wysiwyg',
        'toolbar'      => 'full',
        'media_upload' => 0,
    ) ),
    'location' => array( array( array(
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'page-politique-de-confidentialite.php',
    ) ) ),
) );

/* ── CGV ── */
acf_add_local_field_group( array(
    'key'    => 'group_cgv',
    'title'  => 'Contenu de la page',
    'fields' => array( array(
        'key'          => 'field_cgv_content',
        'name'         => 'legal_content',
        'label'        => 'Contenu',
        'type'         => 'wysiwyg',
        'toolbar'      => 'full',
        'media_upload' => 0,
    ) ),
    'location' => array( array( array(
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'page-cgv.php',
    ) ) ),
) );

/* ── Politique de cookies ── */
acf_add_local_field_group( array(
    'key'    => 'group_politique_cookies',
    'title'  => 'Contenu de la page',
    'fields' => array( array(
        'key'          => 'field_cookies_content',
        'name'         => 'legal_content',
        'label'        => 'Contenu',
        'type'         => 'wysiwyg',
        'toolbar'      => 'full',
        'media_upload' => 0,
    ) ),
    'location' => array( array( array(
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'page-politique-de-cookies.php',
    ) ) ),
) );

endif; // function_exists('acf_add_local_field_group')
