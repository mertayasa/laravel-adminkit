<?php

namespace App\DataTables;

use App\Models\ProductCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductCategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('image', function (ProductCategory $productCategory) {
                return '<img src="' . $productCategory->getImage() . '" width="50px" height="50px" style="object-fit:cover">';
            })
            ->addColumn('action', 'product-category.datatable-action')
            ->rawColumns(['image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProductCategoryDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductCategory $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('productCategoryDatatable')
                    ->columns($this->getColumns())
                    ->addAction(['title' => 'Action', 'width' => '150px', 'printable' => false, 'responsivePriority' => '100', 'id' => 'actionColumn'])
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1, 'DESC');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'data' => 'image',
                'title' => 'Image',
                'searchable' => false,
            ],
            [
                'data' => 'updated_at',
                'visible' => false,
                'searchable' => true
            ],
            [
                'data' => 'name',
                'title' => 'Category',
                'searchable' => true
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ProductCategory_' . date('YmdHis');
    }
}
