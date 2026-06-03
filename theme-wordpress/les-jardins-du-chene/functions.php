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
   4. ACF LOCAL FIELD GROUPS
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

endif; // function_exists('acf_add_local_field_group')
