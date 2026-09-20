(function () {
  var currentPage = (window.location.pathname.split('/').pop() || 'index.html').toLowerCase();
  if (!currentPage) currentPage = 'index.html';

  function isActive(pageFile) {
    return currentPage === pageFile ? ' is-active' : '';
  }

  var header = document.getElementById('site-header');
  if (header) {
    header.className = 'site-header';
    header.innerHTML =
      '<div class="site-header__inner">' +
        '<a href="./index.html" class="site-logo" aria-label="SMIT home">' +
          '<img src="./assets/images/logos/transparent_logo.png" alt="SMIT Logo" width="140" height="42">' +
        '</a>' +
        '<div class="site-header__overlay" id="nav-overlay" hidden></div>' +
        '<div id="nav-menu" class="site-header__panel">' +
          '<nav class="site-nav" aria-label="Primary">' +
            '<a href="./index.html" class="site-nav__link' + isActive('index.html') + '">Home</a>' +
            '<a href="./about.html" class="site-nav__link' + isActive('about.html') + '">About</a>' +
            '<div class="courses-nav" id="courses-nav">' +
              '<button type="button" id="courses-trigger" class="site-nav__trigger' + isActive('courses.html') + '" aria-expanded="false" aria-controls="courses-mega" aria-haspopup="true">' +
                '<span>Courses</span>' +
                '<svg class="site-nav__chevron" viewBox="0 0 12 12" aria-hidden="true"><path d="M2.5 4.25L6 7.75L9.5 4.25" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>' +
              '</button>' +
              '<div id="courses-mega" class="courses-mega" role="region" aria-label="Courses menu">' +
                '<div class="courses-mega-bridge" aria-hidden="true"></div>' +
                '<div class="courses-mega__panel">' +
                  '<div class="courses-mega__categories" id="courses-categories"></div>' +
                  '<div class="courses-mega__top">' +
                    '<h3 class="courses-mega__top-title">Top Courses</h3>' +
                    '<div class="courses-mega__cards" id="courses-top"></div>' +
                  '</div>' +
                  '<div class="courses-mega__footer">' +
                    '<a href="./courses.html" class="courses-mega__all">See All Courses <span aria-hidden="true">→</span></a>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>' +
            '<a href="./campuses.html" class="site-nav__link' + isActive('campuses.html') + '">Campuses</a>' +
            '<a href="./check-results.html" class="site-nav__link' + isActive('check-results.html') + '">Check Result</a>' +
          '</nav>' +
          '<a href="./check-results.html" class="site-cta">Enroll Now</a>' +
        '</div>' +
        '<button id="nav-toggle" class="nav-burger" type="button" aria-label="Toggle menu" aria-expanded="false" aria-controls="nav-menu">' +
          '<span></span><span></span><span></span>' +
        '</button>' +
      '</div>';
  }

  var toggle = document.getElementById('nav-toggle');
  var overlay = document.getElementById('nav-overlay');
  var coursesNav = document.getElementById('courses-nav');
  var coursesTrigger = document.getElementById('courses-trigger');
  var coursesMega = document.getElementById('courses-mega');
  var categoriesEl = document.getElementById('courses-categories');
  var topCoursesEl = document.getElementById('courses-top');
  var headerEl = document.getElementById('site-header');
  var mqDesktop = window.matchMedia('(min-width: 981px)');

  var courseCategories = [
    {
      name: 'Development',
      courses: [
        { title: 'Bootcamp (Artificial Intelligence)', url: './courses.html' },
        { title: 'Bootcamp (Blockchain Development)', url: './courses.html' },
        { title: 'Odoo Functional Consultant', url: './courses.html' },
        { title: 'Devops Engineer', url: './courses.html' }
      ]
    },
    {
      name: 'Designing',
      courses: [
        { title: 'Video Content Creation', url: './courses.html' },
        { title: 'Video Animation', url: './courses.html' },
        { title: 'UI UX Design With AI', url: './courses.html' },
        { title: 'Autocad', url: './courses.html' }
      ]
    },
    {
      name: 'Networking',
      courses: [
        { title: 'SOC Analyst CyberOps', url: './courses.html' },
        { title: 'Networking Essentials', url: './courses.html' },
        { title: 'Cybersecurity Essentials', url: './courses.html' },
        { title: 'CyberOps Associate', url: './courses.html' }
      ]
    },
    {
      name: 'Entrepreneurship',
      courses: [
        { title: 'Professional Communication', url: './courses.html' },
        { title: 'English Language & Communication', url: './courses.html' },
        { title: 'AI & Game Creators', url: './courses.html' },
        { title: 'Little Geniuses: Coding for Kids', url: './courses.html' }
      ]
    },
    {
      name: 'Vocational',
      courses: [
        { title: 'Health, Safety and Environment', url: './courses.html' },
        { title: 'Fire Alarm System Installation', url: './courses.html' },
        { title: 'Domestic Electrician', url: './courses.html' },
        { title: 'Plumber Technician', url: './courses.html' }
      ]
    }
  ];

  var topCourses = [
    { title: 'Bootcamp (Blockchain Development)', duration: '4 months', url: './courses.html' },
    { title: 'Odoo Functional Consultant', duration: '10 months', url: './courses.html' },
    { title: 'Video Content Creation', duration: '4 months', url: './courses.html' },
    { title: 'Professional Communication', duration: '3 months', url: './courses.html' }
  ];

  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function renderCoursesMenu() {
    if (!categoriesEl || !topCoursesEl) return;

    categoriesEl.innerHTML = courseCategories.map(function (category) {
      var links = category.courses.map(function (course) {
        return (
          '<a href="' + escapeHtml(course.url) + '" class="courses-mega__link" title="' + escapeHtml(course.title) + '">' +
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
    if (!coursesMega.classList.contains('is-open')) setCoursesOpen(true);
  }

  function onScroll() {
    if (!headerEl) return;
    headerEl.classList.toggle('is-scrolled', window.scrollY > 8);
    positionMegaMenu();
  }

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
