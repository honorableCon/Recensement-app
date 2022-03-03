<?php
function parseDataToUsableRequete($data){
    $label = "";
    $labelValues = "" ;
    foreach ($data as $key => $value) {
      $label = ($label === "") ? $key : "$label, $key";
      $labelValues = ($labelValues === "") ? ":$key" : "$labelValues, :$key";
    }

    return [$label, $labelValues];
}
?>