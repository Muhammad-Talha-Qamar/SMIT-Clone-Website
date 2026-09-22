/**
 * Home page: course scroller, review modal, city chips.
 */
(function () {
  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  var courses = (window.smitData && Array.isArray(smitData.courses)) ? smitData.courses : [];
  var enrollFallback = (window.smitData && smitData.enrollUrl) ? smitData.enrollUrl : '#';

  var scroller = document.getElementById('course-scroller');

  function renderCatalog(key) {
    if (!scroller) return;
    var items = courses.filter(function (course) {
      return course.category === key;
    });
    if (!items.length && key === 'open') {
      items = courses.slice(0, 8);
    }
    scroller.innerHTML = items.map(function (course, index) {
      var url = course.enroll || course.url || enrollFallback;
      return (
        '<article class="course-card w-[280px] shrink-0 overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm" data-reveal="' + (index % 2 ? 'right' : 'left') + '">' +
          '<div class="relative h-[150px] overflow-hidden bg-slate-100">' +
            '<img src="' + escapeHtml(course.image || '') + '" alt="' + escapeHtml(course.title || '') + '" class="h-full w-full object-cover">' +
            (key === 'open' ? '<span class="absolute right-3 top-3 rounded-full bg-gradient-to-r from-[#2f80ed] to-[#6da800] px-2 py-0.5 text-[10px] font-bold uppercase text-white">Admission Open</span>' : '') +
          '</div>' +
          '<div class="p-4">' +
            '<h3 class="text-sm font-bold text-slate-800">' + escapeHtml(course.title || '') + '</h3>' +
            '<p class="mt-1 line-clamp-2 text-xs text-slate-500">' + escapeHtml(course.desc || '') + '</p>' +
            '<div class="mt-4 flex items-center justify-between">' +
              '<a href="' + escapeHtml(url) + '" class="rounded-full bg-[#2f80ed] px-4 py-1.5 text-xs font-semibold text-white">Enroll Now</a>' +
              '<span class="text-[11px] text-slate-400">Duration<br><strong class="text-slate-700">' + escapeHtml(course.duration || '') + '</strong></span>' +
            '</div>' +
          '</div>' +
        '</article>'
      );
    }).join('');
    if (window.observeReveal) window.observeReveal(scroller);
  }

  renderCatalog('open');

  document.querySelectorAll('.course-tab').forEach(function (tab) {
    tab.addEventListener('click', function () {
      document.querySelectorAll('.course-tab').forEach(function (t) {
        t.classList.remove('is-active', 'bg-[#2f80ed]', 'text-white');
        t.classList.add('text-slate-500');
      });
      tab.classList.add('is-active', 'bg-[#2f80ed]', 'text-white');
      tab.classList.remove('text-slate-500');
      renderCatalog(tab.getAttribute('data-course-tab'));
    });
  });

  function bindScroller(el, prevId, nextId, amount) {
    var node = document.getElementById(el);
    var prev = document.getElementById(prevId);
    var next = document.getElementById(nextId);
    if (!node) return;
    if (prev) prev.addEventListener('click', function () { node.scrollBy({ left: -amount, behavior: 'smooth' }); });
    if (next) next.addEventListener('click', function () { node.scrollBy({ left: amount, behavior: 'smooth' }); });
  }
  bindScroller('course-scroller', 'course-prev', 'course-next', 300);
  bindScroller('review-scroller', 'review-prev', 'review-next', 230);

  var reviewModal = document.getElementById('review-modal');
  var reviewFrame = document.getElementById('review-frame');
  var reviewName = document.getElementById('review-modal-name');
  var reviewRole = document.getElementById('review-modal-role');

  function closeReviewModal() {
    if (!reviewModal || !reviewFrame) return;
    reviewModal.classList.remove('is-open');
    reviewModal.hidden = true;
    reviewFrame.src = '';
    document.body.style.overflow = '';
  }

  function openReviewModal(card) {
    var videoId = card.getAttribute('data-video');
    if (!videoId || !reviewModal || !reviewFrame) return;
    if (reviewName) reviewName.textContent = card.getAttribute('data-name') || 'Student review';
    if (reviewRole) reviewRole.textContent = card.getAttribute('data-role') || '';
    reviewFrame.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0';
    reviewModal.hidden = false;
    reviewModal.classList.add('is-open');
    document.body.style.overflow = 'hidden';
  }

  document.querySelectorAll('.review-card[data-video]').forEach(function (card) {
    card.setAttribute('aria-label', 'Play video: ' + (card.getAttribute('data-name') || 'student review'));
    card.addEventListener('click', function () {
      openReviewModal(card);
    });
  });

  var reviewClose = document.getElementById('review-modal-close');
  if (reviewClose) reviewClose.addEventListener('click', closeReviewModal);
  if (reviewModal) {
    reviewModal.addEventListener('click', function (event) {
      if (event.target === reviewModal) closeReviewModal();
    });
  }
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') closeReviewModal();
  });

  document.querySelectorAll('.city-chip').forEach(function (chip) {
    chip.addEventListener('click', function () {
      document.querySelectorAll('.city-chip').forEach(function (c) { c.classList.remove('is-active'); });
      chip.classList.add('is-active');
    });
  });
})();
