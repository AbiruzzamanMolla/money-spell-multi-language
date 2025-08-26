<?php

require __DIR__ . '/../vendor/autoload.php';

use AzMolla\SpellMoney\Languages\Arabic;
use AzMolla\SpellMoney\Languages\Bangla;
use AzMolla\SpellMoney\Languages\Chinese;
use AzMolla\SpellMoney\Languages\English;
use AzMolla\SpellMoney\Languages\Hindi;
use AzMolla\SpellMoney\Languages\Thai;
use AzMolla\SpellMoney\SpellMoney;

$amounts = [
    "Bangla"  => ["cls" => Bangla::class, "num" => "১২৩৪৫.৫০"],
    "English" => ["cls" => English::class, "num" => "12345.50"],
    "Hindi"   => ["cls" => Hindi::class, "num" => "१२३४५.५०"],
    "Chinese" => ["cls" => Chinese::class, "num" => "１２３４５.５０"],
    "Thai"    => ["cls" => Thai::class, "num" => "๑๒๓๔๕.๕๐"],
    "Arabic"  => ["cls" => Arabic::class, "num" => "١٢٣٤٥.٥٠"],
];

foreach ($amounts as $lang => $data) {
    $spell = new SpellMoney(new $data["cls"]());
    echo "[$lang] " . $spell->spell($data["num"]) . PHP_EOL;
}
