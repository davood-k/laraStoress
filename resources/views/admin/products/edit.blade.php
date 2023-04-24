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
                @slot('script')
        <script>
            $('#categories').select2({
                'placeholder' : 'دسترسی مورد نظر را انتخاب کنید'
            })


            let changeAttributeValues = (event , id) => {
                let valueBox = $(`select[name='attributes[${id}][value]']`);

                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type' : 'application/json'
                    }
                })

                $.ajax({
                    type : 'POST',
                    url : '/admin/attribute/values',
                    data : JSON.stringify({
                        name : event.target.value
                    }),
                    success : function(data) {
                        valueBox.html(`
                            <option selected>انتخاب کنید</option>
                            ${
                            data.data.map(function (item) {
                                return `<option value="${item}">${item}</option>`
                            })
                        }
                        `);

                        $('.attribute-select').select2({ tags : true });
                    }
                });
            }

            let createNewAttr = ({ attributes , id }) => {
                return `
                    <div class="row" id="attribute-${id}">
                        <div class="col-5">
                            <div class="form-group">
                                 <label>عنوان ویژگی</label>
                                 <select name="attributes[${id}][name]" onchange="changeAttributeValues(event, ${id});" class="attribute-select form-control">
                                    <option value="">انتخاب کنید</option>
                                    ${
                                        attributes.map(function(item) {
                                            return `<option value="${item}">${item}</option>`
                                        })
                                    }
                                 </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                 <label>مقدار ویژگی</label>
                                 <select name="attributes[${id}][value]" class="attribute-select form-control">
                                        <option value="">انتخاب کنید</option>
                                 </select>
                            </div>
                        </div>
                         <div class="col-2">
                            <label >اقدامات</label>
                            <div>
                                <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('attribute-${id}').remove()">حذف</button>
                            </div>
                        </div>
                    </div>
                `
            }

            $('#add_product_attribute').click(function() {
                let attributesSection = $('#attribute_section');
                let id = attributesSection.children().length;

                attributesSection.append(
                    createNewAttr({
                        attributes : [],
                        id
                    })
                );
                $('.attribute-select').select2({ tags : true });
            });
            $('.attribute-select').select2({ tags : true });
        </script>
    @endslot
                <!-- form start -->
                <div id="attributes" data-attributes="{{ json_encode(\App\Attribute::all()->pluck('name')) }}"></div>
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
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">دسته بندی</label>
                            <select class="form-control" name="categories[]" id="categories" multiple>
                                @foreach(\App\Category::all() as $categories)
                                    <option value="{{ $categories->id }}" {{ in_array($categories->id , $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $categories->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h6>ویژگی محصول</h6>
                        <hr>
                        <div id="attribute_section">
                        @foreach($product->attributes as $attribute)
                                <div class="row" id="attribute-{{ $loop->index }}">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>عنوان ویژگی</label>
                                            <select name="attributes[{{ $loop->index }}][name]" onchange="changeAttributeValues(event, {{ $loop->index }});" class="attribute-select form-control">
                                                <option value="">انتخاب کنید</option>
                                                @foreach(\App\Attribute::all() as $attr)
                                                    <option value="{{ $attr->name }}" {{ $attr->name ==  $attribute->name ? 'selected' : '' }}>{{ $attr->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>مقدار ویژگی</label>
                                            <select name="attributes[{{ $loop->index }}][value]" class="attribute-select form-control">
                                                <option value="">انتخاب کنید</option>
                                                @foreach($attribute->values as $value)
                                                    <option value="{{ $value->value }}" {{ $value->id  === $attribute->pivot->value_id ? 'selected' : '' }}>{{ $value->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label >اقدامات</label>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('attribute-{{ $loop->index }}').remove()">حذف</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="btn btn-sm btn-danger" type="button" id="add_product_attribute">ویژگی جدید</button>
                    </div>
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
