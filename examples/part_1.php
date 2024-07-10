<?php

declare(strict_types=1);

function getSumFromFiles(string $path, string $filename): float
{
    $sum = 0;

    foreach (new FilesystemIterator($path, FilesystemIterator::SKIP_DOTS) as $file) {
        /** @var SplFileInfo $file */
        if ($file->isDir()) {
            $sum += getSumFromFiles($file->getPathname(), $filename);
            continue;
        }

        if ($file->getFilename() !== $filename) {
            continue;
        }

        if (!$file->isReadable()) {
            echo "File {$file->getPathname()} is not readable\n";
            continue;
        }

        $contents = file_get_contents($file->getPathname());

        if (is_numeric($contents)) {
            $sum += (float) $contents;
        }
    }

    return $sum;
}

echo getSumFromFiles(__DIR__ . '/part_1_dir', 'count');
