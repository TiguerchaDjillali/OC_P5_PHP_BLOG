
<?php
use function OpenFram\escape_to_html as h;
use function OpenFram\escape_to_json as j;

use function OpenFram\u;

?>
<div class="col-12">
    <a href="/admin/role-insert.html" class="btn btn-primary">Ajouter <i class="material-icons">add_circle</i></a>
    <p class="bg-light rounded float-right p-2 colored-shadow">Roles: <?php h($rolesNumber) ?></p>

    <?php if ($currentUser->hasFlash()) { ?>
        <div class="alert alert-success">
            <div class="container">
                <div class="alert-icon">
                    <i class="material-icons">check</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <b>Success Alert:</b> <?php h($currentUser->getFlash()) ?>
            </div>
        </div>

    <?php } ?>


    <div id="posts-table" class="card"></div>

</div>

<script>
    var tabledata = <?php j($dataTable) ?>
    //create Tabulator on DOM element with id "example-table"
    var table = new Tabulator("#posts-table", {
        width: "100%",
        autoResize: true,
        data: tabledata, //assign data to table
        layout: "fitColumns",
        pagination: "local",
        paginationSize: 6,
        paginationSizeSelector: [3, 6, 8, 10],
        movableColumns: true,
        columns: [ //Define Table Columns
            {title: "Id", field: "id", width:"70"},
            {title: "Role", field: "name"},
            {title: "Slug", field: "slug"},
            {
                field: "viewLink",
                width: 40,
                headerSort: false,
                frozen: true,
                cssClass: "bg-light",
                formatter: function (cell, formatterParams, onRendered) { //plain text value
                    return "<a href='" + cell.getValue() + "'><i class=\"material-icons\">\n" + "pageview\n" + "</i></a>";
                }
            },

            {
                field: "editLink",
                width: 40,
                headerSort: false,
                frozen: true,
                cssClass: "bg-light",
                formatter: function (cell, formatterParams, onRendered) { //plain text value
                    return "<a href='" + cell.getValue() + "'><i class=\"material-icons\">\n" + "edit\n" + "</i></a>";
                }

            },
            {
                field: "deleteLink",
                width: 40,
                headerSort: false,
                frozen: true,
                cssClass: "bg-light",
                formatter: function (cell, formatterParams, onRendered) { //plain text value
                    return "<a href='" + cell.getValue() + "'><i class=\"material-icons\">\n" + "delete\n" + "</i></a>";
                }

            }

        ]
    });

</script>



