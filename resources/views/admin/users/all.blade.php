@component('admin.layouts.content' , ['title' => 'پنل مديريت'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">ليست كاربران سايت</li>
        <li class="breadcrumb-item"><a href="">خانه</a></li>
    @endslot
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">کاربران</h3>

                    <div class="row card-tools d-flex">

                        <form action="">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request('search') }}">

                                <div class="input-group-append ">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        <div class="btn btn-group-sm">
                            @can('create-user')
                                <a class="btn btn-info" href="{{ route('admin.users.create') }}">ایجاد کاربر جدید</a>
                            @endcan

                            @can('show-staff-users')
                            <a class="btn btn-warning" href="{{ request()->fullUrlWithQuery(['admin' => 1]) }}">کاربران مدیر</a>
                            @endcan

                        </div>
                    </div>
                    
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>آيدي كاربر</th>
                            <th>نام كابر</th>
                            <th>وضعيت ايميل كاربر</th>
                            <th>اقدامات</th>
                            <th>ايميل كابر</th>
                            <th>اقدامات</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                @if($user->is_superuser)
                                    <td>كاربر ويژه</td>
                                @elseif($user->is_staff)
                                    <td>كارمند شركت</td>
                                @else
                                    <td>كارمند عادي</td>
                                @endif
                                <td>{{ $user->is_superuser }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="d-flex">

                                   @can('delete-user')
                                   <form action=" {{ route('admin.users.destroy' , ['user' => $user->id ])}} " method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger ml-2" type="submit">
                                            حذف
                                        </button>
                                    </form>
                                   @endcan

                                   @can('edit-user')
                                    <a class="btn btn-sm btn-primary ml-2" href="{{ route('admin.users.edit' , ['user' => $user->id ]) }}">ويرايش</a>
                                    @endcan

                                   @can('staff-user-permissions')
                                        @if($user->isSuperUser())
                                            <a class="btn btn-sm btn-warning" href="{{ route('admin.users.permissions' , $user->id) }}">دسترسی</a>
                                        @endif
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $users->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent