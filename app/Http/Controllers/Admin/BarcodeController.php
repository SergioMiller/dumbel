<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\BarcodeFilter;
use App\Http\Controllers\Controller;
use App\Tables\BarcodeTable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class BarcodeController extends Controller
{
    public function index(Request $request): View
    {
        $table = (new BarcodeTable($request->query()))
            ->setFilter(BarcodeFilter::class)
            ->setTitle('Штрих коди');

        return view('admin.table', [
            'table' => $table,
            'paginator' => $table->paginator(),
            'attributes' => $table->attributes()
        ]);
    }
}
