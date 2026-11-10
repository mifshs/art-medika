<?php
$urls = [
    'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/gallery/compare1.png',
    'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/gallery/compare2.png',
    'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/gallery/compare3.png',
    'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/gallery/compare4.png',
    'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/gallery/compare5.png',
    'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/gallery/compare6.png',
    'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/gallery/compare7.png',
    'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/gallery/compare8.png',
];
foreach ($urls as $u) {
    $size = @getimagesize($u);
    if ($size) {
        echo basename($u) . ' : ' . $size[0] . 'x' . $size[1] . PHP_EOL;
    } else {
        echo basename($u) . ' : NOT FOUND' . PHP_EOL;
    }
}
