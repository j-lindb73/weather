<?php

/**
 * Render content within an article.
 */

namespace Anax\View;

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


// if (!$resultset) {
//     return;
// }
?>
<div class="flex-container">
    <div>
        <h2>
            Kolla vädret
        </h2>
    <!-- <?= currentUrl(); ?> -->
    <!-- <form method="post" action="<?= currentUrl() . "/validate"?>"> -->
        <form method="get">
            <input type="text" name="ip" value="<?= $ip ?? "" ?>">
            <input type="submit" value="Kolla">
        </form>
    </div>
    <div>
        <h2>
            Kolla vädret (JSON)
        </h2>

        <form method="get" action="<?= currentUrl() . "API"?>">
        <!-- <form method="post"> -->
            <input type="text" name="ip" value="<?= $ip ?? "" ?>">




            <input type="submit" value="Kolla">
        </form>
    </div>
</div>
<h2>
    Kolla vädret
</h2>
<p>
    Sök i rutorna ovan efter en IP och få reda på vädret på den plats där IP-adressen lokaliseras.
</p>
    <p>Genomför validering av ip-adress 194.47.131.154 (ssh.student.bth.se i Karlskrona) genom att trycka på knapparna nedan. 
        <br>WEBB presenterar svaret nedan och JSON levererar informationen i JSON-format. 
</p>
</p>
<div class="flex-container">
    <form method="get" action="<?= currentUrl()?>">
        <input type="hidden" name="ip" value="194.47.131.154">
        <input type="submit" value="WEBB">
    </form>
    <form method="get" action="<?= currentUrl() . "API"?>">
        <input type="hidden" name="ip" value="194.47.131.154">
        <input type="submit" value="JSON">
    </form>
</div>


