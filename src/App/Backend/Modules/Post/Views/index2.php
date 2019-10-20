<?php
use function OpenFram\h;
use function OpenFram\u;

?>
<div class="fresh-table col-12">



    <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
            Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
    -->

    <div class="toolbar">
        <button id="alertBtn" class="btn btn-default">Alert</button>
    </div>

    <table id="fresh-table" class="table">
        <thead>
        <th style="" data-field="name"><div class="th-inner sortable both desc">Name</div><div class="fht-cell"></div></th>
        <th data-field="title">Titre</th>
        <th data-field="author">Auteur</th>
        <th data-field="visible">Visible?</th>
        <th data-field="publicationDAte">Date de publication</th>
        <th>Actions</th>
        </thead>
        <tbody>

        <?php foreach ($postsList as $post) { ?>
            <tr>
                <td scope="row"><?php echo $post->getId() ?></td>
                <td><a href="/admin/show/"><?php echo $post->getTitle() ?></a></td>
                <td><?php echo $post->getUser()->getUserName() ?></td>
                <td><?php echo $post->isVisible() ? 'Oui' : 'Non' ?></td>
                <td><?php echo $post->getPublicationDate()->format('d/m/y') ?></td>


                <td>


                    <ul class="nav nav-pills nav-pills-primary">
                        <li class="nav-item">
                            <a class="nav-link" href="#link1">
                                <i class="material-icons">pageview</i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#link1">
                                <i class="material-icons">edit</i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#link1">
                                <i class="material-icons">delete</i>
                            </a>
                        </li>

                    </ul>

                </td>


            </tr>

        <?php } ?>
        </tbody>
    </table>
</div>

