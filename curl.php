<?php

function scrape_data_homepage($url)
{

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $table4D = array();
    $table5D = array();
    $table6D = array();
    $tableToto = array();
    $tableMagnumLife = array();
    $tableMagnum4DJackpot = array();
    $all_data1 = array();
    echo "WEST MALAYSIA RESULT\n";

    // GET TITLE OF TABLE (4D NAME)
    preg_match_all('!.gif"\/><\/td><td class="result.*?lable">(.*?)<\/td><\/tr>!', $result, $match);
    $table4D['title'] = $match[1];
    echo "TITLE ";
    // GET DATE OF DRAW
    preg_match_all('!<td class="resultdrawdate">Date: (.*?)<\/td>!', $result, $match);
    $table4D['drawDate'] = $match[1];
    echo "Draw Date ";
    // GET DRAW NO
    preg_match_all('!<td class="resultdrawdate">Draw No: (.*?)<\/td>!', $result, $match);
    $table4D['drawNo'] = $match[1];
    echo "Draw No ";
    // GET 1ST PRIZE 4D
    preg_match_all('!<td style="width:45%" class="resultprizelable">1st.*?"resulttop">(.*?)<\/td>!', $result, $match);
    $table4D['fPrizeNormal'] = $match[1];
    echo "1st Prize ";


    // GET 2ND PRIZE 4D
    preg_match_all('!<td style="width:45%" class="resultprizelable">2nd.*?"resulttop">(.*?)<\/td>!', $result, $match);
    $table4D['sPrizeNormal'] = $match[1];
    echo "2nd Prize ";


    // GET 3RD PRIZE 4D
    preg_match_all('!<td style="width:45%" class="resultprizelable">3rd.*?"resulttop">(.*?)<\/td>!', $result, $match);
    $table4D['tPrizeNormal'] = $match[1];
    echo "3rd Prize ";



    // GET SPECIAL PRIZE
    preg_match_all('!<td colspan="5" class="resultprizelable">Special.*?<\/td><\/tr><tr>(.*?)<\/tr><tr><td colspan!', $result, $match);
    $filterSpecial = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!<td class="resultbottom">(.*?)<\/td>!', $match[1][$i], $winnerSpecial)) {
            $table4D['specialPrize'][$i] = $winnerSpecial[1];
        } else {
            $table4D['specialPrize'][$i] = '';
        }
    }
    echo "Special Prize ";



    // GET CONSOLATION PRIZE
    preg_match_all('!<td colspan="5" class="resultprizelable">Consolation.*?<\/td><\/tr><tr>(.*?)<\/tr><\/table>!', $result, $match);
    $filterConsolation = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!<td class="resultbottom">(.*?)<\/td>!', $match[1][$i], $winnerConsolation)) {
            $table4D['consolationPrize'][$i] = $winnerConsolation[1];
        } else {
            $table4D['consolationPrize'][$i] = '';
        }
    }

    echo "Consolation Prize ";




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
    echo "5D Winner ";

    // ------ GET 6D WINNER ----------- // 

    preg_match_all('!6D<\/td>.*?<td class="result5dprizelable">.*?<\/td>(.*?)Sta!', $result, $match);
    $filter6D = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!"resultbottom">(.*?)<\/td>!', $match[1][$i], $winner6D)) {
            $table6D['6Dwinner'][$i] = $winner6D[1];
        } else {
            $table6D['6Dwinner'][$i] = '';
        }
    }
    echo "6D Winner ";


    // ------ GET STAR TOTO ----------- // 

    // GET WINNER

    preg_match_all('!Star.*? cellspacing="0"> <tr>(.*?)>Jackpot!', $result, $match);
    $filterStarToto = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!"resultbottomtoto2".*?>(.*?)<\/td>!', $match[1][$i], $winnerStarToto)) {
            $tableToto['StarTotoWinner'][$i] = $winnerStarToto[1];
        } else {
            $tableToto['StarTotoWinner'][$i] = '';
        }
    }
    echo "Star Toto Winner ";



    // GET STAR TOTO JACKPOT
    preg_match_all('!<td colspan="5" class="resultbottomtotojpval">(.*?)<\/td>!', $result, $match);
    $tableToto['StarTotoJackpot'] = $match[1];
    echo "Star Toto Jackpot ";



    // ------ GET POWER TOTO ----------- // 

    preg_match_all('!<td class="resultbottomtoto">(.*?)<\/td>!', $result, $match);
    $tableToto['PowerTotoWinner'] = array_slice($match[1], 0, 6);

    echo "Power Toto Winner ";



    // GET POWER TOTO JACKPOT
    preg_match_all('!<td colspan="4" class="resultbottomtotojpval">(.*?)<\/td>!', $result, $match);
    $tableToto['PowerTotoJackpot'] = array_slice($match[1], 0, 1);
    echo "Power Toto Jackpot ";




    // ------ GET SUPREME TOTO ----------- // 

    preg_match_all('!<td class="resultbottomtoto">(.*?)<\/td>!', $result, $match);
    $tableToto['SupremeTotoWinner'] = array_slice($match[1], 6, 11);

    echo "Supreme Toto Winner ";



    // GET SUPREME TOTO JACKPOT
    preg_match_all('!<td colspan="4" class="resultbottomtotojpval">(.*?)<\/td>!', $result, $match);
    $tableToto['SupremeTotoJackpot'] = array_slice($match[1], 1);
    echo "Supreme Toto Jackpot ";




    // ------ GET MAGNUM LIFE ----------- // 
    preg_match_all('!Winning Numbers.*?cellspacing="0">(.*?)<\/tr>!', $result, $match);
    $filterWinnerMagnumLife = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!<td class="resultbottomtoto2">(.*?)<\/td>!', $match[1][$i], $winnerMagnumLife)) {
            $tableMagnumLife['winner'][$i] = $winnerMagnumLife[1];
        } else {
            $tableMagnumLife['winner'][$i] = '';
        }
    }
    echo "Magnum Life Winner ";



    //GET BONUS NUMBER MAGNUM LIFE
    preg_match_all('!(Bonus.*?Grand)!', $result, $match);
    $getValue = implode($match[1]);
    preg_match_all('!<td class="resultbottomtoto2">(.*?)<\/td>!', $getValue, $match);
    $tableMagnumLife['bonus'] = $match[1];
    echo "Magnum Life Bonus ";




    // ------ GET MAGNUM 4D JACKPOT ----------- // 
    preg_match_all('!class="resultprizelable">Jackpot 1.*?cellspacing="0"><tr>(.*?)Jackpot 2!', $result, $match);
    $getValue2 = implode($match[1]);
    preg_match_all('!<td class="resultbottomm4d">(.*?)<\/td>!', $getValue2, $match);
    $tableMagnum4DJackpot['winnerJackpot'] = $match[1];
    echo "Magnum 4D Jackpot ";


    $all_data1 = array_merge($table4D, $table5D, $table6D, $tableToto, $tableMagnumLife, $tableMagnum4DJackpot);

    return $all_data1;
}


