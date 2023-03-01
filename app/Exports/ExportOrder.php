<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportOrder implements FromCollection, WithHeadings,WithStyles, WithEvents
{

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true],'color' => ['#CCCCCC' => true]],
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $order = Order::select([
            'waybill_id',
            'order_id',
            'full_name',
            'address',
            'district',
            'phone',
            'cod',
            'description',
            'actual_value',
        ]);
        if ($this->request->has('type') && $this->request->get('type') != '') {
            $order->whereDate('created_at',now());
        }

        if ($this->request->has('stage') && $this->request->get('stage') != '' && $this->request->get('stage') != '0') {
            $order->where('stage',$this->request->get('stage'));
        }

        if ($this->request->has('product') && $this->request->get('product') != '' && $this->request->get('product') != 'select') {
            $order->where('description',$this->request->get('product'));
        }

        if ($this->request->has('from_date') && $this->request->get('from_date') != '' && $this->request->has('to_date') && $this->request->get('to_date') != '') {
            if ($this->request->get('from_date') == $this->request->get('to_date')) {
                $order->whereDate('created_at', '=', $this->request->get('from_date'));
            } else {
                $order->whereDate('created_at', '>=', $this->request->get('from_date'));
                $order->whereDate('created_at', '<=', $this->request->get('to_date'));
            }
        }


        return $order->get();
    }


    public function headings(): array
    {
        return ['Waybill Id', 'Order Number' , 'Receiver Name','Delivery Address','District Name', 'Receiver Phone', 'COD', 'Description', 'Actual Value'];
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(10);
                $event->sheet->getDelegate()->getStyle('A1:I1')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('9999FF');

            },
        ];
    }
}
