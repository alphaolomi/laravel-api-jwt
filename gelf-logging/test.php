<?php

/*
 * This file is part of the php-gelf package.
 *
 * (c) Benjamin Zikarsky <http://benjamin-zikarsky.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


function ld($data)
{
    echo date('Y m d h:i:s') . ': ' .  $data . "\n\n";
}


ld('start');
ld('importing');
require_once __DIR__ . '/../vendor/autoload.php';
ld('end importing');
ld('make logger');
// When creating a logger without any options, it logs automatically to localhost:12201 via UDP
// For a move advanced configuration, check out the advanced.php example
$logger = new Gelf\Logger();
ld('end logger');

ld('log stuff');
// Log!
$logger->alert("Foobaz!");

ld('end log');
