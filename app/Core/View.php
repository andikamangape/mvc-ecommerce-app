<?php
namespace App\Core;

class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP); // biarkan variabel view memakai nama kunci array
        $viewFile = __DIR__ . "/../Views/{$view}.php";

        if (!file_exists($viewFile)) {
            throw new \Exception("View tidak ditemukan: $viewFile");
        }

        // tangkap output view ke $content, lalu render layout
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        // layout utama
        require __DIR__ . "/../Views/layouts/main.php";
    }
}
