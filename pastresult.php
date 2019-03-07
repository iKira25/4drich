<?php require_once("header.php") ?>

<!--
------------------------------------------------------
Edit this style to change how the date is highlighted
------------------------------------------------------
-->
<style>
    .highlight {
        background-color: #fdf59a;
        color: red;
    }

    .datepicker table tr td.active:active,
    .datepicker table tr td.active.highlighted:active,
    .datepicker table tr td.active.active,
    .datepicker table tr td.active.highlighted.active {
        color: white;
        background-color: #d63031;
    }

    .datepicker table tr td.active:active:hover,
    .datepicker table tr td.active.highlighted:active:hover,
    .datepicker table tr td.active.active:hover,
    .datepicker table tr td.active.highlighted.active:hover,
    .datepicker table tr td.active:active:focus,
    .datepicker table tr td.active.highlighted:active:focus,
    .datepicker table tr td.active.active:focus,
    .datepicker table tr td.active.highlighted.active:focus,
    .datepicker table tr td.active:active.focus,
    .datepicker table tr td.active.highlighted:active.focus,
    .datepicker table tr td.active.active.focus,
    .datepicker table tr td.active.highlighted.active.focus {
        color: white;
        background-color: #d63031;
    }
</style>

<div class="container-fluid content-center mb-5" id="datepickerform">
    <form class="form" method="post" autocomplete="off">
        <div class="form-row">
            <div class="col-1 offset-3 justify-content-center d-flex align-items-center">
                <label class="control-label" for="date">Date</label>
            </div>
            <div class="col-4">
                <input class="form-control" id="date" name="date" placeholder="dd/mm/yyyy" type="text" />
            </div>
            <div class="col-1">
                <button class="btn btn-primary " name="submit" type="submit">Submit</button>
            </div>
        </div>
    </form>

</div>

<div class="container mt-2 mb-4 text-center">
    <div class="row">
        <div class="d-none d-md-block text-center col-12 col-lg-12 col-md-12 col-sm-12">
            <img src="img/728.png" alt="728ads">
        </div>
        <div class="d-block d-md-none text-center col-12 col-lg-12 col-md-12 col-sm-12">
            <img src="img/320.png" alt="320ads">
        </div>
    </div>
</div>



<script>
    /*
------------------------------------------------------
Edit this array to change which date is highlighted
------------------------------------------------------
*/
    var availableDates = ["20-2-2019", "16-2-2019"];

    $(document).ready(function() {
        var date_input = $('input[name="date"]'); //our date input has the name "date"
        var container = $('#datepickerform form').length > 0 ? $('#datepickerform form').parent() : "body";
        var options = {
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            endDate: "today",
            clearBtn: true,
            multidate: false,
            todayHighlight: true,
            maxViewMode: 2,


            beforeShowDay: function(date) {
                var month = date.getMonth() + 1;
                var comparedDate = date.getDate() + "-" + month + "-" + date.getFullYear();
                if ($.inArray(comparedDate, availableDates) != -1) {
                    return {
                        enabled: true,
                        classes: "highlight"
                    };
                } else {
                    return false;
                }
            }
        };
        date_input.datepicker(options);
    })
</script>


<?php require_once("footer.php") ?> 