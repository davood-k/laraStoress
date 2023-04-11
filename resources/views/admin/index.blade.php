@component('admin.layouts.content' , ['title' => 'مدير محترم خوش آمديد.'])

    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href=" {{ route('admin.users.index') }} ">ليست كاربران سايت</a></li>
        <li class="breadcrumb-item active"><a href=" {{ route('admin.') }} ">خانه</a></li>
    @endslot

    <h2>admin panel</h2>

@endcomponent