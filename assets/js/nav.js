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
            '<a href="./check-results.html#result" class="site-nav__link' + isActive('check-results.html') + '">Check Results</a>' +
          '</nav>' +
          '<a href="./check-results.html" class="site-cta">Enroll Now</a>' +
        '</div>' +
        '<button type="button" id="theme-toggle" class="theme-toggle" aria-label="Switch to dark mode" aria-pressed="false" title="Dark mode">' +
          '<span class="theme-toggle__option theme-toggle__option--light" aria-hidden="true">' +
            '<svg class="theme-toggle__icon" viewBox="0 0 24 24" fill="none">' +
              '<circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2"/>' +
              '<path d="M12 3v2M12 19v2M5.6 5.6l1.4 1.4M17 17l1.4 1.4M3 12h2M19 12h2M5.6 18.4l1.4-1.4M17 7l1.4-1.4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>' +
            '</svg>' +
          '</span>' +
          '<span class="theme-toggle__option theme-toggle__option--dark" aria-hidden="true">' +
            '<svg class="theme-toggle__icon" viewBox="0 0 24 24" fill="currentColor">' +
              '<path d="M21 14.5A8.5 8.5 0 1 1 9.5 3a7 7 0 0 0 11.5 11.5z"/>' +
            '</svg>' +
          '</span>' +
        '</button>' +
        '<button id="nav-toggle" class="nav-burger" type="button" aria-label="Toggle menu" aria-expanded="false" aria-controls="nav-menu">' +
          '<span></span><span></span><span></span>' +
        '</button>' +
      '</div>';
    if (window.smitTheme) window.smitTheme.apply(window.smitTheme.get());
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
    if (coursesMega && !coursesMega.classList.contains('is-open')) setCoursesOpen(true);
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

  if (!document.querySelector('footer.site-footer')) {
    var footer = document.createElement('footer');
    footer.className = 'site-footer mt-8 w-full bg-gradient-to-br from-[#1a1a1a] via-[#2d2d2d] to-[#1a1a1a] font-montserrat text-gray-300';
    footer.innerHTML =
      '<div class="relative mx-auto max-w-6xl overflow-hidden px-6 py-8 md:px-10">' +
        '<div class="mb-4 flex items-center justify-start">' +
          '<div class="relative w-[92px]"><img src="./assets/images/logos/transparent_logo.png" alt="Saylani Mass IT Training" class="block h-auto w-full object-contain" width="80" height="40"></div>' +
          '<div class="ml-4 mt-2 w-[152px]"><a href="https://saylaniwelfare.com/" target="_blank" rel="noopener noreferrer"><img src="./assets/images/logos/saylani_logo.webp" alt="Saylani Logo" class="block h-auto w-full object-contain" width="120" height="40"></a></div>' +
        '</div>' +
        '<div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-12 lg:gap-12">' +
          '<div class="md:col-span-2 lg:col-span-4">' +
            '<p class="mb-6 text-left text-sm leading-relaxed text-gray-400">Empowering Pakistan\'s youth with world-class IT education and training programs to build a brighter digital future.</p>' +
            '<div class="mb-6 flex flex-col gap-3">' +
              '<div class="flex items-start gap-3 text-sm text-gray-400"><i class="fa-solid fa-location-dot mt-0.5 text-brand-primary" aria-hidden="true"></i><span>A-25, Bahadurabad Chowrangi, Karachi, Pakistan</span></div>' +
              '<div class="flex items-start gap-3 text-sm text-gray-400"><i class="fa-solid fa-phone mt-0.5 text-brand-green" aria-hidden="true"></i><a href="tel:+9221111729526" class="text-gray-400 hover:text-white">+92 21 111 729 526</a></div>' +
              '<div class="flex items-start gap-3 text-sm text-gray-400"><i class="fa-solid fa-envelope mt-0.5 text-brand-primary" aria-hidden="true"></i><a href="mailto:saylanimass@gmail.com" class="text-gray-400 hover:text-white">saylanimass@gmail.com</a></div>' +
            '</div>' +
          '</div>' +
          '<div class="lg:col-span-2"><h3 class="mb-6 text-lg font-bold text-white">Quick Links</h3><ul class="flex flex-col gap-3">' +
            '<li><a href="./index.html" class="text-sm text-gray-400 hover:text-white">Home</a></li>' +
            '<li><a href="./about.html" class="text-sm text-gray-400 hover:text-white">About</a></li>' +
            '<li><a href="./check-results.html" class="text-sm text-gray-400 hover:text-white">Enroll Now</a></li>' +
            '<li><a href="./check-results.html#result" class="text-sm text-gray-400 hover:text-white">Check Results</a></li>' +
          '</ul></div>' +
          '<div class="lg:col-span-3"><h3 class="mb-6 text-lg font-bold text-white">Resources</h3><ul class="flex flex-col gap-3">' +
            '<li><a href="./courses.html" class="text-sm text-gray-400 hover:text-white">Courses</a></li>' +
            '<li><a href="./campuses.html" class="text-sm text-gray-400 hover:text-white">Campuses</a></li>' +
            '<li><a href="./check-results.html#idcard" class="text-sm text-gray-400 hover:text-white">Download ID Card</a></li>' +
            '<li><a href="./check-results.html#entrytest" class="text-sm text-gray-400 hover:text-white">Entry Test Status</a></li>' +
          '</ul></div>' +
        '</div>' +
      '</div>' +
      '<div class="border-t border-gray-700"><div class="mx-auto max-w-6xl px-6 py-6 text-center text-sm text-gray-400">© 2013 - 2026 <span class="font-semibold text-white">Saylani Mass IT Training</span>. All rights reserved.<span class="mt-1 block">Made by M. Talha Qamar</span></div></div>';
    document.body.appendChild(footer);
  }

  if (!document.querySelector('[aria-label="Chat with us"]') && !document.getElementById('contact')) {
    var chat = document.createElement('a');
    chat.href = 'mailto:saylanimass@gmail.com';
    chat.className = 'fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-[#2f80ed] text-white shadow-lg transition hover:scale-105';
    chat.setAttribute('aria-label', 'Chat with us');
    chat.innerHTML = '<i class="fa-regular fa-comment-dots text-2xl" aria-hidden="true"></i>';
    document.body.appendChild(chat);
  }
})();
