@extends('layouts.operator')
@section('title', 'Отчеты')
@section('content')
    <div class="container">
        <h1 class="text-center mb-3">Отчеты</h1>
{{--        @include('operatorreports.filter')--}}
        @include('reports.filter')
        @if(count($reports)>0)
            <div class="row">
                <div class="col-md-12">
                    @foreach($reports as $report)
                        <div class="reportLoopItem">
                            <span>{{$report->created_at}}</span>
                            <span class="spacer pr-1 pl-1">/</span>
                            <span>{{$report->user->fio}}</span>
                            <span class="spacer pr-1 pl-1">/</span>
                            <span>{{$report->contact->inn}}</span>
                            <span class="spacer pr-1 pl-1">/</span>
                            <span>{{$report->contact->organization}}</span>
                            <span class="spacer pr-1 pl-1">/</span>
                            <span>
                                @if($bank_config_all[$report->bank_id]['statusText'][$report->status])
                                    {{$bank_config_all[$report->bank_id]['statusText'][$report->status]['text']}}
                                @endif
                            </span>
                            <span class="spacer pr-1 pl-1">/</span>
                            <span>{{$report->bank->name}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
