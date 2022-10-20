@extends('layouts.app')

@section('content')


<div class="text-center mt-5">
    <h1>All Tickets</h1>

    <div class="my-4">
        <form class="" action="" method="get">
            <div class="row mx-auto">
                <div class="col-3">
                    <select class="form-control" name="sort">
                        <option value="customer_name">Customer Name</option>
                        <option value="created_at">Opened Time</option>
                        <option value="updated_at">Last Updated Time</option>
                        <option value="status">Status</option>
                    </select>
                </div>
                <div class="col-3">
                    <select class="form-control" name="sort_dir">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
                <div class="col-4">
                    <input type="text" name="q" value="" class="form-control" placeholder="Reference, customer name or phone number">
                </div>
                <div class="col-2">
                    <button type="submit" name="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="m-5">
        @if($tickets->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Opened Time</th>
                    <th>Handled By</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->customer_name }}</a>
                    </td>
                    <td>{{ $ticket->email }}</td>
                    <td>{{ $ticket->phone }}</td>
                    <td>{{ $ticket->created_at->format('d/M/Y H:i:s') }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
       
        
        @else
        <div class="alert alert-info">
            No tickets are there yet.
        </div>
        @endif

        <div class="mt-4 mx-auto">
            {!! $tickets->links() !!}
        </div>
         
    </div>

 
</div>



@endsection

