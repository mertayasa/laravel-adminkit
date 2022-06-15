<div class="col-12 col-md-6">
    <div class="row">
        <div class="col-12 pb-3 pb-md-0">
            {!! Form::label('name', 'Name', ['class' => 'mb-1']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-12 pb-3 pb-md-0">
            {!! Form::label('name', 'Image', ['class' => 'mb-1']) !!}
            {!! Form::file('image', ['class' => 'form-control']) !!}
        </div>
    </div>
</div>