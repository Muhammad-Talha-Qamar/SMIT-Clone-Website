(function () {
  var observer = null;
  var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function ensureObserver() {
    if (observer || reduced) return observer;
    observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-inview');
        observer.unobserve(entry.target);
      });
    }, {
      threshold: 0.14,
      rootMargin: '0px 0px -10% 0px'
    });
    return observer;
  }

  function prepareStagger(root) {
    var scope = root || document;
    var groups = scope.querySelectorAll ? scope.querySelectorAll('[data-reveal-stagger]') : [];
    if (scope !== document && scope.hasAttribute && scope.hasAttribute('data-reveal-stagger')) {
      groups = [scope];
    }
    groups.forEach(function (group) {
      var type = group.getAttribute('data-reveal-stagger') || 'up';
      var kids = Array.prototype.filter.call(group.children, function (child) {
        return child.nodeType === 1;
      });
      kids.forEach(function (child, index) {
        if (!child.hasAttribute('data-reveal')) {
          child.setAttribute('data-reveal', type);
        }
        if (!child.style.getPropertyValue('--reveal-delay')) {
          child.style.setProperty('--reveal-delay', (index * 80) + 'ms');
        }
      });
    });
  }

  function observeReveal(root) {
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

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () { observeReveal(document); });
  } else {
    observeReveal(document);
  }
})();
