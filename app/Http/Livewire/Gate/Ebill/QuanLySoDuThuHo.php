<?php

namespace App\Http\Livewire\Gate\Ebill;

use Livewire\Component;
use App\Connection\EbillConnection;


class QuanLySoDuThuHo extends Component
{
    public function render()
    {
        $this->getList();
        return view('livewire.gate.ebill.quan-ly-so-du-thu-ho', [
            'listDanhSach' => $this->listDanhSach
        ]);
    }

    protected $listDanhSach;

    public function getList(){
        $params = [];
        $data = EbillConnection::listDanhSachSoDuThuHo($params);
        if(isset($data->data)){
            $this->listDanhSach = $data->data;
        }
    }
}
