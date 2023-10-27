@extends('layout.app')
@section('content')
    <style>
        .edit-controls {
            display: none;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <label for="megyek">Megyék:</label>
            <select id="megyek" name="megyek" class="form-control">
                <option value="">Válasszon</option>
                @foreach($megyek as $megye)
                    <option value="{{$megye->me_id}}">{{$megye->me_nev}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row rejtett">
        <div class="col-6">
            <label for="ujvaros">Város:</label>
            <input class="form-control" type="text" id="ujvaros" name="ujvaros" max="30" maxlength="30" value=""
                   placeholder="Város neve">
            <button class="btn btn-primary" id="felvesz" name="felvesz">felvesz</button>
        </div>
        <div class="col-6">
            <br><br>
            <ul class="list-group" id="varos-lista"></ul>
        </div>
    </div>

    <div class="row rejtett mt-3">
        <div class="col-12">
            <input type="hidden" id="varos-nev-h"/>
            <input type="text" class="edit-controls form-control" id="varos-nev"/>

            <div class="edit-controls">
                <button class="btn btn-warning" id="szerkeszt">módosít</button>
                <button class="btn btn-danger" id="torol">törlés</button>
                <button class="btn btn-secondary" id="megse">mégsem</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hiba!</h5>
                </div>
                <div class="modal-body">
                    <p id="hiba"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".rejtett").hide();

            $("#megyek").on("change", function () {
                const megye = $("#megyek").val();
                $('#varos-nev').val('');
                $('#varos-nev-h').val('');
                $('#ujvaros').val('');
                if (megye !== "") {
                    $(".rejtett").show();
                    $.get("/leker/" + megye, function (data) {
                        $('#varos-lista').empty();
                        $.each(data, function (key, value) {
                            $('#varos-lista').append("<li class='list-group-item'>" + value.va_nev + "</li>");
                        });
                    });
                } else {
                    $(".rejtett").hide();
                }
            });

            $('#felvesz').click(function () {
                $.post("/ment", {
                    meid: $("#megyek").val(),
                    ujvaros: $('#ujvaros').val(),
                    "_token": "{{ csrf_token() }}",
                }, function (data) {
                    if (data == 1) {
                        $("#megyek").change();
                    } else {
                        $("#hiba").html(data);
                        $(".modal").modal("show");
                    }
                });
            });

            $('#varos-lista').on('click', 'li', function () {
                $('#varos-nev').val($(this).text());
                $('#varos-nev-h').val($(this).text());
                $('.edit-controls').show();
            });

            $('#szerkeszt').click(function () {
                var ujNev = $('#varos-nev').val();
                var regiNev = $('#varos-nev-h').val();
                $.post("/szerkeszt", {
                    meid: $("#megyek").val(),
                    regiNev: regiNev,
                    ujNev: ujNev,
                    "_token": "{{ csrf_token() }}",
                }, function (data) {
                    $('#varos-lista li:contains(' + ujNev + ')').text(ujNev);
                    $('#varos-nev').val('');
                    $('#varos-nev-h').val('');
                    $('.edit-controls').hide();
                    $("#megyek").change();
                });
            });

            $('#torol').click(function () {
                var torlendoNev = $('#varos-nev').val();
                $.post("/torol", {
                    meid: $("#megyek").val(),
                    torlendoNev: $('#varos-nev').val(),
                    "_token": "{{ csrf_token() }}",
                }, function (data) {
                    $('#varos-lista li:contains(' + torlendoNev + ')').remove();
                    $('#varos-nev').val('');
                    $('#varos-nev-h').val('');
                    $('.edit-controls').hide();
                });
            });

            $('#megse').click(function () {
                $('#varos-nev').val('');
                $('#varos-nev-h').val('');
                $('.edit-controls').hide();
            });
        });
    </script>
@stop
