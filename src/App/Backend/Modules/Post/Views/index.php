<div class="col-12">
    <a href="/admin/post-insert.html" class="btn btn-primary">Ajouer <i class="material-icons">add_circle</i></a>
    <p class="bg-light rounded float-right p-2 colored-shadow">Articles : <?= $postsNumber ?></p>

    <div id="posts-table" class="card"></div>

</div>


<?php

echo '<script type="text/javascript">';
echo 'var tabledata = [';

foreach ($postsList as $post) {

    echo ' {
    
    id:' . $post->getId() . ', 
    title:"' . $post->getTitle() . '", 
    author:"' . $post->getUser()->getUserName() . '", 
    visible:"' . $post->isVisible() . '",
    lastUpdate:"' . $post->getPublicationDate()->format('d/m/Y à H\hi\ ') . '",
    
    
    viewLink:"/post-' . $post->getId() . '.html",
    editLink:"/post-edit-' . $post->getId() . '.html",
    deleteLink:"/post-delete-' . $post->getId() . '.html", 
    
    viewLabel:"Voir" ,
    editLabel:"Editer",
    deleteLabel:"Supprimer"
    }, ';

}
echo '];';
echo '</script>';

?>

<script>

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
            {title: "Mis à jour", field: "lastUpdate", width: 200},
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
                field: "editLink",
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

