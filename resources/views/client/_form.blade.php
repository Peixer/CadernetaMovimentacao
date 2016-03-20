<div class="form-group">
    {!! Form::label('data','Data de Início:') !!}
    {!! Form::date('data', null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Description','Descrição:') !!}
    {!! Form::text('descricao', null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('tipoCobranca','Tipo Movimento:') !!}
    {!! Form::select('tipoCobranca', $opcoes, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('tipoPagto','Forma de Pagamento:') !!}
    {!! Form::number('tipoPagto', null, ['class'=>'form-control', 'min' => 1, 'max'=> 360]) !!}
</div>

<div class="form-group">
    {!! Form::label('total','Total:') !!}
    {!! Form::number('total', null,['class'=>'form-control']) !!}
</div>

