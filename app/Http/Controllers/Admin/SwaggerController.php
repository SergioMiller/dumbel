<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

final class SwaggerController extends Controller
{
    public function index(): View
    {
        return view('admin/swagger');
    }
}
