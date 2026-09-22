(function () {
  var observer = null;
  var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var SKIP = 'header, #site-header, .site-header, nav, .review-modal, script, style, noscript';
  var UNIT = 'article, .course-card, .catalog-card, .campus-card, .review-card, .map-wrapper, .map-stage';
  var AUTO = [
    'h1', 'h2', 'h3', 'h4', 'h5',
    'p',
    'img',
    'li',
    'label',
    'input',
    'select',
    'textarea',
    'button',
    '.smit-pill-badge',
    '.smit-hero-heading',
    '.smit-hero-subheading',
    '.course-tab',
    '.catalog-tab',
    '.city-chip',
    '.tab-btn',
    '.stat-pill',
    '.map-hint',
    '.city-select-wrapper',
    '.campus-stats-bar',
    'form > div',
    '.catalog-intro > *',
    '.smit-hero-container > *',
    '.catalog-cta > *',
    '#inter > *',
    '.why-orbit__center > *',
    '.site-footer__col',
    '.site-footer__brand',
    '.site-footer__logos',
    '.site-footer__bottom-inner',
    'footer.site-footer .grid > div',
    'section > a',
    '.catalog-cta a'
  ].join(',');

  function ensureObserver() {
    if (observer || reduced) return observer;
    observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-inview');
        observer.unobserve(entry.target);
      });
    }, {
      threshold: 0.08,
      rootMargin: '0px 0px -48px 0px'
    });
    return observer;
  }

  function shouldSkip(el) {
    if (!el || el.nodeType !== 1) return true;
    if (el.closest(SKIP)) return true;
    if (el.matches('.glow-top-right, .glow-bottom-left, [hidden]')) return true;
    if (el.closest('[hidden]')) return true;
    return false;
  }

  function pickDirection(el, index) {
    if (el.matches('img, .map-wrapper, .map-stage, .campus-card, article, .catalog-card, .course-card')) {
      return index % 2 === 0 ? 'left' : 'right';
    }
    if (el.matches('h1, h2, .smit-hero-heading')) {
      return index % 2 === 0 ? 'left' : 'right';
    }
    if (el.matches('p, h3, h4, .smit-hero-subheading, li, label')) {
      return index % 2 === 0 ? 'right' : 'left';
    }
    if (el.matches('button, a, .course-tab, .city-chip, .tab-btn, .catalog-tab, .smit-pill-badge')) {
      return 'up';
    }
    return index % 3 === 0 ? 'left' : (index % 3 === 1 ? 'right' : 'up');
  }

  function explodeWrappers(root) {
    var scope = root && root.querySelectorAll ? root : document;
    var nodes = scope.querySelectorAll ? scope.querySelectorAll('[data-reveal]') : [];
    if (scope !== document && scope.hasAttribute && scope.hasAttribute('data-reveal')) {
      nodes = [scope].concat(Array.prototype.slice.call(nodes));
    }
    Array.prototype.forEach.call(nodes, function (el) {
      if (shouldSkip(el)) return;
      if (el.matches(UNIT)) return;
      var kids = Array.prototype.filter.call(el.children, function (child) {
        return child.nodeType === 1 && !child.matches('script, style, br, svg');
      });
      if (kids.length < 2) return;
      el.removeAttribute('data-reveal');
    });
  }

  function autoMark(root) {
    var scope = root && root.querySelectorAll ? root : document;
    var index = 0;

    function mark(el) {
      if (shouldSkip(el)) return;
      if (el.hasAttribute('data-reveal')) return;
      if (el.closest('[data-reveal]')) return;
      el.setAttribute('data-reveal', pickDirection(el, index++));
    }

    if (scope.querySelectorAll) {
      scope.querySelectorAll(AUTO).forEach(mark);
      scope.querySelectorAll(UNIT).forEach(mark);
    }
    if (scope !== document && scope.nodeType === 1) {
      if (scope.matches && (scope.matches(AUTO) || scope.matches(UNIT))) mark(scope);
    }
  }

  function prepareStagger(root) {
    var scope = root || document;
    var groups = scope.querySelectorAll ? scope.querySelectorAll('[data-reveal-stagger]') : [];
    if (scope !== document && scope.hasAttribute && scope.hasAttribute('data-reveal-stagger')) {
      groups = [scope];
    }
    Array.prototype.forEach.call(groups, function (group) {
      var type = group.getAttribute('data-reveal-stagger') || 'up';
      var kids = Array.prototype.filter.call(group.children, function (child) {
        return child.nodeType === 1;
      });
      kids.forEach(function (child, childIndex) {
        if (!child.hasAttribute('data-reveal')) {
          child.setAttribute('data-reveal', type);
        }
        if (!child.style.getPropertyValue('--reveal-delay')) {
          child.style.setProperty('--reveal-delay', (childIndex * 70) + 'ms');
        }
      });
    });
  }

  function observeReveal(root) {
    prepareStagger(root);
    explodeWrappers(root);
    autoMark(root);
    prepareStagger(root);
    if (reduced) {
      var all = (root && root.querySelectorAll ? root.querySelectorAll('[data-reveal]') : document.querySelectorAll('[data-reveal]'));
      if (root && root.hasAttribute && root.hasAttribute('data-reveal')) {
        root.classList.add('is-inview');
      }
      all.forEach(function (el) { el.classList.add('is-inview'); });
      return;
    }
    var obs = ensureObserver();
    var nodes = [];
    if (root && root.nodeType === 1) {
      if (root.hasAttribute('data-reveal')) nodes.push(root);
      if (root.querySelectorAll) {
        root.querySelectorAll('[data-reveal]').forEach(function (el) { nodes.push(el); });
      }
    } else {
      document.querySelectorAll('[data-reveal]').forEach(function (el) { nodes.push(el); });
    }
    nodes.forEach(function (el) {
      if (el.classList.contains('is-inview')) return;
      obs.observe(el);
    });
  }

  window.observeReveal = observeReveal;

  function start() {
    observeReveal(document);
    if (window.MutationObserver && document.body) {
      var timer = null;
      var mo = new MutationObserver(function () {
        clearTimeout(timer);
        timer = setTimeout(function () { observeReveal(document); }, 80);
      });
      mo.observe(document.body, { childList: true, subtree: true });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', start);
  } else {
    start();
  }
})();
