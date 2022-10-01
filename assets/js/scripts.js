(function ($) {
  // Document is Ready!
  $(function () {
    $(".iwct-filters-button").click(function () {
      const button = $(this);
      const buttonIcon = button.children("i");
      const isButtonUp = buttonIcon.hasClass("fa-chevron-up");
      const filtersWrapper = button.parent().next();

      const buttonClassToggle = (removeClass, addClass) =>
        buttonIcon.removeClass(removeClass).addClass(addClass);

      isButtonUp
        ? buttonClassToggle("fa-chevron-up", "fa-chevron-down")
        : buttonClassToggle("fa-chevron-down", "fa-chevron-up");

      filtersWrapper.slideToggle();
    });
  });
})(jQuery);
