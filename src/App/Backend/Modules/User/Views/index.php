<div class="col-12">
    <a href="/admin/user-insert.html" class="btn btn-primary">Ajouer <i class="material-icons">add_circle</i></a>
    <p class="bg-light rounded float-right p-2 colored-shadow">Utlisateurs : <?= $usersNumber ?></p>

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


    <div id="posts-table" class="card"></div>

</div>



<?php

echo '<script type="text/javascript">';

echo 'var tabledata = [';

foreach ($usersList as $user) {

    echo ' {
   
    id:' . $user->getId() . ', 
    firstName:"' . $user->getFirstName() . '", 
    lastName:"' . $user->getLastName() . '", 
    userName:"' . $user->getUserName() . '",
    email:"' . $user->getEmail() . '",
    role:"' . $user->getRole()->getName() . '",
    
    
    viewLink:"/admin/user-' . $user->getId() . '.html",
    editLink:"/admin/user-' . $user->getId() . '.html",
    deleteLink:"/admin/user-delete-' . $user->getId() . '.html", 
    
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
            {title: "Nom", field: "firstName", minWidth: 120},
            {title: "Prénom", field: "lastName", width: 120},
            {title: "Pseudo", field: "userName", width: 120},
            {title: "Email", field: "email", width: 220},
            {title: "Role", field: "role", width: 120},
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



