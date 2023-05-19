<?php

namespace App\DataTables;

use App\Enum\CategoryEnum;
use App\Models\Post;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PromoDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = datatables()->eloquent($query)->addIndexColumn();

        if (! request()->search['value']) {
            $dataTable->filter(function ($query) {
                if ($judul = request()->judul) {
                    $query->where('judul', 'like', '%'.$judul.'%');
                }
                switch (request()->status) {
                    case 'publish':
                        $query->where('publish', 'ya');
                        break;
                    case 'pending':
                        $query->where('publish', 'tidak');
                        break;
                    case 'beranda':
                        $query->where('tampil_banner', 'ya');
                        break;
                }
            });
        }

        return $dataTable->editColumn('published_at', function ($query) {
            if ($query->publish == 'ya') {
                $status = ' <span class="badge bg-success-lt mb-1">Publish '.Carbon::parse($query->published_at)->diffForHumans().'</span> ';
                if ($query->tampil_banner == 'ya') {
                    $status .= '<br><span class="badge bg-primary-lt">Tampil di Banner</span> ';
                }

                return $status;
            } else {
                return '<span class="badge bg-secondary-lt">Pending</span>';
            }
        })
            ->editColumn('action', function ($query) {
                return view('components.button.show', ['action' => route('post.promo.show', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.edit', ['action' => route('post.promo.edit', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.destroy', ['action' => route('post.promo.destroy', [$query->id, 'uuid' => $query->uuid]), 'label' => $query->judul, 'target' => 'promo-table']);
            })
            ->rawColumns(['published_at', 'action'])
            ->orderColumn('published_at', 'updated_at $1');
    }

    public function query(Post $model)
    {
        return $model->newQuery()->where('kategori_id', CategoryEnum::PROMO);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('promo-table')
            ->columns($this->getColumns())
            ->orderBy(2, 'desc')
            ->ajax([
                'data' => 'function(d) { 
                    d.judul = $("#judul").val();
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
            Column::make('judul'),
            Column::make('published_at')->title('status'),
            Column::computed('action')->addClass('text-center'),
        ];
    }
}
