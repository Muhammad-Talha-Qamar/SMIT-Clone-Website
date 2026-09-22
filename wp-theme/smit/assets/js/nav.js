/**
 * SMIT nav behavior (header markup comes from PHP).
 * Uses window.smitData when available (WordPress), with static fallbacks.
 */
(function () {
  var data = window.smitData || {};
  var coursesUrl = data.coursesUrl || './courses.html';

  var toggle = document.getElementById('nav-toggle');
  var overlay = document.getElementById('nav-overlay');
  var coursesNav = document.getElementById('courses-nav');
  var coursesTrigger = document.getElementById('courses-trigger');
  var coursesMega = document.getElementById('courses-mega');
  var categoriesEl = document.getElementById('courses-categories');
  var topCoursesEl = document.getElementById('courses-top');
  var headerEl = document.getElementById('site-header');
  var mqDesktop = window.matchMedia('(min-width: 981px)');

  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function getMegaCategories() {
    if (data.megaMenu && data.megaMenu.length) {
      return data.megaMenu;
    }
    return [];
  }

  function getTopCourses() {
    if (data.topCourses && data.topCourses.length) {
      return data.topCourses.map(function (c) {
        return {
          title: c.title,
          duration: c.duration || '',
          url: c.url || coursesUrl
        };
      });
    }
    return [];
  }

  function renderCoursesMenu() {
    if (!categoriesEl || !topCoursesEl) return;

    var courseCategories = getMegaCategories();
    var topCourses = getTopCourses();

    categoriesEl.innerHTML = courseCategories.map(function (category) {
      var links = (category.courses || []).map(function (course) {
        return (
          '<a href="' + escapeHtml(course.url || coursesUrl) + '" class="courses-mega__link" title="' + escapeHtml(course.title) + '">' +
            '<span class="courses-mega__link-text">' + escapeHtml(course.title) + '</span>' +
          '</a>'
        );
      }).join('');

      return (
        '<div>' +
          '<h4 class="courses-mega__col-title" title="' + escapeHtml(category.name) + '">' +
            escapeHtml(category.name) +
          '</h4>' +
          links +
        '</div>'
      );
    }).join('');

    topCoursesEl.innerHTML = topCourses.map(function (course) {
      return (
        '<a href="' + escapeHtml(course.url) + '" class="courses-mega__card" title="' + escapeHtml(course.title) + '">' +
          '<span class="courses-mega__icon" aria-hidden="true"></span>' +
          '<span class="courses-mega__card-copy">' +
            '<span class="courses-mega__card-title">' + escapeHtml(course.title) + '</span>' +
            '<span class="courses-mega__card-meta">' + escapeHtml(course.duration) + '</span>' +
          '</span>' +
        '</a>'
      );
    }).join('');
  }

  function isDesktop() {
    return mqDesktop.matches;
  }

  function positionMegaMenu() {
    if (!headerEl || !coursesMega || !isDesktop()) return;
    var rect = headerEl.getBoundingClientRect();
    document.documentElement.style.setProperty('--courses-mega-top', Math.round(rect.bottom) + 'px');
    document.documentElement.style.setProperty('--courses-mega-gap', Math.round(rect.height + 10) + 'px');
  }

  function setMobileOpen(open) {
    if (!headerEl || !toggle) return;
    headerEl.classList.toggle('is-open', open);
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    if (overlay) overlay.hidden = !open;
    document.body.classList.toggle('nav-lock', open && !isDesktop());
    if (!open) closeCourses();
  }

  function setCoursesOpen(open) {
    if (!coursesNav || !coursesTrigger || !coursesMega) return;
    coursesNav.classList.toggle('is-open', open);
    coursesMega.classList.toggle('is-open', open);
    coursesTrigger.setAttribute('aria-expanded', open ? 'true' : 'false');

    if (open && isDesktop()) {
      if (coursesMega.parentNode !== document.body) {
        document.body.appendChild(coursesMega);
      }
      positionMegaMenu();
    } else if (coursesNav && coursesMega.parentNode !== coursesNav) {
      coursesNav.appendChild(coursesMega);
    }
  }

  function closeCourses() {
    clearTimeout(closeTimer);
    closeTimer = null;
    setCoursesOpen(false);
  }

  function isOverCourses(target) {
    if (!target || !target.closest) return false;
    return Boolean(target.closest('#courses-nav, #courses-mega, #courses-trigger'));
  }

  var closeTimer = null;
  function scheduleClose() {
    if (closeTimer) return;
    closeTimer = setTimeout(closeCourses, 120);
  }
  function cancelClose() {
    clearTimeout(closeTimer);
    closeTimer = null;
    if (coursesMega && !coursesMega.classList.contains('is-open')) setCoursesOpen(true);
  }

  function onScroll() {
    if (!headerEl) return;
    headerEl.classList.toggle('is-scrolled', window.scrollY > 8);
    positionMegaMenu();
  }

  if (window.smitTheme) window.smitTheme.apply(window.smitTheme.get());

  renderCoursesMenu();
  positionMegaMenu();
  onScroll();
  window.addEventListener('resize', positionMegaMenu);
  window.addEventListener('scroll', onScroll, { passive: true });

  if (toggle) {
    toggle.addEventListener('click', function () {
      setMobileOpen(!(headerEl && headerEl.classList.contains('is-open')));
    });
  }

  if (overlay) {
    overlay.addEventListener('click', function () {
      setMobileOpen(false);
    });
  }

  if (coursesTrigger && coursesNav) {
    coursesTrigger.addEventListener('click', function (event) {
      if (isDesktop()) {
        event.preventDefault();
        return;
      }
      event.preventDefault();
      event.stopPropagation();
      setCoursesOpen(!coursesNav.classList.contains('is-open'));
    });

    coursesTrigger.addEventListener('keydown', function (event) {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        setCoursesOpen(!coursesNav.classList.contains('is-open'));
      } else if (event.key === 'Escape') {
        closeCourses();
        coursesTrigger.focus();
      } else if (event.key === 'ArrowDown') {
        event.preventDefault();
        setCoursesOpen(true);
        var firstLink = coursesMega && coursesMega.querySelector('a');
        if (firstLink) firstLink.focus();
      }
    });

    coursesNav.addEventListener('mouseenter', function () {
      if (isDesktop()) cancelClose();
    });

    coursesNav.addEventListener('mouseleave', function (event) {
      if (!isDesktop()) return;
      if (isOverCourses(event.relatedTarget)) return;
      scheduleClose();
    });
  }

  if (coursesMega) {
    coursesMega.addEventListener('mouseenter', function () {
      if (isDesktop()) {
        clearTimeout(closeTimer);
        closeTimer = null;
      }
    });
    coursesMega.addEventListener('mouseleave', function (event) {
      if (!isDesktop()) return;
      if (isOverCourses(event.relatedTarget)) return;
      scheduleClose();
    });
    coursesMega.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        closeCourses();
        if (coursesTrigger) coursesTrigger.focus();
      }
    });
  }

  document.addEventListener('mousemove', function (event) {
    if (!isDesktop() || !coursesMega || !coursesMega.classList.contains('is-open')) return;
    if (isOverCourses(event.target)) {
      clearTimeout(closeTimer);
      closeTimer = null;
      return;
    }
    scheduleClose();
  });

  document.addEventListener('click', function (event) {
    if (!coursesNav || !coursesMega) return;
    if (isOverCourses(event.target)) return;
    closeCourses();
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      closeCourses();
      setMobileOpen(false);
    }
  });

  if (typeof mqDesktop.addEventListener === 'function') {
    mqDesktop.addEventListener('change', function () {
      closeCourses();
      setMobileOpen(false);
      positionMegaMenu();
    });
  } else if (typeof mqDesktop.addListener === 'function') {
    mqDesktop.addListener(function () {
      closeCourses();
      setMobileOpen(false);
      positionMegaMenu();
    });
  }
})();
