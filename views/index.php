<div class="container">
    <h1 class="text-center">Games list</h1>
    <hr />
    <a href="/create" class="btn btn-success float-end">Create a game</a>
    <div class="clearfix"></div>
    <table class="table table-bordered table-striped mt-3 games-list-table">
        <thead>
            <tr>
                <th>Game ID</th>
                <th>Picture</th>
                <th>Name</th>
                <th>State</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($games) < 1) { ?>
                <tr><td colspan="5" class="text-center">No games found.</td></tr>
            <?php 
                } else {
                    foreach ($games as $game) {
            ?>
                    <tr>
                        <td><?=$game->id?></td>
                        <td><?=empty($game->picture) ? 'N/A' : \Upload\Uploader::renderImage($game->picture, $picUrls)?></td>
                        <td><?=$game->name?></td>
                        <td><?=$game::STATES[$game->state]?></td>
                        <td><?=$game->create_time?></td>
                    </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
</div>