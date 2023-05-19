<?php

namespace App\DataTables;

use App\Models\Room;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RuanganDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = datatables()->eloquent($query)->addIndexColumn();

        if (! request()->search['value']) {
            $dataTable->filter(function ($query) {
                if ($judul = request()->judul) {
                    $query->where('nama', 'like', '%'.$judul.'%');
                }
                switch (request()->status) {
                    case 'publish':
                        $query->where('publish', 'ya');
                        break;
                    case 'pending':
                        $query->where('publish', 'tidak');
                        break;
                }
            });
        }

        return $dataTable->editColumn('publish', function ($query) {
            if ($query->publish == 'ya') {
                return ' <span class="badge bg-success-lt mb-1">Publish</span> ';
            } else {
                return '<span class="badge bg-secondary-lt">Pending</span>';
            }
        })
            ->editColumn('action', function ($query) {
                return view('components.button.show', ['action' => route('post.ruangan.show', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.edit', ['action' => route('post.ruangan.edit', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.destroy', ['action' => route('post.ruangan.destroy', [$query->id, 'uuid' => $query->uuid]), 'label' => $query->nama, 'target' => 'ruangan-table']);
            })
            ->rawColumns(['publish', 'action']);
    }

    public function query(Room $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('ruangan-table')
            ->columns($this->getColumns())
            ->orderBy(1, 'desc')
            ->ajax([
                'data' => 'function(d) { 
                    d.nama = $("#nama").val();
                    d.status = $("#status").val();
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
            Column::make('nama'),
            Column::make('publish')->title('status'),
            Column::computed('action')->addClass('text-center'),
        ];
    }
}
