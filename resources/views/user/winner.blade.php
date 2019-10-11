@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::user() and Auth::user()->email == 'admin@gmail.com')
    <div class="row justify-content-center">
        <div class="col-md-8">            
            <table class="table">
                <h1>Winner Lists</h1>
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
                  <th class="text-danger">{{ $i }}</th>
                  <td class="text-danger">{{ $user->name }}</td>
                  <td class="text-danger">{{ $user->email }}</td>
                  <td class="text-danger">{{ $user->phone }}</td>
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
          
        </div>
    </div>
    @endif
</div>
@endsection
