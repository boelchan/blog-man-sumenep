<?php

namespace App\DataTables;

use App\Models\Siswa;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SiswaDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = datatables()->eloquent($query)->addIndexColumn();

        if (! request()->search['value']) {
            $dataTable->filter(function ($query) {
                if ($nama = request()->nama) {
                    $query->where('nama', 'like', '%'.$nama.'%');
                }
                if ($kode = request()->kode) {
                    $query->where('kode', 'like', '%'.$kode.'%');
                }
                if ($kelas = request()->kelas) {
                    $query->where('kelas', 'like', '%'.$kelas.'%');
                }
            });
        }

        return $dataTable
            ->editColumn('action', function ($query) {
                return view('components.button.show', ['action' => route('siswa.show', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.edit', ['action' => route('siswa.edit', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.destroy', ['action' => route('siswa.destroy', [$query->id, 'uuid' => $query->uuid]), 'label' => $query->nama, 'target' => 'siswa-table']);
            })
            ->rawColumns(['action']);
    }

    public function query(Siswa $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('siswa-table')
            ->columns($this->getColumns())
            ->orderBy(1, 'asc')
            ->ajax([
                'data' => 'function(d) { 
                    d.nama = $("#nama").val();
                    d.kode = $("#kode").val();
                }',
            ])
            ->drawCallback("function( settings ) { $(document).find('[data-toggle=\"tooltip\"]').tooltip(); }")
            ->buttons('create')
            ->dom('<"d-flex justify-content-between p-2 pt-3" row <"col-lg-6 d-flex"f> <"col-lg-6 d-flex justify-content-end px-2"B> >t <"d-flex justify-content-between m-2 row" <"col-md-6 d-flex justify-content-center justify-content-md-start"li> <"col-md-6 px-0"p> >');
    }

    protected function getColumns()
    {
        return [
            Column::computed('id')->title('no')->data('DT_RowIndex'),
            Column::make('kode'),
            Column::make('nama'),
            Column::make('kelas'),
            Column::computed('action')->addClass('text-center'),
        ];
    }
}
