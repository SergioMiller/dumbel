<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use Illuminate\Contracts\View\View;

class QrCodeController extends Controller
{
    public function index(): View
    {
        return view('admin.qr-code.index', [
            'qrCodes' => QrCode::query()->with('user')->orderByDesc('id')->paginate()
        ]);
    }
}
