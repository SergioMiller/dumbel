<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;

final class SwaggerController extends Controller
{
    public function index(): View
    {
        return view('admin.swagger');
    }

    public function openapi(): bool|string
    {
        return file_get_contents(App::storagePath() . '/app/openapi.yaml');
    }
}
