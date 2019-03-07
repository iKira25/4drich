<?php

scrape_homepage("https://www.check4d.com/");

function scrape_homepage($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $table = array();
    $table2 = array();
    $table3 = array();

    preg_match_all('!(((((outerbox(.*?)id=")))))!', $result, $match);
    for ($i = 0; $i < count($match); $i++) {
        // GET TITLE 
        if (preg_match_all('!.gif"\/><\/td><td class="result.*?lable">(.*?)<\/td><\/tr>!', $match[1][$i], $title)) {
            $table['title'][$i] = $title[1];
        } else {
            $table['title'][$i] = '';
        }
        // GET DRAW DATE
        if (preg_match_all('!<td class="resultdrawdate">Date: (.*?)<\/td>!', $match[1][$i], $drawdate)) {
            $table['drawdate'][$i] = $drawdate[1];
        } else {
            $table['drawdate'][$i] = '';
        }
        // GET DRAW NO
        if (preg_match_all('!<td class="resultdrawdate">Draw No: (.*?)<\/td>!', $match[1][$i], $drawno)) {
            $table['drawno'][$i] = $drawno[1];
        } else {
            $table['drawno'][$i] = '';
        }
        // GET FIRST PRIZE
        if (preg_match_all('!<td style="width:45%" class="resultprizelable">1st.*?"resulttop">(.*?)<\/td>!', $match[1][$i], $first)) {
            $table['first'][$i] = $first[1];
        } else {
            $table['first'][$i] = '';
        }
        // GET SECOND PRIZE
        if (preg_match_all('!<td style="width:45%" class="resultprizelable">2nd.*?"resulttop">(.*?)<\/td>!', $match[1][$i], $second)) {
            $table['second'][$i] = $second[1];
        } else {
            $table['second'][$i] = '';
        }
        // GET THIRD PRIZE
        if (preg_match_all('!<td style="width:45%" class="resultprizelable">3rd.*?"resulttop">(.*?)<\/td>!', $match[1][$i], $third)) {
            $table['third'][$i] = $third[1];
        } else {
            $table['third'][$i] = '';
        }
        // GET SPECIAL PRIZE
        $table['special'] = getSpecial($result);

        // GET CONSOLATION PRIZE
        $table['consolation'] = getConsolation($result);
    }

    // REARRANGE THE ARRAY SEQUENCE AS GOT ERROR
    $temp = $table['title'][3];
    $table['title'][3] = $table['title'][4];
    $table['title'][4] = $temp;


    // ---------- 4D GAME ONLY ---------- //

    // STORE ALL INDIVIDUAL DATA TO ARRAY
    for ($h = 0; $h < 3; $h++) {
        ${"Title" . $h} = $table['title'][$h];
        ${"Drawdate" . $h} = $table['drawdate'][$h];
        ${"Drawno" . $h} = $table['drawno'][$h];
        ${"First" . $h} = $table['first'][$h];
        ${"Second" . $h} = $table['second'][$h];
        ${"Third" . $h} = $table['third'][$h];
        ${"Special" . $h} = $table['special'][$h];
        ${"Consolation" . $h} = $table['consolation'][$h];
    }

    // MERGE ALL ARRAY TO ONE VARIABLE
    for ($d = 0; $d < 3; $d++) {
        ${"groupData" . $d} = array_merge(${"Title" . $d}, ${"Drawdate" . $d}, ${"Drawno" . $d}, ${"First" . $d}, ${"Second" . $d}, ${"Third" . $d}, ${"Special" . $d}, ${"Consolation" . $d});
    }
    // CONVERT ARRAY TO STRING WITH DELIMITERS TO INSERT INTO DB
    for ($e = 0; $e < 3; $e++) {
        ${"cleanData" . $e} = implode("||", ${"groupData" . $e});
    }

    // for ($q = 0; $q < 3; $q++) {
    //     echo ${"cleanData" . $q} . "\n\n";
    // }

    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */



    // ---------- END OF 4D GAME ONLY ---------- //

    // ---------- DA MA CAI 3+3D ---------- //

    // GET WINNERS
    preg_match_all('!<td style="width:30%".*?"resulttop">(.*?)<\/td>!', $result, $match);
    $tabledamacai6d['winners'] = $match[1];

    // GET ANIMAL
    preg_match_all('!16px;background-color: #cc0000">(.*?)<\/td>!', $result, $match);
    $tabledamacai6d['animal'] = $match[1];

    // STORE ALL INDIVIDUAL DATA TO ARRAY
    $Title3 = $table['title'][3];
    $Drawdate3 = $table['drawdate'][3];
    $Drawno3 = $table['drawno'][3];
    $First3 = $tabledamacai6d['winners'][0];
    $Second3 = $tabledamacai6d['winners'][1];
    $Third3 = $tabledamacai6d['winners'][2];
    $Animal1 = $tabledamacai6d['animal'][0];
    $Animal2 = $tabledamacai6d['animal'][1];
    $Animal3 = $tabledamacai6d['animal'][2];
    $Special3 = $table['special'][3];
    $Consolation3 = $table['consolation'][3];

    // MERGE ALL ARRAY TO ONE VARIABLE
    $groupData3one = array_merge($Title3, $Drawdate3, $Drawno3);
    $groupData3two = array_merge($Special3, $Consolation3);

    // CONVERT ARRAY TO STRING WITH DELIMITERS TO INSERT INTO DB
    $cleanData3one = implode("||", $groupData3one);
    $cleanData3two = implode("||", $groupData3two);
    $cleanData3 = $cleanData3one . "||" . $First3 . "||" . $Second3 . "||" . $Third3 . "||" . $Animal1 . "||" . $Animal2 . "||" . $Animal3 . "||" . $cleanData3two;
    // echo $cleanData3;

    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */
    /*  SQL QUERY HERE */

    // ---------- END OF DA MA CAI 3+3D ---------- //

    // ---------- SPORTSTOTO ---------- //

    // ------ GET 5D WINNER ----------- // 

    preg_match_all('!5D<\/td>.*?<td class="result5dprizelable">.*?<\/td>(.*?)6D<\/td>!', $result, $match);
    $filter5D = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!<td class="resultbottom">(.*?)<\/td>!', $match[1][$i], $winner5D)) {
            $table5D['5Dwinner'][$i] = $winner5D[1];
        } else {
            $table5D['5Dwinner'][$i] = '';
        }
    }

    print_r($table5D['5Dwinner'][0]);
}





















