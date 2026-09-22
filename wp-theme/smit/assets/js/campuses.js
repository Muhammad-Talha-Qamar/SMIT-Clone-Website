/**
 * Campus finder: city select + map marker filtering.
 */
(function () {
  var citySelect = document.getElementById('city-select');
  var campusCards = document.querySelectorAll('.campus-card[data-city]');
  var mapMarkers = document.querySelectorAll('.map-marker[data-city]');

  function filterCampuses(city) {
    campusCards.forEach(function (card) {
      var match = !city || card.dataset.city === city;
      var wasHidden = card.classList.contains('is-hidden');
      card.classList.toggle('is-hidden', !match);
      if (match && wasHidden) card.classList.remove('is-inview');
    });
    if (window.observeReveal) {
      var grid = document.querySelector('.campus-grid');
      if (grid) window.observeReveal(grid);
    }
    mapMarkers.forEach(function (marker) {
      marker.classList.toggle('is-active', Boolean(city) && marker.dataset.city === city);
    });
  }

  if (citySelect) {
    citySelect.addEventListener('change', function () {
      filterCampuses(citySelect.value);
    });
  }

  mapMarkers.forEach(function (marker) {
    marker.addEventListener('click', function () {
      var city = marker.dataset.city;
      if (citySelect) citySelect.value = city;
      filterCampuses(city);
      var grid = document.querySelector('.campus-grid');
      if (grid) grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });

  campusCards.forEach(function (card) {
    card.setAttribute('role', 'button');
    card.tabIndex = 0;
    var name = card.querySelector('.campus-city');
    card.setAttribute('aria-label', 'View ' + (name ? name.textContent.trim() : card.dataset.city) + ' campuses');

    function selectCity(event) {
      if (event && event.target && event.target.closest && event.target.closest('a')) {
        return;
      }
      var city = card.dataset.city;
      if (citySelect) citySelect.value = city;
      filterCampuses(city);
    }

    card.addEventListener('click', selectCity);
    card.addEventListener('keydown', function (event) {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        selectCity(event);
      }
    });
  });

  var params = new URLSearchParams(window.location.search);
  var cityFromUrl = params.get('city');
  if (cityFromUrl && citySelect) {
    citySelect.value = cityFromUrl;
    filterCampuses(cityFromUrl);
  }
})();
