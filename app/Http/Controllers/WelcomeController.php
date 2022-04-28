<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use App\Models\ActivityLog;
use App\Models\group_permission;
use App\Models\Permission;
use App\Connection\DoubleCheckConnection;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{


    public function __construct()
    {


    }

    public function pagination(){

    }


    public function permission(){
        $Grouppermission = group_permission::with('permissions')->get();

        $permission = Permission::with('group_permission')->get();

        return view('test', compact('permission'));
    }

    public function getListActivityLog(ActivityLog $log){
        $data = $log->paginate(5);
        // dd($data);
    }

    // Pagination Collection

    public static function testPagination(ActivityLog $log, Request $request){
        $collection = collect([
            [
                'id' => 1,
                'name' => 'sam',
            ],
            [
                'id' => 2,
                'name' => 'john',
            ],
            [
                'id' => 3,
                'name' => 'crazy',
            ],
            [
                'id' => 4,
                'name' => 'sam',
            ],
            [
                'id' => 5,
                'name' => 'john',
            ],
            [
                'id' => 6,
                'name' => 'crazy',
            ],
            [
                'id' => 7,
                'name' => 'sam',
            ],
            [
                'id' => 8,
                'name' => 'john',
            ],
            [
                'id' => 9,
                'name' => 'crazy',
            ],
        ]);
        // dd(\Illuminate\Http\JsonResponse::create(self::paginate($collection, 3)));

        // $collectionData =  \Illuminate\Http\JsonResponse::create(self::paginate($collection, 3));

        $params = [];

        $params['pagination']['limit'] = 10;
        $params['pagination']['page'] = 10;

        // $data = DoubleCheckConnection::getList($params);

        // $collectionData = self::paginate(collect($data->data), 10);

        $collectionData = self::paginate(collect(DoubleCheckConnection::getList($params)->data), 10);

        return view('test', ['datas' => $collectionData]);
    }

    public static function paginate(Collection $collection, $pageSize){
        // $page = Paginator::resolveCurrentPage('page');
        $page = 1;
        $total = $collection->count();

        return self::paginator($collection->forPage($page, $pageSize), $total, $pageSize, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }

    protected static function paginator($items, $total, $perPage, $currentPage, $options){
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact('items', 'total', 'perPage', 'currentPage', 'options'));
    }

    /**
    * ======================
    * Method:: INDEX
    * ======================
    */

    public function index()
    {
        return view('welcome');
    }

    public function sendEmail(){
        // $user = $request->user();
        $details = [
            'title' => 'This is title mail',
            'body' => 'This is tessting body mail'
        ];

        Mail::to("hopnv76012@gmail.com")->send(new TestMail($details));

        return "Email Sent";
    }
}
