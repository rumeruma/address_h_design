@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div style="margin-top: 8rem" class="columns is-centered">
        <div class="column is-half">
            <div class="panel">
                <h4 class="panel-heading has-text-centered">Login</h4>
                <div class="panel-block">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="control has-icons-left">
                        <form method="POST" action="{{ route('admin.login') }}">
                        {{ csrf_field() }}
                            <div class="field">
                                <label class="label">Username</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input id="email" class="input" type="email" name="email" placeholder="name@domain.ext" value="{{ old('email') }}"  required autofocus>
                                    <span class="icon is-small is-left">
                                    <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                @if ($errors->has('email'))
                                <br>
                                    <div class="message is-danger">
                                        <p class="message-body">
                                            {{ $errors->first('email') }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <div class="field">
                                <label class="label">Password</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input id="password" class="input" type="password" name="password" placeholder="Password" value="{{ old('email') }}" required >
                                    <span class="icon is-small is-left">
                                    <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                @if ($errors->has('password'))
                                <br>
                                    <div class="message is-danger">
                                        <p class="message-body">
                                            {{ $errors->first('password') }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label class="checkbox">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Remember
                                    </label>
                                </div>
                            </div>
                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-link">Submit</button>
                                </div>
                                <div class="control">
                                    <a href="{{ route('admin.password.request') }}" class="is-link">Forgot Password</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
