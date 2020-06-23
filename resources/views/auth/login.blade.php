@extends('auth.template.main_login')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <img src="{{asset('img/logos/logo_tonic_life.png')}}" class="img-fluid">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login_auth') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12 col-sm-12 col-md-6 mx-auto">
                                    <input id="email"
                                           type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           autocomplete="off"
                                           autofocus
                                           placeholder="Correo electrónico">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12 col-sm-12 col-md-6 mx-auto">
                                    <input id="password"
                                           type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password"
                                           required
                                           autocomplete="off"
                                           placeholder="Contraseña">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12 col-sm-12 col-md-6 mx-auto text-right">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            Recordar mi sesión
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-12 col-sm-12 col-md-6 mx-auto">

                                    <button type="submit" class="btn btn-primary">
                                        Iniciar sesión
                                    </button>

                                    <a class="btn btn-link" href="#">
                                        ¿Has olvidado tu contraseña?
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
