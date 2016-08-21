@extends('layouts.base.web')

@section('content')
<table-container
:header="['No', 'Hp']"
:class-name="['table-bordered']"
key-name="no"
data-src="{{ resolveRoute('app.ajax') }}"
:data-map="[
	{key: 'Hp', value: 'hp'},
	{key: 'No', value: 'no'}
]"
:data-link="[
	{text: 'Detail', link: 'test/{key}', className: 'btn btn-success btn-sm'},
	{text: 'Edit', link: 'test/{key}', className: 'btn btn-warning btn-sm'}
]"></table-container>
@endsection