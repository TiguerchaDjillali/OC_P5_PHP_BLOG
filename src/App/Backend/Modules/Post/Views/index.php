<?php
use function OpenFram\h;
use function OpenFram\u;

?>
<div class="col-12">
    <a href="/admin/post-insert.html" class="btn btn-primary">Ajouter <i class="material-icons">add_circle</i></a>
    <p class="bg-light rounded float-right p-2 colored-shadow">Articles : <?= htmlspecialchars($postsNumber) ?></p>

    <?php if ($currentUser->hasFlash()) { ?>

        <div class="alert alert-success">
            <div class="container">
                <div class="alert-icon">
                    <i class="material-icons">check</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <b>Success Alert:</b> <?= htmlspecialchars($currentUser->getFlash()) ?>
            </div>
        </div>

    <?php } ?>


    <div id="posts-table" class="card"></div>

</div>

<script>
    var tabledata = <?= $dataTable ?>;
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
            {title: "Id", field: "id", width: 70},
            {title: "Titre", field: "title", minWidth: 160},
            {title: "Auteur", field: "author", width: 120},
            {
                title: "Visible?",
                field: "visible",
                width: 120,
                align: "Center",
                formatter: function (cell) {
                    if (cell.getValue() == "1") {
                        return "<i class=\"material-icons\">\n" + "visibility\n" + "</i>"
                    } else {
                        return "<i class=\"material-icons\">\n" + "visibility_off\n" + "</i>"

                    }
                }
            },
            {title: "Mis à jour", field: "lastUpdate", width: 200, sorter: "lastUpdate"},
            {
                field: "viewLink",
                width: 40,
                headerSort: false,
                frozen: true,
                cssClass:"bg-light",
                formatter: function (cell, formatterParams, onRendered) { //plain text value
                    return "<a href='" + cell.getValue() + "'><i class=\"material-icons\">\n" + "pageview\n" + "</i></a>";
                }
            },

            {
                field: "editLink",
                width: 40,
                headerSort: false,
                frozen: true,
                cssClass:"bg-light",
                formatter: function (cell, formatterParams, onRendered) { //plain text value
                    return "<a href='" + cell.getValue() + "'><i class=\"material-icons\">\n" + "edit\n" + "</i></a>";
                }

            },
            {
                field: "deleteLink",
                width: 40,
                headerSort: false,
                frozen: true,
                cssClass:"bg-light",
                formatter: function (cell, formatterParams, onRendered) { //plain text value
                    return "<a href='" + cell.getValue() + "'><i class=\"material-icons\">\n" + "delete\n" + "</i></a>";
                }

            }

        ]
    });


</script>

