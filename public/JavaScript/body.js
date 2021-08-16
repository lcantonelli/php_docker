$(document).ready(function () {
    $('.close, #cancelar').on("click", function () {
        $(".modal").hide();
        $("#form").find("input").removeClass("error");
    });
    $("body").delegate("#adicionar", "click", function () {
        $('.modal').hide();
        $("input").val('');
        $("#divForm").find("button").attr("id", "cadastrar").text("CADASTRAR");
        $("#divForm").show();
    });
    $("body").delegate("#cadastrar", "click", function (e) {
        e.preventDefault();
        var formulario = $("#form").find("input:visible").serializeArray();
        var status = true;
        $("#form").find("input:visible").each(function () {
            $(this).removeClass("error");
            if ($(this).val().length == 0) {
                $(this).addClass("error");
                status = false;
            }
        });
        if (status == false) {
            return;
        }
        $.ajax({
            url: "/teste/cadastrar",
            type: "POST",
            data: formulario,
            dataType: "JSON",
            success: function (data) {
                if (data["id"]) {
                    var html = "<tr id='tr_" + data["id"] + "' data-id='" + data["id"] + "'>";
                    $(formulario).each(function (i, field) {
                        html += "<td>" + field.value + "</td>";
                    });
                    html += "<td style='text-align: center'>";
                    html += "<i class='fa fa-pencil-square-o fa-lg editar' data-id='" + data["id"] + "' title='Editar' style='margin-right: 7px;cursor: pointer'></i>";
                    html += "<i class='fa fa-trash fa-lg deletar' data-id='" + data["id"] + "' title='Remover' style='cursor: pointer'></i>";
                    html += "</td>";
                    html += "</tr>";
                    $("tbody").append(html);
                }
            }
        });
        $(".modal").hide();
    });
    $("body").delegate(".editar", "click", function () {
        $('.modal').hide();
        $("#divForm").find("button").attr("id", "editar").text("EDITAR");
        $("input").val('');
        $("#divForm").show();
        var id = $(this).data('id');
        $("#form").find("#id").val(id);
        var inputs = $("#form").find("input:visible");
        var pessoa = $('#tr_' + id).find("td");
        for (var i = 0; i < (pessoa.length - 1); i++) {
            $(inputs[i]).val($(pessoa[i]).text());
        }
    });
    $("body").delegate("#editar", "click", function (e) {
        e.preventDefault();
        var status = true;
        $("#form").find("input:visible").each(function () {
            $(this).removeClass("error");
            if ($(this).val().length == 0) {
                $(this).addClass("error");
                status = false;
            }
        });
        if (status == false) {
            return;
        }
        var formulario = $("#form").serializeArray();
        $.ajax({
            url: "/teste/atualizar",
            type: "PUT",
            data: formulario,
            dataType: "JSON",
            success: function (data) {
                if (data["id"]) {
                    var inputs = $("#form").find("input:visible");
                    var pessoa = $('#tr_' + data["id"]).find("td");
                    for (var i = 0; i < (pessoa.length - 1); i++) {
                        $(pessoa[i]).text($(inputs[i]).val());
                    }
                }
                $(".modal").hide();
            }
        });

    });
    $("body").delegate(".deletar", "click", function () {
        $('.modal').hide();
        $("#deletar").show();
        $("#deletar").find('input').val($(this).data('id'));
    });

    $('body').delegate("#sim", "click", function (e) {
        e.preventDefault();
        $.ajax({
            url: "/teste/deletar",
            type: "DELETE",
            data: {id: $("#idDeletar").val()},
            dataType: "JSON",
            success: function (data) {
                if (data["id"]) {
                    $("#tr_" + data["id"]).remove();
                }
            }
        });
        $(".modal").hide();
    });
});