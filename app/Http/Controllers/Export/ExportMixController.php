<?php

namespace App\Http\Controllers\Export;

use App\Enums\LogCategoryEnum;
use App\Events\ActivityOccur;
use App\Services\Export\ExportMixService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExportMixController extends Controller
{
    protected $validator;
    protected $request;
    protected $exportMixService;

    public function __construct(ExportMixService $exportMixService,
                                Request $request)
    {
        $this->request = $request;
        $this->exportMixService = $exportMixService;
    }

    public function exportMix(Request $request)
    {
        $filter = [
            'partner_code' => $request->partner_code,
            'fd' => $request->fd ? Carbon::createFromFormat('m/d/Y', $request->fd)->startOfDay()->format('m/d/Y') : now()->subDays(1)->format('m/d/Y'),
            'td' => $request->td ? Carbon::createFromFormat('m/d/Y', $request->td)->endOfDay()->format('m/d/Y') : now()->format('m/d/Y'),
        ];
        if (!$request->request_type) {
            $data = [
                'filter' => $filter,
            ];
            return view('exports.export_mix', $data);
        }
        $filter['startTime'] = Carbon::createFromFormat('m/d/Y', $filter['fd'])->format('Y-m-d');
        $filter['endTime'] = Carbon::createFromFormat('m/d/Y', $filter['td'])->format('Y-m-d');

        $query = [
            'query' => $filter,
            'pagination' => [
                'perpage' => 1000
            ],
        ];

        $path1 = $this->exportMixService->exportEbillTransaction($query);
        $path2 = $this->exportMixService->exportGateTransaction($query);
        $path3 = $this->exportMixService->exportTransferMoneyTransaction($query);
        $path4 = $this->exportMixService->exportShopCardTransaction($query);
        $path5 = $this->exportMixService->exportTopupTransaction($query);


        $files = [$path1, $path2, $path3, $path4, $path5];
        $zipFilename = 'Export_Transaction_' . now()->format('d-m-Y_H-i-s');
        $zipname = $zipFilename . '.zip';
        $zipFullPath = public_path('file/public/export/' . $zipname);
        $zip = new \ZipArchive();
        $zip->open($zipFullPath, \ZipArchive::CREATE);
        foreach ($files as $file) {
            $filename = explode('/', $file);
            $filename = $zipFilename . '/' . end($filename);
            $zip->addFile($file, $filename);
        }
        $zip->close();
        event(new ActivityOccur(LogCategoryEnum::EXPORT_MIX, "Xuất file danh sách đối soát tổng hợp", compact('filter')));
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipFullPath));
        readfile($zipFullPath);
    }


}
