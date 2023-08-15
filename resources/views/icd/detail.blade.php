@extends('layouts.main')

@section('header')
<h2>Detail Results:</h2>
@endsection

@section('container')
{{ dd($details) }}
<h5 class="text-center"><p><b>{!! $details['title']['@value'] !!}</b></p></h5>

@if(isset($details['definition']))
<p><b>Definition</b></p>
<p>{!! $details['definition']['@value'] !!}
@if(isset($details['longDefinition']['@value']))
    {!! $details['longDefinition']['@value'] !!}
@endif
</p>
@endif

@if(isset($details['diagnosticCriteria']))
<p><b>Diagnosis Criteria</b></p>
<p>{!! $details['diagnosticCriteria'] !!}</p>
@endif
@if(isset($details['inclusion']))
<p><b>Inclusion</b></p>
<p>{!! $details['inclusion'][0]['label']['@value'] !!}</p>
@endif
@if(isset($details['exclusion']))
<p><b>Exclusion</b></p>
<p>{!! $details['exclusion'][0]['label']['@value'] !!}</p>
@endif
@endsection