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
            <label for="user_notify_id" class="text-dark">ID Пользователя Админа для уведомления</label>
            <input type="text"  class="form-control" id="user_notify_id" name="user_notify_id"  value="{{ $user_notify_id ?? '' }}">
            <small id="user_notify_HelpBlock" class="form-text text-muted">
                Укажите ID пользователя, которым необходимо отправлять уведомление о новых заказах.
            </small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>  
    </form>
  
</div>
@endsection
