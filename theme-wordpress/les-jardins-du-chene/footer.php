<!-- FOOTER -->
<footer id="footer">
  <div class="container">
    <div class="footer-top">
      <!-- Colonne Brand -->
      <div class="footer-brand">
        <div class="footer-brand-name">LES JARDINS <span>DU CHÊNE</span></div>
        <div class="footer-brand-sub">Jardinier &bull; Paysagiste</div>
        <p class="footer-brand-desc">Jardinier paysagiste indépendant, je crée des espaces vivants en harmonie avec la nature. J'interviens dans tout le bassin lyonnais depuis plus de 15 ans.</p>
      </div>

      <!-- Colonne Prestations -->
      <div class="footer-col">
        <div class="footer-col-title">Prestations</div>
        <ul>
          <li><a href="#prestations">Création de jardins</a></li>
          <li><a href="#prestations">Entretien d'espaces verts</a></li>
          <li><a href="#prestations">Aménagement éco-responsable</a></li>
          <li><a href="#prestations">Potagers biologiques</a></li>
          <li><a href="#prestations">Taille &amp; élagage</a></li>
        </ul>
      </div>

      <!-- Colonne Informations -->
      <div class="footer-col">
        <div class="footer-col-title">Informations</div>
        <ul>
          <li><a href="#about">À propos</a></li>
          <li><a href="#realisations">Mes réalisations</a></li>
          <li><a href="#temoignages">Témoignages</a></li>
          <li><a href="#devis">Devis gratuit</a></li>
          <li><a href="#rdv">Prendre RDV</a></li>
        </ul>
      </div>

      <!-- Colonne Contact -->
      <div class="footer-col">
        <div class="footer-col-title">Contact</div>
        <ul>
          <li><a href="tel:0612345678">06 12 34 56 78</a></li>
          <li><a href="mailto:contact@jardins-du-chene.fr">contact@jardins-du-chene.fr</a></li>
          <li><a href="#contact">Lyon et alentours</a></li>
          <li><a href="#rdv">Lun &ndash; Sam, 8h &ndash; 18h</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo date( 'Y' ); ?> Les Jardins du Chêne &mdash; Lucas Morel, Jardinier Paysagiste</p>
      <div class="footer-bottom-links">
        <a href="#">Mentions légales</a>
        <a href="#">Politique de confidentialité</a>
        <a href="#">CGV</a>
      </div>
    </div>
  </div>
</footer>

<!-- SCROLL TOP -->
<button id="scrollTop" aria-label="Retour en haut">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="m18 15-6-6-6 6"/>
  </svg>
</button>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Image en plein écran">
  <button class="lightbox-close" id="lightboxClose" aria-label="Fermer">&#x2715;</button>
  <img class="lightbox-img" id="lightboxImg" src="" alt="" />
</div>

<!-- MODAL RDV -->
<div class="rdv-form-modal" id="rdvModal">
  <div class="rdv-modal-inner">
    <button class="rdv-modal-close" id="rdvModalClose">&#x2715;</button>
    <div class="rdv-modal-header">
      <h3>Confirmer votre rendez-vous</h3>
      <p>Complétez vos coordonnées pour finaliser la réservation.</p>
    </div>
    <div class="rdv-selected-info" id="rdvSelectedInfo"></div>
    <form id="rdvForm" novalidate>
      <div class="form-row">
        <div class="form-group">
          <label for="r-prenom">Prénom *</label>
          <input type="text" id="r-prenom" name="r-prenom" required placeholder="Jean" />
        </div>
        <div class="form-group">
          <label for="r-nom">Nom *</label>
          <input type="text" id="r-nom" name="r-nom" required placeholder="Dupont" />
        </div>
      </div>
      <div class="form-group">
        <label for="r-email">Email *</label>
        <input type="email" id="r-email" name="r-email" required placeholder="jean@email.fr" />
      </div>
      <div class="form-group">
        <label for="r-tel">Téléphone *</label>
        <input type="tel" id="r-tel" name="r-tel" required placeholder="06 00 00 00 00" />
      </div>
      <div class="form-group">
        <label for="r-type">Type de rendez-vous</label>
        <select id="r-type" name="r-type">
          <option>Visite sur place (création)</option>
          <option>Consultation entretien</option>
          <option>Rendez-vous de suivi</option>
          <option>Autre</option>
        </select>
      </div>
      <button type="submit" class="form-submit" style="margin-top:8px">Confirmer le rendez-vous</button>
    </form>
    <div class="form-success" id="rdvSuccess" style="display:none">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20,6 9,17 4,12"/>
      </svg>
      <p><strong>Rendez-vous confirmé !</strong><br>Vous recevrez une confirmation par email. À bientôt !</p>
    </div>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
