<?php

declare(strict_types=1);

// Lendo o arquivo (garantindo que não pegamos linhas vazias)
$rotationsSequence = file(__DIR__ . '/rotation_sequence.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$dial = 50;
$password = 0;

foreach ($rotationsSequence as $rotationLine) {
    $rotationLine = trim($rotationLine);
    if ($rotationLine === '') continue;

    // Pega a direção (L ou R) e o valor numérico
    $direction = $rotationLine[0];
    $steps = (int) substr($rotationLine, 1);

    // Simulamos cada "clique" do disco para não perder nenhuma passagem pelo zero
    for ($i = 0; $i < $steps; $i++) {
        if ($direction === 'R') {
            $dial++;
        } else {
            $dial--;
        }

        // Normalizamos o dial para o intervalo 0-99
        // O PHP trata % de forma diferente com negativos, então somamos 100
        $dial = ($dial % 100 + 100) % 100;

        // Se o ponteiro está no zero agora, contamos
        if ($dial === 0) {
            $password++;
        }
    }
}

echo 'password: ' . $password . PHP_EOL;