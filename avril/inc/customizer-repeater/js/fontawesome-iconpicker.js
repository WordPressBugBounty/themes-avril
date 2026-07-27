(function ($) {
    "use strict";

    wp.avrilcustomizerRepeater = {

        init: function () {

            $(document).on(
                "click", ".iconpicker-items > i", function (e) {

                    e.preventDefault();

                    var oldIcon = $(this).data("value") || "";
                    var newClass = $(this).attr("class") || "";

                    var classInput = $(this)
                    .closest(".iconpicker-popover")
                    .prev(".icp-container")
                    .find(".icp");

                    if (!classInput.length) {
                        return false;
                    }

                    /*
                    * Store FA4 key in Customizer.
                    * Example:
                    * fa-search
                    */
                    classInput.val(oldIcon);
                    classInput.attr("value", oldIcon);

                    /*
                    * Preview latest FA7 icon.
                    * Example:
                    * fa-solid fa-magnifying-glass
                    */
                    classInput
                    .next(".input-group-addon")
                    .html("<i class=\"" + newClass + "\"></i>");

                    classInput.trigger("change");

                    var repeater = classInput.closest(".customizer-repeater-social-repeater");

                    if (typeof avril_customizer_repeater_refresh_social_icons === "function") {
                        avril_customizer_repeater_refresh_social_icons(repeater);
                    }

                    $(this)
                    .closest(".iconpicker-popover")
                    .removeClass("iconpicker-visible");

                    return false;
                }
            );

        },

        search: function ($searchField) {

            var searchTerm = $.trim($searchField.val()).toLowerCase();

            var items = $searchField
                .closest(".iconpicker-popover")
                .find(".iconpicker-items > i");

            if (!searchTerm.length) {
                items.show();
                return;
            }

            items.each(
                function () {

                    var title = ($(this).attr("title") || "").toLowerCase();
                    var value = ($(this).data("value") || "").toLowerCase();

                    if (title.indexOf(searchTerm) !== -1 
                        || value.indexOf(searchTerm) !== -1
                    ) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }

                }
            );

        },

        iconPickerToggle: function ($input) {

            $(".iconpicker-popover")
                .not($input.parent().next())
                .removeClass("iconpicker-visible");

            $input
                .parent()
                .next(".iconpicker-popover")
                .toggleClass("iconpicker-visible");

        }

    };

    $(
        function () {

            wp.avrilcustomizerRepeater.init();

            $(document).on(
                "keyup", ".iconpicker-search", function () {
                    wp.avrilcustomizerRepeater.search($(this));
                }
            );

            $(document).on(
                "click", ".icp-auto", function (e) {

                    e.preventDefault();

                    wp.avrilcustomizerRepeater.iconPickerToggle($(this));

                }
            );

            $(document).on(
                "mouseup", function (e) {

                    $(".iconpicker-popover").each(
                        function () {

                            if (!$(this).is(e.target) 
                                && $(this).has(e.target).length === 0
                            ) {
                                $(this).removeClass("iconpicker-visible");
                            }

                        }
                    );

                }
            );

        }
    );

})(jQuery);