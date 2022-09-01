<?php
function formatrupiah($nilai){
    $formatrupiah = number_format($nilai, 2, ',','.');
    return $formatrupiah;
}
?>