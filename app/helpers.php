<?php

use Carbon\Carbon;


function presentDate($date)
{
  return Carbon::parse($date)->format('M d, Y');
}

function productImage($path)
{
  return $path && file_exists($path) ? asset($path) : asset('img/not-found.jpg');
}

//return countries array
function countries(){
  $countries = array(
      "MM" => "Myanmar",
      "CN" => "China",
      "GB" => "United Kingdom",
      "RO" => "Romania",
      "FR" => "France",
      "DE" => "Germany",
      "AU" => "Australia",
      "US" => "United States",
    );

  return $countries;
}
