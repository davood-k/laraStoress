@component('admin.layouts.content' , ['title' => 'پنل مديريت'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">ليست محصولات سايت</li>
        <li class="breadcrumb-item"><a href="">خانه</a></li>
    @endslot
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">محصولات</h3>

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
                            @can('create-product')
                                <a class="btn btn-info" href="{{ route('admin.products.create') }}">ایجاد محصول جدید</a>
                            @endcan

                        </div>
                    </div>
                    
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>آيدي محصول</th>
                            <th>نام كابر</th>
                            <th>تعداد موجودی</th>
                            <!-- <th>تعداد نظرات</th> -->
                            <th>تعداد بازدید</th>
                            <th>اقدامات</th>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->inventory }}</td>
                                <td>{{ $product->view_count }}</td>
                                <td class="d-flex">

                                   @can('delete-product')
                                   <form action=" {{ route('admin.products.destroy' , $product->id )}} " method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger ml-2" type="submit">
                                            حذف
                                        </button>
                                    </form>
                                   @endcan

                                   @can('edit-product')
                                    <a class="btn btn-sm btn-primary ml-2" href="{{ route('admin.products.edit' , ['product' => $product->id ]) }}">ويرايش</a>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $products->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent