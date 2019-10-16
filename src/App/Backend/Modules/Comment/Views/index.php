<div class="col-12">
    <p class="bg-light rounded float-right p-2 mx-2 colored-shadow">En attente de
        validation: <?= $nonValidCommentsNumber ?? '' ?></p>
    <p class="bg-light rounded float-right p-2 mx-2 colored-shadow">Commentaires: <?= $commentsNumber ?? '' ?></p>

    <?php if ($currentUser->hasFlash()) { ?>

        <div class="alert alert-success">
            <div class="container">
                <div class="alert-icon">
                    <i class="material-icons">check</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <b>Success Alert:</b> <?= $currentUser->getFlash() ?>
            </div>
        </div>

    <?php } ?>


    <div id="comments-table" class="card"></div>

</div>


<script>

    var tabledata = <?= $dataTable ?>;
    var table = new Tabulator("#comments-table", {
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
            {title: "Article", field: "postTitle", minWidth: 160},
            {
                title: "Commentaire", field: "content", minWidth: 160, formatter: "link", formatterParams: {
                    url: function (row) {
                        return row.getData().editLink;
                    },
                }
            },
            {title: "Auteur", field: "author", width: 120},
            {
                title: "Validé?",
                field: "valid",
                width: 120,
                align: "Center",
                formatter: function (cell) {
                    if (cell.getValue() == "1") {
                        return "<i class=\"material-icons\">\n" + "done\n" + "</i>"
                    } else {
                        return "<i class=\"material-icons\">\n" + "query_builder\n" + "</i>"

                    }
                }
            },
            {title: "Publié le", field: "publicationDate", width: 200, sorter: "publicationDate"},
            {
                title: "Modérer",
                field: "editLink",
                align: "Center",
                width: 120,
                headerSort: false,
                frozen: true,
                cssClass: "bg-light",
                formatter: function (cell, formatterParams, onRendered) { //plain text value
                    return "<a href='" + cell.getValue() + "'><i class=\"material-icons\">\n" + "settings_applications\n" + "</i></a>";
                }

            }

        ]
    });


</script>

