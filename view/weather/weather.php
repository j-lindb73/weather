<?php

/**
 * Render content within an article.
 */

namespace Anax\View;

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


// var_dump($weatherInfoHistorical);
// echo $geoLocation;

// if (!$resultset) {
//     return;
// }
// ?>
    <h2>Väder</h2>
<div class="flex-container">

    <?php  foreach ($daily as $day) : ?>
    <div class="center-text">
        <p>
        <?= gmdate("d/m", $day->dt); ?>
        </p>
        <p>
            <img src='http://openweathermap.org/img/wn/<?= $day->weather[0]->icon ?>@2x.png'>
        </p>

        <p>
            <?= round($day->temp->day, 1) ?>°C
        </p>
        <p>
            <?= round($day->wind_speed) ?>m/s
        </p>
    </div>
    <?php endforeach; ?>

</div>

    <h2>Väder (historiskt)</h2>
<div class="flex-container">

    <?php  foreach ($weatherInfoHistorical as $day) : ?>
    <div class="center-text">
        <p>
        <?= gmdate("d/m", $day->current->dt); ?>
        </p>
        <p>
            <img src='http://openweathermap.org/img/wn/<?= $day->current->weather[0]->icon ?>@2x.png'>
        </p>

        <p>
            <?= round($day->current->temp, 1) ?>°C
        </p>
        <p>
            <?= round($day->current->wind_speed) ?>m/s
        </p>
    </div>
    <?php endforeach; ?>

</div>


</div>
