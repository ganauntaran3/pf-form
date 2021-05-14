<?php

$c = mysqli_connect(
    'localhost',
    'root',
    '',
    'pf'
);

if (!$c) throw new Error("Can't estabilish connection!");