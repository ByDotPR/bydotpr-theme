(function () {
  function initSlider(track) {
    var cardWidth = function () {
      var card = track.querySelector(".b-services__card");
      if (!card) return 0;
      var style = getComputedStyle(track);
      var gap = parseFloat(style.gap) || 0;
      return card.getBoundingClientRect().width + gap;
    };

    var atStart = function () {
      return track.scrollLeft <= 1;
    };
    var atEnd = function () {
      // tolerancia de 2px por redondeo de subpíxeles
      return track.scrollLeft + track.clientWidth >= track.scrollWidth - 2;
    };

    document
      .querySelectorAll('[data-slider-prev="' + track.id + '"]')
      .forEach(function (btn) {
        btn.addEventListener("click", function () {
          if (atStart()) {
            track.scrollTo({ left: track.scrollWidth, behavior: "smooth" }); // loop al final
          } else {
            track.scrollBy({ left: -cardWidth(), behavior: "smooth" });
          }
        });
      });

    document
      .querySelectorAll('[data-slider-next="' + track.id + '"]')
      .forEach(function (btn) {
        btn.addEventListener("click", function () {
          if (atEnd()) {
            track.scrollTo({ left: 0, behavior: "smooth" }); // loop al inicio
          } else {
            track.scrollBy({ left: cardWidth(), behavior: "smooth" });
          }
        });
      });
  }

  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[data-services-track]").forEach(initSlider);
  });
})();
