(function ($) {
    $(document).ready(function () {
        console.log("ready");

        const permission_add_btn = $("#permission-add-btn");
        const permission_list = $("#permissions");

        let remove_btn = `<div class="col-sm-4 mb-2" id="remove-btn-container"><a id="permission-remove-btn" href="#" class="btn btn-danger permission-remove-btn"><i class="bi bi-dash-circle mr-2"></i>Remove</a></div>`;

        let remvoe_btn_show = permission_list.clone()[0].innerHTML + remove_btn;
        // console.dir(remvoe_btn_show);

        permission_add_btn.on("click", (e) => {
            e.preventDefault();
            console.log("click");

            // console.log(permission_add_btn.parent().parent().children().find('#permissions.row > .col-sm-8').last())
            permission_add_btn
                .parent()
                .parent()
                .children()
                .find("#permissions.row > .col-sm-8")
                .first()
                .after(remvoe_btn_show);

            let permission_remove_btn = $("#permission-remove-btn");
            // console.log(permission_remove_btn)

            permission_remove_btn.on("click", (e) => {
                e.preventDefault();
                // console.log(this);
                let prevElem = permission_remove_btn.parent().prev();
                let currElem = permission_remove_btn.parent();

                prevElem.remove();
                currElem.remove();
            });
        });

        console.log(permission_remove_btn);
    });
})(jQuery);
