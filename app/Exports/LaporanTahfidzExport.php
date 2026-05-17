<?php

namespace App\Exports;

use App\Models\Setoran;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanTahfidzExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithStyles
{
    public function collection()
    {
        return Setoran::with(['user', 'penyimak'])
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Santri',
            'Tanggal',
            'Juz',
            'Surat Awal',
            'Ayat Awal',
            'Surat Akhir',
            'Ayat Akhir',
            'Status',
            'Nilai',
            'Catatan',
        ];
    }

    public function map($setoran): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $setoran->user->name ?? '-',

            $setoran->tanggal
                ? Carbon::parse($setoran->tanggal)->format('d-m-Y')
                : '-',

            $setoran->juz ?? '-',
            $setoran->surat_mulai ?? '-',
            $setoran->ayat_mulai ?? '-',
            $setoran->surat_selesai ?? '-',
            $setoran->ayat_selesai ?? '-',

            ucfirst($setoran->status ?? '-'),
            ucfirst($setoran->nilai ?? '-'),
            $setoran->catatan ?? '-',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }
}