<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Connection\ManageBalanceConnection;

class ManageBalance extends Component
{
    public function render()
    {
        $this->getList();
        return view('livewire.manage-balance');
    }

    public $listBalance;
    public function getList(){
        $params = [];

        $result = ManageBalanceConnection::getList($params);
        if(isset($result->data)){
            $this->listBalance = $result->data;
            $this->listBalance = (array)$this->listBalance;

        }
    }
}
