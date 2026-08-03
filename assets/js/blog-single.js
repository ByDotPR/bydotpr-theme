(function () {
  var bar = document.querySelector("[data-reading-progress]");
  var article = document.querySelector(".blog-single");
  if (!bar || !article) return;

  function update() {
    var rect = article.getBoundingClientRect();
    var articleHeight = rect.height - window.innerHeight;
    var scrolled = -rect.top;
    var pct =
      articleHeight > 0
        ? Math.min(100, Math.max(0, (scrolled / articleHeight) * 100))
        : 0;
    bar.style.width = pct + "%";
  }

  document.addEventListener("scroll", update, { passive: true });
  window.addEventListener("resize", update);
  update();
})();
