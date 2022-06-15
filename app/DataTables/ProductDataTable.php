<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
            ->editColumn('image', function(Product $product){
                return '<img src="'.$product->getImage().'" width="50px" height="50px" style="object-fit:cover">';
            })
            ->addColumn('action', 'product.datatable-action')
            ->rawColumns(['image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProductDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->with('category')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('productDatatable')
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
                'orderable' => false
            ],
            [
                'data' => 'updated_at',
                'visible' => false,
                'searchable' => true
            ],
            [
                'name' => 'name',
                'data' => 'name',
                'title' => 'Product',
            ],
            [
                'name' => 'category.name',
                'data' => 'category.name',
                'title' => 'Category',
            ],
            [
                'name' => 'price',
                'data' => 'price',
                'title' => 'Price',
            ],
            [
                'name' => 'discount_price',
                'data' => 'discount_price',
                'title' => 'Discount Price',
            ],
            [
                'name' => 'quantity',
                'data' => 'quantity',
                'title' => 'Quantity',
            ],
            [
                'name' => 'description',
                'data' => 'description',
                'title' => 'Description',
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
        return 'Product_' . date('YmdHis');
    }
}
