@extends('layouts.admin')
@section('content')
    @can('events_manage')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.events.create') }}">
                    Add Event
                </a>

                <a class="btn btn-primary" href="{{ route('admin.events.index',['search'=>'finish_event']) }}">
                    Finined Event
                </a>
                <a class="btn btn-info" href="{{ route('admin.events.index',['search'=>'upcoming_event']) }}">
                    Upcoming Event
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            Event Lists
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-event">
                    <thead>
                        <tr>
                            <th>
                                S.N
                            </th>
                            <th>
                                Title
                            </th>
                            <th>
                                Start Date
                            </th>
                            <th>
                                End Date
                            </th>
                            <th>
                                Display
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $key => $event)
                            <tr>
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    {{ $event->title ?? '' }}
                                </td>
                                <td>
                                    {{ $event->start_date ?? '' }}
                                </td>
                                <td>
                                    {{ $event->end_date ?? '' }}
                                </td>
                                <td>
                                    @if ($event->display == 1)
                                        <span class="badge badge-success">Displayed</span>
                                    @else
                                        <span class="badge badge-danger">Non-Displayed</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.events.show', $event->id) }}">
                                        {{ trans('global.view') }}
                                    </a>

                                    <a class="btn btn-xs btn-info" href="{{ route('admin.events.edit', $event->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <button class="deleteEvent btn btn-xs btn-danger" data-id="{{ $event->id }}"
                                        data-token="{{ csrf_token() }}">Delete</button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(".deleteEvent").click(function() {
            var id = $(this).data("id");
            // alert(id);
            var token = $(this).data("token");
            confirm('Are you sure you want to delete this item')
            $.ajax({
                url: "{{ route('admin.event.delete') }}",
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function(response) {
                    alert(response['success']);
                }

            });

        });
    </script>
@endsection
