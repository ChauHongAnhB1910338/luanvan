@extends('admin_layout')
@section('admin_content')    
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thư viện hình ảnh sản phẩm
                        </header>
                        <div class="panel-body">
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                        ?>
                        <form role="form" action="{{URL::to('/insert-gallery/'.$pro_id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3" align="right">

                                </div>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="file[]" id="file" accept="image/*" multiple>
                                    <span id="error_gallery"></span>
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" name="upload" value="Tải ảnh lên" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                                <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                                <form>
                                    @csrf
                                
                                    <div id="load_gallery">
                                    
                                    </div>
                                </form>
                            </div>
                    </section>

            </div>
        </div>
@endsection