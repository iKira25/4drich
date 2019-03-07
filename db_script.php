<?php

include("curl.php");


$homepage = scrape_data_homepage("https://www.check4d.com/");
$east_malaysia = scrape_data_east_malaysia("https://www.check4d.com/sabah-sarawak-4d-results/");
$singapore = scrape_data_singapore("https://www.check4d.com/singapore-4d-results/");

// print_r($homepage);
print_r($east_malaysia);
// print_r($singapore);
