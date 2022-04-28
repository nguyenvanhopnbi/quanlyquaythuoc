(function ($) {
    $.fn.simpleMoneyFormat = function () {
        this.each(function (index, el) {
            var elType = null; // input or other
            var value = null;
            // get value
            if ($(el).is("input") || $(el).is("textarea")) {
                value = $(el).val().replace(/\./g, "");
                elType = "input";
            } else {
                value = $(el).text().replace(/\./g, "");
                elType = "other";
            }
            // if value changes
            $(el).on("paste keyup", function () {
                value = $(el).val().replace(/\./g, "");
                formatElement(el, elType, value); // format element
            });
            formatElement(el, elType, value); // format element
        });
        function formatElement(el, elType, value) {
            var result = accounting.formatMoney(value, "", 0, ".");
            if (elType == "input") {
                $(el).val(result);
            } else {
                $(el).empty().text(result);
            }
        }
    };
})(jQuery);
