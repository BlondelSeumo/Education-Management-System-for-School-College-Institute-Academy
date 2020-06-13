<?php
use App\SmLanguagePhrase;
$getData = SmLanguagePhrase::where('active_status',1)->get();
$LanguageArr=[];
foreach ($getData as $row) {
    $LanguageArr[$row->default_phrases]=$row->en;
}
return $LanguageArr;