function scrape_data_east_malaysia($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $table4D = array();
    $tableToto = array();
    $all_data2 = array();
    echo "EAST MALAYSIA RESULT\n";

    // GET TITLE OF TABLE (4D NAME)
    preg_match_all('!.gif"\/><\/td><td class="result.*?lable">(.*?)<\/td><\/tr>!', $result, $match);
    $table4D['title'] = $match[1];
    echo "TITLE ";
    // GET DATE OF DRAW
    preg_match_all('!<td class="resultdrawdate">Date: (.*?)<\/td>!', $result, $match);
    $table4D['drawDate'] = $match[1];
    echo "Draw Date ";
    // GET DRAW NO
    preg_match_all('!<td class="resultdrawdate">Draw No: (.*?)<\/td>!', $result, $match);
    $table4D['drawNo'] = $match[1];
    echo "Draw No ";
    // GET 1ST PRIZE 4D
    preg_match_all('!<td style="width:45%" class="resultprizelable">1st.*?"resulttop">(.*?)<\/td>!', $result, $match);
    $table4D['fPrizeNormal'] = $match[1];
    echo "1st Prize ";


    // GET 2ND PRIZE 4D
    preg_match_all('!<td style="width:45%" class="resultprizelable">2nd.*?"resulttop">(.*?)<\/td>!', $result, $match);
    $table4D['sPrizeNormal'] = $match[1];
    echo "2nd Prize ";


    // GET 3RD PRIZE 4D
    preg_match_all('!<td style="width:45%" class="resultprizelable">3rd.*?"resulttop">(.*?)<\/td>!', $result, $match);
    $table4D['tPrizeNormal'] = $match[1];
    echo "3rd Prize ";



    // GET SPECIAL PRIZE
    preg_match_all('!<td colspan="5" class="resultprizelable">Special.*?<\/td><\/tr><tr>(.*?)<\/tr><tr><td colspan!', $result, $match);
    $filterSpecial = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!<td class="resultbottom">(.*?)<\/td>!', $match[1][$i], $winnerSpecial)) {
            $table4D['specialPrize'][$i] = $winnerSpecial[1];
        } else {
            $table4D['specialPrize'][$i] = '';
        }
    }
    echo "Special Prize ";



    // GET CONSOLATION PRIZE
    preg_match_all('!<td colspan="5" class="resultprizelable">Consolation.*?<\/td><\/tr><tr>(.*?)<\/tr><\/table>!', $result, $match);
    $filterConsolation = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!<td class="resultbottom">(.*?)<\/td>!', $match[1][$i], $winnerConsolation)) {
            $table4D['consolationPrize'][$i] = $winnerConsolation[1];
        } else {
            $table4D['consolationPrize'][$i] = '';
        }
    }
    echo "Consolation Prize ";




    // GET LOTTO 6/45
    preg_match_all('!Lotto 6\/45.*?cellspacing="0"><tr>(.*?)<\/tr>!', $result, $match);
    $filterStarToto = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!"resultbottomtoto2".*?>(.*?)<\/td>!', $match[1][$i], $winnerSabah88)) {
            $tableToto['Sabah88Winner'][$i] = $winnerSabah88[1];
        } else {
            $tableToto['Sabah88Winner'][$i] = '';
        }
    }
    echo "Sabah 88 Winner ";


    // GET LOTTO JACKPOT
    preg_match_all('!<td colspan="5" class="resultbottomtotojpval">(.*?)<\/td>!', $result, $match);
    $tableToto['Sabah88Jackpot'] = $match[1];
    echo "Sabah 88 Jackpot ";


    $all_data2 = array_merge($table4D, $tableToto);

    return $all_data2;
}
function scrape_data_singapore($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $table4D = array();
    $tableToto = array();
    $all_data3 = array();
    echo "SINGAPORE RESULT\n";

    // GET TITLE OF TABLE (4D NAME)
    preg_match_all('!<td class="resultsg4dlable" colspan=2>(.*?)<\/td>!', $result, $match);
    $table4D['title'] = $match[1];
    echo "TITLE ";
    // GET DATE OF DRAW
    preg_match_all('!<td class="resultdrawdate">Date: (.*?)<\/td>!', $result, $match);
    $table4D['drawDate'] = $match[1];
    echo "Draw Date ";
    // GET DRAW NO
    preg_match_all('!<td class="resultdrawdate">Draw No: (.*?)<\/td>!', $result, $match);
    $table4D['drawNo'] = $match[1];
    echo "Draw No ";
    // GET 1ST PRIZE 4D
    preg_match_all('!<td style="width:45%" class="resultprizelable">1st.*?"resulttop">(.*?)<\/td>!', $result, $match);
    $table4D['fPrizeNormal'] = $match[1];
    echo "1st Prize ";


    // GET 2ND PRIZE 4D
    preg_match_all('!<td style="width:45%" class="resultprizelable">2nd.*?"resulttop">(.*?)<\/td>!', $result, $match);
    $table4D['sPrizeNormal'] = $match[1];
    echo "2nd Prize ";


    // GET 3RD PRIZE 4D
    preg_match_all('!<td style="width:45%" class="resultprizelable">3rd.*?"resulttop">(.*?)<\/td>!', $result, $match);
    $table4D['tPrizeNormal'] = $match[1];
    echo "3rd Prize ";



    // GET SPECIAL PRIZE
    preg_match_all('!<td colspan="5" class="resultprizelable">Special.*?<\/td><\/tr><tr>(.*?)<\/tr><tr><td colspan!', $result, $match);
    $filterSpecial = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!<td class="resultbottom">(.*?)<\/td>!', $match[1][$i], $winnerSpecial)) {
            $table4D['specialPrize'][$i] = $winnerSpecial[1];
        } else {
            $table4D['specialPrize'][$i] = '';
        }
    }
    echo "Special Prize ";


    // GET CONSOLATION PRIZE
    preg_match_all('!<td colspan="5" class="resultprizelable">Consolation.*?<\/td><\/tr><tr>(.*?)<\/tr><\/table>!', $result, $match);
    $filterConsolation = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!<td class="resultbottom">(.*?)<\/td>!', $match[1][$i], $winnerConsolation)) {
            $table4D['consolationPrize'][$i] = $winnerConsolation[1];
        } else {
            $table4D['consolationPrize'][$i] = '';
        }
    }
    echo "Consolation Prize ";




    // GET SINGAPORE TOTO
    preg_match_all('!>Toto.*?cellspacing="0"><tr>(.*?)<td colspan="8">!', $result, $match);
    $filterStarToto = $match[1];
    for ($i = 0; $i < count($match[1]); $i++) {
        //match 
        if (preg_match_all('!"resultbottomtoto2".*?>(.*?)<\/td>!', $match[1][$i], $winnerSingaporeToto)) {
            $tableToto['SingaporeToto'][$i] = $winnerSingaporeToto[1];
        } else {
            $tableToto['SingaporeToto'][$i] = '';
        }
    }
    echo "Sabah 88 Winner ";


    //GET PRIZE GROUP SHARE
    preg_match_all('!<td colspan="3" class="resultbottomtotojpval">(.*?)<\/td>!', $result, $match);
    $tableToto['prizeGroup'] = $match[1];
    echo "Prize Group Share ";

    $all_data3 = array_merge($table4D, $tableToto);

    return $all_data3;
}
