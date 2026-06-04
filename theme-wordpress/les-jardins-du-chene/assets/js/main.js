(function () {
  'use strict';

  const header = document.getElementById('header');
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 40);
    document.getElementById('scrollTop').classList.toggle('visible', window.scrollY > 400);
  }, { passive: true });

  const burger = document.getElementById('burger');
  const mobileMenu = document.getElementById('mobileMenu');
  burger.addEventListener('click', () => {
    mobileMenu.classList.toggle('open');
    burger.classList.toggle('open');
  });
  document.querySelectorAll('.mobile-link, .mobile-cta').forEach(link =>
    link.addEventListener('click', () => {
      mobileMenu.classList.remove('open');
      burger.classList.remove('open');
    })
  );

  document.getElementById('scrollTop').addEventListener('click', () =>
    window.scrollTo({ top: 0, behavior: 'smooth' })
  );

  const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); } });
  }, { threshold: 0.12 });
  document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

  const devisForm = document.getElementById('devisForm');
  if (devisForm) {
    devisForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const required = this.querySelectorAll('[required]');
      let valid = true;
      required.forEach(f => { if (!f.value.trim()) { f.style.borderColor = '#c0392b'; valid = false; } else { f.style.borderColor = ''; } });
      if (!valid) return;
      const formData = new FormData(this);
      formData.append('action', 'jardins_send_devis');
      formData.append('nonce', jardinsAjax.nonce);
      fetch(jardinsAjax.ajaxurl, { method: 'POST', body: formData })
        .then(() => {
          this.style.display = 'none';
          document.getElementById('devisSuccess').style.display = 'block';
        });
    });
  }

  const MONTHS_FR = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
  const DAYS_FR   = ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'];
  const today = new Date();
  today.setHours(0,0,0,0);
  let currentYear  = today.getFullYear();
  let currentMonth = today.getMonth();
  let selectedDate = null;
  let selectedSlot = null;
  const BOOKED = ['09:00','14:00'];

  function buildAvailableDays(year, month) {
    const available = new Set();
    const d = new Date(year, month, 1);
    while (d.getMonth() === month) {
      const dow = d.getDay();
      if (dow !== 0 && d >= today) available.add(d.getDate());
      d.setDate(d.getDate() + 1);
    }
    return available;
  }

  function renderCalendar(year, month) {
    document.getElementById('calTitle').textContent = MONTHS_FR[month] + ' ' + year;
    const grid = document.getElementById('calGrid');
    grid.innerHTML = '';
    DAYS_FR.forEach(d => {
      const el = document.createElement('div');
      el.className = 'cal-day-name'; el.textContent = d;
      grid.appendChild(el);
    });
    const firstDay = new Date(year, month, 1).getDay();
    const offset   = (firstDay === 0) ? 6 : firstDay - 1;
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const available = buildAvailableDays(year, month);
    for (let i = 0; i < offset; i++) {
      const el = document.createElement('div');
      el.className = 'cal-day cal-empty';
      grid.appendChild(el);
    }
    for (let day = 1; day <= daysInMonth; day++) {
      const el = document.createElement('div');
      el.className = 'cal-day';
      el.textContent = day;
      const d = new Date(year, month, day);
      d.setHours(0,0,0,0);
      if (d < today) {
        el.classList.add('cal-past');
      } else {
        if (d.getTime() === today.getTime()) el.classList.add('cal-today');
        if (available.has(day)) el.classList.add('cal-available');
        if (selectedDate && d.getFullYear() === selectedDate.getFullYear() && d.getMonth() === selectedDate.getMonth() && d.getDate() === selectedDate.getDate()) el.classList.add('cal-selected');
        if (available.has(day)) {
          el.addEventListener('click', () => {
            selectedDate = new Date(year, month, day);
            selectedSlot = null;
            renderCalendar(year, month);
            renderSlots();
          });
        }
      }
      grid.appendChild(el);
    }
  }

  const SLOTS = ['08:00','09:00','10:00','11:00','14:00','15:00','16:00','17:00'];
  function renderSlots() {
    const content = document.getElementById('slotsContent');
    const title   = document.getElementById('slotsTitle');
    const btn     = document.getElementById('rdvConfirmBtn');
    if (!selectedDate) {
      content.innerHTML = '<div class="rdv-no-date"><svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg><span>Sélectionnez une date<br>pour voir les créneaux disponibles.</span></div>';
      title.textContent = 'Créneaux disponibles';
      btn.classList.remove('visible');
      return;
    }
    const opts = { weekday:'long', day:'numeric', month:'long' };
    title.textContent = selectedDate.toLocaleDateString('fr-FR', opts);
    const dow = selectedDate.getDay();
    if (dow === 0) { content.innerHTML = '<p class="rdv-no-date">Fermé le dimanche</p>'; btn.classList.remove('visible'); return; }
    const list = document.createElement('div');
    list.className = 'rdv-slots-list';
    SLOTS.forEach(time => {
      const isBooked = BOOKED.includes(time) && selectedDate.getDate() % 3 === 0;
      const el = document.createElement('div');
      el.className = 'rdv-slot' + (isBooked ? ' slot-booked' : '');
      const isSelected = selectedSlot === time && !isBooked;
      if (isSelected) el.classList.add('slot-selected');
      el.innerHTML = `<span class="rdv-slot-time">${time}</span><span class="rdv-slot-status ${isBooked ? 'taken' : isSelected ? 'selected-tag' : 'free'}">${isBooked ? 'Réservé' : isSelected ? '✓ Sélectionné' : 'Disponible'}</span>`;
      if (!isBooked) { el.addEventListener('click', () => { selectedSlot = time; renderSlots(); btn.classList.add('visible'); }); }
      list.appendChild(el);
    });
    content.innerHTML = '';
    content.appendChild(list);
    if (!selectedSlot) btn.classList.remove('visible');
  }

  const calPrev = document.getElementById('calPrev');
  const calNext = document.getElementById('calNext');
  if (calPrev) {
    calPrev.addEventListener('click', () => { currentMonth--; if (currentMonth < 0) { currentMonth = 11; currentYear--; } renderCalendar(currentYear, currentMonth); });
    calNext.addEventListener('click', () => { currentMonth++; if (currentMonth > 11) { currentMonth = 0; currentYear++; } renderCalendar(currentYear, currentMonth); });
    renderCalendar(currentYear, currentMonth);
    renderSlots();
  }

  const modal      = document.getElementById('rdvModal');
  const modalClose = document.getElementById('rdvModalClose');
  const confirmBtn = document.getElementById('rdvConfirmBtn');
  const rdvInfo    = document.getElementById('rdvSelectedInfo');
  if (confirmBtn) {
    confirmBtn.addEventListener('click', () => {
      if (!selectedDate || !selectedSlot) return;
      const opts = { weekday:'long', day:'numeric', month:'long', year:'numeric' };
      rdvInfo.innerHTML = `<strong>Date :</strong> <span>${selectedDate.toLocaleDateString('fr-FR', opts)}</span><br><strong>Heure :</strong> <span>${selectedSlot}</span>`;
      modal.classList.add('open');
    });
    modalClose.addEventListener('click', () => modal.classList.remove('open'));
    modal.addEventListener('click', e => { if (e.target === modal) modal.classList.remove('open'); });
    document.getElementById('rdvForm').addEventListener('submit', function (e) {
      e.preventDefault();
      const required = this.querySelectorAll('[required]');
      let valid = true;
      required.forEach(f => { if (!f.value.trim()) { f.style.borderColor = '#c0392b'; valid = false; } else { f.style.borderColor = ''; } });
      if (!valid) return;
      this.style.display = 'none';
      document.getElementById('rdvSuccess').style.display = 'block';
      selectedSlot = null;
      renderSlots();
    });
  }

  const lightbox    = document.getElementById('lightbox');
  const lightboxImg = document.getElementById('lightboxImg');
  if (lightbox) {
    function openLightbox(src, alt) { lightboxImg.src = src; lightboxImg.alt = alt || ''; lightbox.classList.add('open'); document.body.style.overflow = 'hidden'; }
    function closeLightbox() { lightbox.classList.remove('open'); document.body.style.overflow = ''; }
    document.querySelectorAll('.real-featured > img, .real-small-card img').forEach(img => {
      img.style.cursor = 'zoom-in';
      img.addEventListener('click', () => openLightbox(img.src, img.alt));
    });
    document.getElementById('lightboxClose').addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', e => { if (e.target === lightbox) closeLightbox(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
  }

  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', e => {
      const target = document.querySelector(link.getAttribute('href'));
      if (!target) return;
      e.preventDefault();
      const offset = 72;
      const top = target.getBoundingClientRect().top + window.scrollY - offset;
      window.scrollTo({ top, behavior: 'smooth' });
    });
  });
})();
