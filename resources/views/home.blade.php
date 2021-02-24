@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('danger') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                    @if (Auth::user()->numberVerify == 1)

                      <div class="card-body">
                        <h3> {{ __('✔ Phone Number is verified!') }}</h3>
                      </div>
                    @endif

                </div>
                @if (Auth::user()->role == 1)
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @php
                      $users = DB::table('users')->get();
                    @endphp

                    {{ __('users list') }}
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">First</th>
                          <th scope="col">Last</th>
                          <th scope="col">E-Mail</th>
                          <th scope="col">Phone Number</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $value)
                        <tr>
                          <th scope="row">{{ $loop->index+1 }}</th>
                          <td>{{ $value->fname }}</td>
                          <td>{{ $value->lname }}</td>
                          <td>{{ $value->email }}</td>
                          <td>{{ $value->phoneNumber }}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                </div>
                @endif

              @empty (Auth::user()->numberVerify)
                  <div class="card-body">
                    <h3> {{ __('Your phone number:') }}</h3>
                    <p style="font-size:25px">{{ Auth::user()->phoneNumber }}</p>
                    <a href="{!! route('otpSend') !!}" class="btn btn-success">Send Code</a>
                  </div>
                @endempty
                @if (Auth::user()->numberVerify > 1)

                  <div class="card-body">
                    <h3> {{ __('Enter your verification code:') }}</h3>
                    <form class="" action="{!! route('phoneNumber') !!}" method="post">
                      @csrf
                      <input type="text" name="code" class="form-control"><br>
                      <button type="submit" class="btn btn-success">Verify</button>
                    </form>
                  </div>
                @endif




            </div>
        </div>
    </div>
</div>
@endsection
