<?php

namespace App\Exports;

use App\Models\Invocie;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvocieExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Invocie::select('id', 'invoice_number', 'invoice_Date', 'due_Date', 'product', 'section_id', 'Amount_collection', 'Amount_Commission', 'Discount', 'Rate_Vat', 'Total', 'status', 'note_ar', 'note_en')->get();
    }
}
