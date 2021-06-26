@extends('authCustom.baseLogin')

@section('auth')
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="#" class="logo pull-center">
					<img src="{{ asset('images/sary.png') }}" height="350" alt="">
				</a>
				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i>Authentification</h2>
					</div>
					<div class="panel-body">
						<form action="{{ route('login') }}" method="POST">
							@csrf
							<div class="form-group mb-lg">
								<label>{{ __('E-Mail Address') }}</label>
								<div class="input-group input-group-icon">
									<input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' has-error' : '' }} input-lg" value="{{ old('email') }}" required autofocus/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											@
										</span>
									</span>
								</div>
								@if ($errors->has('email'))
									<label for="email" class="error">{{ $errors->first('email') }}</label>
                                @endif
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control{{ $errors->has('password') ? 'has-error' : '' }} input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
								@if ($errors->has('password'))
									<label for="password" class="error">{{ $errors->first('password') }}</label>
                                @endif
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}/>
										<label for="remember">Se souvenir de moi</label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" class="btn btn-primary hidden-xs">Se connecter</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Se connecter</button>
								</div>
							</div>

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2020. Urgence</p>
			</div>
		</section>
		<!-- end: page -->
@endsection
