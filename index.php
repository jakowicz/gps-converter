<?php

require 'vendor/autoload.php';

$converter = new SimonJakowicz\Gps\Converters\DMSCToSignedConverter(
    [41, 25, 01],
    'N',
    [120, 58, 57],
    'W'
);

echo $converter->getCoordinates();
