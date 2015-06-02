$(document).ready(function () {

    $('.barredroite > .highlighted ').click(function () {

        if ($("#nodetails").is(":visible")) {
            $("#nodetails").css("display", "none");
        }

        $.ajax({
            url: "getWord.php",
            data: {
                id: $(this).data("id"),
                mode: "noun"
            },
            type: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {
                $("#details-noun").hide();
                $("#details-verb").hide();
                $("#loading_icon").show();
            },
            success: function (data) {
                $("#loading_icon").hide();
                if (data) {
                    $("#nom").text(data.nom);
                    $("#descriptionN").text(data.description);
                    $("#type").text(data.parents);
                }
                $("#details-noun").show();
            }
        });

    });


    $('.barredroite > .highlighted-verb ').click(function () {

        if ($("#nodetails").is(":visible")) {
            $("#nodetails").css("display", "none");
        }

        if ($(this).data("suggest")) {
            prepared_data = {
                id: $(this).data("id"),
                mode: "verb",
                suggest: $(this).data("suggest")
            };
        }
        else {
            prepared_data = {
                id: $(this).data("id"),
                mode: "verb"
            };
        }

        $.ajax({
            url: "getWord.php",
            data: prepared_data,
            type: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {
                $("#details-noun").hide();
                $("#details-verb").hide();
                $("#loading_icon").show();
            },
            success: function (data) {
                $("#loading_icon").hide();
                if (data) {
                    $("#verbe").text(data.verbe);
                    $("#descriptionV").text(data.description);
                    $("#validation").text(data.validite);
                }
                if (data.suggestion) {
                    $("#suggestion").text("Suggestion : "+data.suggestion);
                }
                $("#details-verb").show();
            }
        });

    });
});