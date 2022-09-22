<?php



function compareDate($time1, $time2)
{
    if (strtotime($time1) < strtotime($time2))
        return -1;
    else if (strtotime($time1) > strtotime($time2))
        return 1;
    else
        return 1;
}


$event = [
    'name' => 'RDV Client Smith',
    'date' => '20191231',
    'location' => 'Nantes'
];

function display_event(array $event)
{
    $date = strtotime($event['date']);

    echo "The \"" . $event['name'] .
        "\" event will take place on " .
        date('d-m-Y', $date) . " in " .
        $event['location'] . "\n";
}



$events = [
    [
        'name' => 'Reunion Client',
        'date' => '20200505',
        'location' => 'Nantes'
    ],
    [
        'name' => 'Affinage sprint 2',
        'date' => '20200705',
        'location' => 'Nantes'
    ],
    [
        'name' => 'RDV pro',
        'date' => '20200705',
        'location' => 'Paris'
    ],
    [
        'name' => 'Brainstroming',
        'date' => '20190705',
        'location' => 'Lyon'
    ],
    [
        'name' => 'Demonstration client',
        'date' => '20200205',
        'location' => 'Lille'
    ]
];


function display_events_by_month(array $events)
{

    $tableau = trie($events);
    foreach ($tableau[0] as $key => $value) {
        $date = strtotime($value['date']);
        $date_key = $tableau[1][$key] . "\n";
        if ($key > 0) {
            if ($tableau[1][$key - 1] == $tableau[1][$key]) {
                $date_key = "";
            }
        }

        echo $date_key;
        echo "  The \"" . $value['name'] .
            "\" event will take place on " .
            date('d-m-Y', $date) . " in " .
            $value['location'] . "\n";
    }
}


function display_events_between_months($events, $dateBegin, $dateEnd)
{
    $dateBegin = strtotime($dateBegin . '01');
    $dateEnd = strtotime($dateEnd . '01');

    $tableau = trie($events);
    foreach ($tableau[0] as $key => $value) {
        $date = strtotime($value['date']);
        $date_key = $tableau[1][$key] . "\n";
        if ($key > 0) {
            if ($tableau[1][$key - 1] == $tableau[1][$key]) {
                $date_key = "";
            }
        }

        if (strtotime($tableau[1][$key]) >= $dateBegin && strtotime($tableau[1][$key]) <= $dateEnd) {

            echo $date_key;
            echo "  The \"" . $value['name'] .
                "\" event will take place on " .
                date('d-m-Y', $date) . " in " .
                $value['location'] . "\n";
        }
    }
}


function display_calendar($events, $dateBegin, $dateEnd)
{
    $dateBegin = strtotime($dateBegin . '01');
    $dateEnd = strtotime($dateEnd . '01');

    $tableau = trie($events);

    $date_1 = substr($tableau[1][0] , 5);
    $date_2 = substr($dateEnd , 3);
    // for(;$tableau[1][0] < $tableau[1][array_key_last($tableau)]; $tableau[1][0]++) {
        // $int = 7;
        // echo "Mon  Tue  Wed  Thu  Fri  Sat  Sun\n";
        // for ($i = 1; $i < 36; $i++) {
        //     echo " 0   ";
        //     if ($i == $int) {
        //         echo "\n";
        //         $int = $int + 7;
        //     }
        // var_dump($tableau);
        // }
        // echo "\n";
    
    
    // echo strtotime($tableau[1][array_key_last($tableau[1])] ."-01");
    
}




function trie($events)
{
    $arr_1 = [];
    foreach ($events as $value) {
        $date = strtotime($value['date']);
        $date = date('Y-m', $date);
        array_push($arr_1, $date);
    }
    $affiche = [];

    usort($arr_1, "compareDate");
    foreach ($arr_1 as $value) {

        foreach ($events as $event => $val) {
            $date = strtotime($val['date']);
            $date = date('Y-m', $date);
            if ($value == $date && count($affiche) < count($events)) {
                array_push($affiche, $val);
            }
        }
    }
    $tableau = [$affiche, $arr_1];
    return $tableau;
}
