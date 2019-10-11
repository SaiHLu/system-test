@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::user() and Auth::user()->email == 'admin@gmail.com')
            
            <form action="/apply" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary" name="random" style="position: absolute; right: 12px;">Start Lottery</button>
            </form>

            <table class="table">
                <h1>Apply Lists</h1>
                <thead>
                <tr>
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                </tr>
            </thead>
            <tbody>
            @php 
                $i = 1; 
            @endphp

            @foreach ($users as $user)
            <tr>
                <th>{{ $i }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
            </tr>

            @php 
                $i++; 
            @endphp

            @endforeach
                
            </tbody>
        </table>

        <div class="row">
            <div class="col-12 offset-4 mt-5">
                {{ $users->links() }}
            </div>
        </div>
            @else
            <form action="/users/{{Auth::user()->id}}/apply" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary btn-lg btn-block">Apply</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
