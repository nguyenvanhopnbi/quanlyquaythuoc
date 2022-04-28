<?php

namespace App\Http\Controllers\Gate;

use App\Connection\ShopcardItemConnection;
use App\Exports\ShopcardItemReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class ShopCardItemReportController extends Controller
{
    public function create()
    {
        return view('gate.shopcard-report.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'range' => 'required'
        ]);

        if (\Illuminate\Support\Str::of($request->range)->contains('to')) {
            [$start, $end] = explode(' to ', $request->range);
        } else {
            $start = $end = $request->range;
        }

        [
            'imported' => $imported,
            'sold' => $sold,
            'redundant' => $redundant,
            'oldRedundant' => $oldRedundant
        ] = ShopcardItemConnection::getReportData($start, $end);

        $fileName = "shopcard_report_{$start}_to_{$end}_" . now()->format('dmyHis') . '.xlsx';
        (new ShopcardItemReport)
            ->setImported($imported)
            ->setSold($sold)
            ->setRedundant($redundant)
            ->setOldRedundant($oldRedundant)
            ->store($fileName, 'public');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_REPORT, "Tạo Report Shopcard", [$start, $end]));

        return response()->json(['path' => route('shopcard.report.show', $fileName)]);
    }

    public function show($name)
    {
        return Response::download(storage_path('app/public/') . $name)->deleteFileAfterSend(true);
    }
}
