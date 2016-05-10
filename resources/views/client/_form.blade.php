{!!SemanticForm::date('data')->label('Data de Início') !!}

{!! SemanticForm::text('descricao')->label('Descrição') !!}

{!! SemanticForm::select('tipoCobranca', $opcoes)->label('Tipo Movimento') !!}

{!! SemanticForm::selectRange('tipoPagto', 1,  360)->label('Forma de Pagamento') !!}

{!! SemanticForm::text('total')->label('Total') !!}

