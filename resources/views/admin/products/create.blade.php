@component('admin.layouts.content' , ['title' => 'ایجاد محصول'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">همه محصول ها</a></li>
        <li class="breadcrumb-item active">ایجاد محصول</li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">فرم ایجاد محصول</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.products.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                    <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">عنوان</label>
                            <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="عنوان محصول را وارد کنید" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">توضیحات</label>
                            <textarea class="form-control"  name="description" cols="30" rows="4" id="description" placeholder="توضیحات محصول را وارد کنید" value="{{ old('description') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">قیمت</label>
                            <input type="number" name="price" class="form-control" id="inputEmail3" placeholder="قیمت محصول را وارد کنید" value="{{ old('price') }}">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">موجودی</label>
                            <input type="number" name="inventory" class="form-control" id="inputEmail3" placeholder="موجودی محصول را وارد کنید" value="{{ old('inventory') }}">
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت محصول</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
