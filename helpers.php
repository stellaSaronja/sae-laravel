<?php

function nice_number($n) {

    return number_format($n, 0, ',', '.');
}

function nice_date($date = null) {

    if (!$date) {

        return null;
    }

    // == https://carbon.nesbot.com/docs/
    // == https://www.php.net/manual/en/datetime.format.php

    return $date->diffForHumans() . ' ' . $date->format('d. M Y H:i');
}
