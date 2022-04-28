<?php

namespace App\Http\Livewire\Gate\Lottery;

use Livewire\Component;
use App\Connection\LotteryConnection;

class Provider extends Component
{
    public function render()
    {
        $this->getListProviderLottery();
        return view('livewire.gate.lottery.provider', [
            'listProviderLottery' => $this->listProviderLottery
        ]);
    }

    protected $listProviderLottery;

    public function getListProviderLottery(){
        $params = [];
        $data = LotteryConnection::getListProviderLottery($params);

        if(isset($data->providers)){
            $this->listProviderLottery = $data->providers;
            // dd($this->listProviderLottery);
        }
    }
}
