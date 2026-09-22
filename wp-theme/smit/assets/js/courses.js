/**
 * Course catalog: filter cards by category.
 */
(function () {
  var grid = document.getElementById('catalog-grid');
  var empty = document.getElementById('catalog-empty');
  var tabs = document.querySelectorAll('.catalog-tab');
  if (!grid || !tabs.length) return;

  function filterDom(filter) {
    var cards = grid.querySelectorAll('.catalog-card[data-category]');
    var visible = 0;
    cards.forEach(function (card) {
      var match = filter === 'all' || card.getAttribute('data-category') === filter;
      card.style.display = match ? '' : 'none';
      if (match) {
        visible += 1;
        card.classList.remove('is-inview');
      }
    });
    if (empty) {
      empty.hidden = visible > 0;
      empty.style.display = visible > 0 ? 'none' : 'block';
    }
    if (window.observeReveal) window.observeReveal(grid);
  }

  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  var labels = {
    open: 'Admissions Open',
    development: 'Development',
    designing: 'Designing',
    networking: 'Networking',
    entrepreneurship: 'Entrepreneurship',
    vocational: 'Vocational Training'
  };

  function renderFromPayload(filter) {
    var items = (window.smitCourses && Array.isArray(smitCourses.items)) ? smitCourses.items : [];
    if (!items.length) {
      filterDom(filter);
      return;
    }
    var enrollUrl = (window.smitData && smitData.enrollUrl) || '#';
    var filtered = items.filter(function (course) {
      return filter === 'all' || course.category === filter;
    });
    if (empty) {
      empty.hidden = filtered.length > 0;
      empty.style.display = filtered.length ? 'none' : 'block';
    }
    grid.innerHTML = filtered.map(function (course, index) {
      return (
        '<article class="catalog-card" data-category="' + escapeHtml(course.category || '') + '" data-reveal="' + (index % 2 ? 'right' : 'left') + '">' +
          '<div class="catalog-card__media">' +
            '<img src="' + escapeHtml(course.image || '') + '" alt="' + escapeHtml(course.title || '') + '">' +
            (course.category === 'open' ? '<span class="catalog-card__badge">Admission Open</span>' : '') +
          '</div>' +
          '<div class="catalog-card__body">' +
            '<p class="catalog-card__category">' + escapeHtml(labels[course.category] || course.category || '') + '</p>' +
            '<h3 class="catalog-card__title">' + escapeHtml(course.title || '') + '</h3>' +
            '<p class="catalog-card__desc">' + escapeHtml(course.desc || '') + '</p>' +
            '<div class="catalog-card__footer">' +
              '<a class="enroll-btn" href="' + escapeHtml(course.enroll || enrollUrl) + '">Enroll Now</a>' +
              '<span class="catalog-card__duration">Duration<strong>' + escapeHtml(course.duration || '') + '</strong></span>' +
            '</div>' +
          '</div>' +
        '</article>'
      );
    }).join('');
    if (window.observeReveal) window.observeReveal(grid);
  }

  // Prefer server-rendered DOM filtering; fall back to smitCourses payload if grid empty.
  var useDom = grid.querySelectorAll('.catalog-card[data-category]').length > 0;

  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      tabs.forEach(function (item) {
        item.classList.remove('is-active');
        item.setAttribute('aria-selected', 'false');
      });
      tab.classList.add('is-active');
      tab.setAttribute('aria-selected', 'true');
      var filter = tab.getAttribute('data-filter') || 'all';
      if (useDom) {
        filterDom(filter);
      } else {
        renderFromPayload(filter);
      }
    });
  });

  if (useDom) {
    filterDom('all');
  } else {
    renderFromPayload('all');
  }
})();