// INTERNAL FUNCTION ---DONT DISTURB THIS CODE, UNLESS YOU KNOW WHAT YOU ARE DOING!
function getSpecial($result)
{
    if (preg_match_all('!<td colspan="5" class="resultprizelable">Special.*?<\/td><\/tr><tr>(.*?)<\/tr><tr><td colspan!', $result, $match)) {
        for ($c = 0; $c < count($match[1]); $c++) {
            //match 
            if (preg_match_all('!<td class="resultbottom">(.*?)<\/td>!', $match[1][$c], $winnerSpecial)) {
                $table2['specialPrize'][$c] = $winnerSpecial[1];
            } else {
                $table2['specialPrize'][$c] = '';
            }
        }
    }

    return $table2['specialPrize'];
}

function getConsolation($result)
{
    if (preg_match_all('!<td colspan="5" class="resultprizelable">Consolation.*?<\/td><\/tr><tr>(.*?)<\/tr><\/table>!', $result, $match)) {
        for ($d = 0; $d < count($match[1]); $d++) {
            //match 
            if (preg_match_all('!<td class="resultbottom">(.*?)<\/td>!', $match[1][$d], $winnerConsolation)) {
                $table3['consolationPrize'][$d] = $winnerConsolation[1];
            } else {
                $table3['consolationPrize'][$d] = '';
            }
        }
    }

    return $table3['consolationPrize'];
}
