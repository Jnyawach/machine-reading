<?php

namespace App\Exports;

use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportAll implements FromView
{

    public $view,$data='';
    public function __construct($theview,$data)
    {
        $this->view=$theview;
        $this->data=$data;
    }

    public function view():View
    {
        //
        return view($this->view, $this->data);
    }
}
