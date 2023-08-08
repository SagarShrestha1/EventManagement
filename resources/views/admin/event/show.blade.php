@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
             Show Event
        </div>

        <div class="card-body">
            <div class="mb-2">
                <table class="table table-bordered table-striped">
                    <tbody>

                        <tr>
                            <th>
                                Title
                            </th>
                            <td>
                                {{ $event->title ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Start Date
                            </th>
                            <td>
                                {{ $event->start_date ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                End Date
                            </th>
                            <td>
                                {{ $event->end_date ?? '' }}
                            </td>
                        </tr>
                       
                        <tr>
                            <th>
                                Display
                            </th>
                            <td>
                                 @if ($event->display==1)
                                        <span class="badge badge-success">Displayed</span>
                                        @else
                                        <span class="badge badge-danger">Non-Displayed</span>

                                    @endif
                            </td>
                        </tr>
                         <tr>
                            <th>
                                Description
                            </th>
                            <td>
                                <p>{{ $event->description ?? '' }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>


        </div>
    </div>
@endsection
