<?php
$urls = [
    'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/gallery/compare1.png',
    'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/gallery/compare2.png',
];
$ctx = stream_context_create(['http' => ['timeout' => 3]]);
foreach ($urls as $u) {
    $img = @file_get_contents($u, false, $ctx);
    if ($img) {
        $size = getimagesizefromstring($img);
        echo basename($u) . ' : ' . $size[0] . 'x' . $size[1] . PHP_EOL;
    } else {
        echo basename($u) . ' : FAIL' . PHP_EOL;
    }
}
