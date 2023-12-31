function getShippingCostOptions(city_id) {
    $.ajax({
        type: "POST",
        url: "/orders/shipping-cost",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            city_id: city_id,
        },
        success: function (response) {
            $("#shipping-cost-option").empty();
            $("#shipping-cost-option").append(
                "<option value>- Please Select -</option>"
            );

            $.each(response.results, function (key, result) {
                $("#shipping-cost-option").append(
                    '<option value="' +
                        result.service.replace(/\s/g, "") +
                        '">' +
                        result.service +
                        " | " +
                        result.cost +
                        " | " +
                        result.etd +
                        "</option>"
                );
            });
        },
    });
}

(function ($) {
    $("#province_id").on("change", function (e) {
        var province_id = e.target.value;

        $.get("/orders/cities?province_id=" + province_id, function (data) {
            $("#city_id").empty();
            $("#city_id").append("<option value>- Please Select -</option>");

            $.each(data.cities, function (city_id, city) {
                $("#city_id").append(
                    '<option value="' + city_id + '">' + city + "</option>"
                );
            });
        });
    });

    $("#shipping_province").on("change", function (e) {
        var province_id = e.target.value;

        $.get("/orders/cities?province_id=" + province_id, function (data) {
            $("#shipping_city").empty();
            $("#shipping_city").append(
                "<option value>- Please Select -</option>"
            );

            $.each(data.cities, function (city_id, city) {
                $("#shipping_city").append(
                    '<option value="' + city_id + '">' + city + "</option>"
                );
            });
        });
    });

    // ======= Show Shipping Cost Options =========
    if ($("#city_id").val()) {
        getShippingCostOptions($("#city-id").val());
    }

    $("#city_id").on("change", function (e) {
        var city_id = e.target.value;

        // !!!!!!!!!!!! form kedua
        if (!$("#ship-box").is(":checked")) {
            getShippingCostOptions(city_id);
        }
    });

    $("#shipping_city").on("change", function (e) {
        var city_id = e.target.value;
        getShippingCostOptions(city_id);
    });

    // ============ Set Shipping Cost ================
    $("#shipping-cost-option").on("change", function (e) {
        var shipping_service = e.target.value;
        var city_id = $("#city_id").val();

        // !!!!!!!!!!!! form kedua
        if ($("#ship-box").is(":checked")) {
            city_id = $("#shipping_city").val();
        }

        $.ajax({
            type: "POST",
            url: "/orders/set-shipping",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                city_id: city_id,
                shipping_service: shipping_service,
            },
            success: function (response) {
                $(".total-amount").html(response.data.total);
            },
        });
    });
})(jQuery);
