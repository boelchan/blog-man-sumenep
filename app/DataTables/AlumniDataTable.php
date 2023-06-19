<?php

namespace App\DataTables;

use App\Models\Alumni;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AlumniDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = datatables()->eloquent($query)->addIndexColumn();

        if (! request()->search['value']) {
            $dataTable->filter(function ($query) {
                if ($tahun_lulus = request()->tahun_lulus) {
                    $query->where('tahun_lulus', $tahun_lulus);
                }
                if ($jurusan = request()->jurusan) {
                    $query->where('jurusan', $jurusan);
                }
                if ($nama = request()->nama) {
                    $query->where('nama', 'like', '%'.$nama.'%');
                }
                if ($approved = request()->approved) {
                    $query->where('approved', $approved);
                }
            });
        }

        return $dataTable
            ->editColumn('approved', function ($query) {
                return $query->approved == 'yes' ? 'Ya' : 'Tidak';
            })
            ->editColumn('action', function ($query) {
                return view('components.button.show', ['action' => route('alumni.show', $query->id)]).
                    view('components.button.edit', ['action' => route('alumni.edit', $query->id)]).
                    view('components.button.destroy', ['action' => route('alumni.destroy', $query->id), 'label' => $query->nama, 'target' => 'alumni-table']);
            })
            ->rawColumns(['publish', 'action']);
    }

    public function query(Alumni $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('alumni-table')
            ->columns($this->getColumns())
            ->orderBy(1, 'asc')
            ->ajax([
                'data' => 'function(d) { 
                    d.tahun_lulus = $("#tahun_lulus").val();
                    d.jurusan = $("#jurusan").val();
                    d.nama = $("#nama").val();
                    d.approved = $("#approved").val();
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
            Column::make('tahun_lulus'),
            Column::make('jurusan'),
            Column::make('nama'),
            Column::make('approved'),
            Column::computed('action')->addClass('text-center'),
        ];
    }
}
