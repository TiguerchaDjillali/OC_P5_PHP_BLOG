<?php
use function OpenFram\h;
use function OpenFram\u;

?>

<div class="col-md-12">


    <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#all_permissions" role="tab" data-toggle="tab" aria-selected="false">
                <i class="material-icons">person</i> Tout
            </a>
        </li>

        <?php foreach ($modules as $module => $actions) { ?>
            <li class="nav-item">
                <a class="nav-link" href="#<?= htmlspecialchars(urlencode($module)) ?>" role="tab" data-toggle="tab" aria-selected="false">
                    <i class="material-icons">person</i> <?= htmlspecialchars($module) ?>
                </a>
            </li>
        <?php } ?>
    </ul>
    <div class="tab-content tab-space">
        <div class="tab-pane active show" id="all_permissions">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h3 class="text-center">Toutes les permissions</h3>
                </div>
                <div class="card-body">
                        <?php foreach ($modules as $module => $actions) { ?>
                            <?php foreach ($actions as $action) { ?>
                                <button type="button"
                                        class="btn btn-lg btn-outline-primary"
                                        data-toggle="popover"
                                        data-container="body"
                                        data-original-title=" <?= htmlspecialchars($module) . ': ' . htmlspecialchars($action[0]) ?>"
                                        data-content="<?= htmlspecialchars($action[1]) ?>"
                                        data-color="primary">
                                    <?= htmlspecialchars($module) . '_' . htmlspecialchars($action[0]) ?>
                                </button>

                            <?php } ?>
                        <?php } ?>
                </div>
            </div>

        </div>

        <?php foreach ($modules as $module => $actions) { ?>
            <div class=" tab-pane" id="<?= htmlspecialchars($module) ?>">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h3 class="text-center">Les permissions du module <?= htmlspecialchars($module) ?></h3>
                    </div>
                    <div class="card-body">

                            <?php foreach ($actions as $action) { ?>
                                <button type="button"
                                        class="btn btn-lg btn-outline-primary"
                                        data-toggle="popover"
                                        data-container="body"
                                        data-original-title="<?= htmlspecialchars($module) . ': ' . htmlspecialchars($action[0]) ?>"
                                        data-content="<?= htmlspecialchars($action[1]) ?>"
                                        data-color="primary">
                                    <?= htmlspecialchars($module) . '_' . htmlspecialchars($action[0]) ?>
                                </button>

                            <?php } ?>
                        </div>

                </div>
            </div>
        <?php } ?>

    </div>
</div>
