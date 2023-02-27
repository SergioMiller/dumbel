<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\QrCodeFilter;
use App\Http\Controllers\Controller;
use App\Tables\QrCodeTable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class QrCodeController extends Controller
{
    public function index(Request $request): View
    {
        $table = (new QrCodeTable($request->query()))
            ->setFilter(QrCodeFilter::class)
            ->setTitle('Qr коди');

        return view('admin.table', [
            'table' => $table,
            'paginator' => $table->paginator(),
            'attributes' => $table->attributes()
        ]);
    }
}
