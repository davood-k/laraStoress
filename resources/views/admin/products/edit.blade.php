@component('admin.layouts.content' , ['title' => 'ویرایش محصول'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">همه محصول ها</a></li>
        <li class="breadcrumb-item active">ویرایش محصول</li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">فرم ویرایش محصول</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.products.update' , $product->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">عنوان محصول</label>
                            <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="عنوان محصول را وارد کنید" value="{{ old('title' , $product->title) }}">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">تعداد محصول</label>
                            <input type="text" name="inventory" class="form-control" id="inputEmail3" placeholder="توضیح محصول را وارد کنید" value="{{ old('inventory' , $product->inventory) }}">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">قیمت محصول</label>
                            <input type="text" name="price" class="form-control" id="inputEmail3" placeholder="توضیح محصول را وارد کنید" value="{{ old('price' , $product->price) }}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش محصول</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
