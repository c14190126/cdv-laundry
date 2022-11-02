<?php

namespace App\Http\Livewire;

use App\Models\detail_transaksi;
use App\Models\transaksi;
use App\Models\layanan;
use Livewire\Component;

class Detail extends Component
{
    public $selectedClass=null;
    public $sections=null;
    public $test=null;
    public function render()
    {
        return view('livewire.detail',[
            'transaksi' => transaksi::all(),
            "layanan" => layanan::all(),
            'detail'=>detail_transaksi::all(),
        ]);
    }

    public function updatedSelectedClass($layanan_id)
    {
        $this->sections=layanan::where('id',$layanan_id)->first();
    }
}
