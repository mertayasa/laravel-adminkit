<div class="col-12 col-md-6">
    <div class="row">
        <div class="col-12 pb-3 pb-md-0">
            {!! Form::label('name', 'Name', ['class' => 'mb-1']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 pb-3 pb-md-0">
            {!! Form::label('category_id', 'Category', ['class' => 'mb-1']) !!}
            {!! Form::select('category_id', $product_categories, null, ['class' => 'form-control', 'id' => 'category_id']) !!}
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 pb-3 pb-md-0">
            {!! Form::label('price', 'Price', ['class' => 'mb-1']) !!}
            {!! Form::text('price', null, ['class' => 'form-control number-decimal', 'id' => 'price']) !!}
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 pb-3 pb-md-0">
            {!! Form::label('discount_price', 'Discount Price', ['class' => 'mb-1']) !!}
            {!! Form::text('discount_price', null, ['class' => 'form-control number-decimal', 'id' => 'discount_price']) !!}
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 pb-3 pb-md-0">
            {!! Form::label('quantity', 'Quantity', ['class' => 'mb-1']) !!}
            {!! Form::number('quantity', null, ['class' => 'form-control', 'id' => 'quantity']) !!}
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-12 pb-3 pb-md-0">
            {!! Form::label('image', 'Image', ['class' => 'mb-1']) !!}
            {!! Form::file('image', ['class' => 'form-control', 'id' => 'image']) !!}
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 pb-3 pb-md-0">
            {!! Form::label('description', 'Description', ['class' => 'mb-1']) !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
        </div>
    </div>
</div>