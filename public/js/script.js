(function ($) {
    $(document).ready(function () {
        console.log("ready");

        const permission_add_btn = $("#permission-add-btn");
        const permission_lists = $("#hidden-permission-list");
        const first_permission = $("#permissions > div:nth-child(1)");
        let remove_btns = $("div.remove-btn-container");

        remove_btns.each(function () {
            $(this).find('a').click(function (e) {
                e.preventDefault();

                let _prevElem = $(this).parent().prev();
                let _currElem = $(this).parent();
                // console.log(_prevElem, _currElem);

                _prevElem.remove();
                _currElem.remove();
            });
        });

        permission_add_btn.on("click", function (e) {
            e.preventDefault();

            let _clone = permission_lists.clone();

            first_permission.after(_clone.html());

            let _remove_btns = $("div.remove-btn-container");

            _remove_btns.each(function (i, v) {
                // console.log(v);
                $(this).find('a').click(function (e) {
                    e.preventDefault();

                    let _prevElem = $(this).parent().prev();
                    let _currElem = $(this).parent();
                    // console.log(_prevElem, _currElem);

                    _prevElem.remove();
                    _currElem.remove();
                });
            });
        });
    });
})(jQuery);
