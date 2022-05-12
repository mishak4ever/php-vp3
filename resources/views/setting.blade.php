@extends('brackets/admin-ui::admin.layout.default')
<!-- Bootstrap core CSS -->
<link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

<!-- Optional theme -->
<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap-theme.min.css') }}">
@section('body')

<div class="container">
    @if (Session::has('status'))
    <div class="alert alert-info">
        <span>{{Session::get('status')}}</span>
    </div>
    @endif
    <form action="{{ route('settings.setting.store') }}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="default_user_email" class="text-dark">Емайл для уведомления</label>
            <input type="text"  class="form-control" id="default_user_email" name="default_user_email"  value="{{ $default_user_email ?? '' }}">
            <small id="user_notify_HelpBlock" class="form-text text-muted">
                Укажите ID пользователя, которым необходимо отправлять уведомление о новых заказах.
            </small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>  
    </form>
  
</div>
@endsection
