/**
 * Student portal: tab switching + demo forms.
 */
(function () {
  var tabData = {
    registration: {
      badge: 'Registration Form',
      title: 'Registration Form',
      subtitle: 'Start your journey towards excellence. Fill out the form to apply for our courses'
    },
    idcard: {
      badge: 'Download ID Card',
      title: 'Download Your ID Card',
      subtitle: 'Enter your CNIC to download your student ID Card'
    },
    entrytest: {
      badge: 'Entry Test Status',
      title: 'Check Your Entry Test Status',
      subtitle: 'Enter your roll number to view your entry test / induction status'
    },
    result: {
      badge: 'Result',
      title: 'Check Your Result',
      subtitle: 'Enter your roll number to view your examination results'
    }
  };

  function tabFromHash() {
    var key = (window.location.hash || '').replace('#', '').toLowerCase();
    if (key === 'idcard' || key === 'entrytest' || key === 'result' || key === 'registration') return key;
    return 'registration';
  }

  function switchTab(tabKey, updateHash) {
    if (!tabData[tabKey]) tabKey = 'registration';

    document.querySelectorAll('.tab-content').forEach(function (el) {
      el.classList.add('hidden');
    });
    document.querySelectorAll('.tab-btn').forEach(function (btn) {
      var isActive = btn.getAttribute('data-tab') === tabKey;
      btn.classList.toggle('active', isActive);
      btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
    });

    var selectedContent = document.getElementById('tab-' + tabKey);
    if (selectedContent) {
      selectedContent.classList.remove('hidden');
      selectedContent.querySelectorAll('[data-reveal]').forEach(function (el) {
        el.classList.remove('is-inview');
      });
      if (window.observeReveal) window.observeReveal(selectedContent);
    }

    var data = tabData[tabKey];
    if (data) {
      var badge = document.getElementById('hero-badge-text');
      var title = document.getElementById('hero-title');
      var subtitle = document.getElementById('hero-subtitle');
      if (badge) badge.textContent = data.badge;
      if (title) title.textContent = data.title;
      if (subtitle) subtitle.textContent = data.subtitle;
    }

    if (updateHash !== false && window.location.hash.replace('#', '') !== tabKey) {
      history.replaceState(null, '', '#' + tabKey);
    }
  }

  document.querySelectorAll('.tab-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      switchTab(btn.getAttribute('data-tab'));
    });
  });
  window.addEventListener('hashchange', function () {
    switchTab(tabFromHash(), false);
  });
  switchTab(tabFromHash(), false);

  var registrationForm = document.getElementById('registration-form');
  if (registrationForm) {
    registrationForm.addEventListener('submit', function (event) {
      event.preventDefault();
      var message = document.getElementById('form-message');
      if (!message) return;
      if (!registrationForm.checkValidity()) {
        message.textContent = 'Please fill in all required fields correctly.';
        message.className = 'rounded-lg px-4 py-3 text-sm font-semibold bg-red-50 text-red-700';
        registrationForm.reportValidity();
        return;
      }
      message.textContent = 'Registration submitted successfully. Our team will contact you soon.';
      message.className = 'rounded-lg px-4 py-3 text-sm font-semibold bg-green-50 text-green-700';
      registrationForm.reset();
    });
  }

  document.querySelectorAll('.portal-search').forEach(function (button) {
    button.addEventListener('click', function () {
      var panel = button.closest('.tab-content');
      if (!panel) return;
      var input = panel.querySelector('input');
      var feedback = panel.querySelector('.portal-feedback');
      if (!feedback) return;
      if (!input || !input.value.trim()) {
        feedback.textContent = 'Please enter the required information first.';
        feedback.className = 'portal-feedback mb-4 text-sm font-semibold text-red-600';
        return;
      }
      feedback.textContent = 'No matching record was found for this demo form.';
      feedback.className = 'portal-feedback mb-4 text-sm font-semibold text-slate-600';
    });
  });
})();
