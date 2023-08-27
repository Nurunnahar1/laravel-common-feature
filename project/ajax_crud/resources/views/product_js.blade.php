
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script>
    $(document).ready(function(){
        // alert('i');

        //add product

        $(document).on('click','.add_product',function(e){
            e.preventDefault();
            let name = $('#name').val();
            let price = $('#price').val();
            // console.log(name+price);

            $.ajax({
                url:"{{ route('add.product') }}",
                method:'post',
                data:{name:name,price:price},
                success:function(res){
                    // For hide modal
                    if(res.status=='success'){
                        $('#addModal').modal('hide');   //(#addModal) from add_product_modal
                        // For refresh modal
                        $('#addProductForm')[0].reset();   //(#addProductForm) from add_product_modal (form id)
                        //For with out reload product show
                        $('.table').load(location.href+' .table');   //(.table) from products.blade (table class)
                        Command: toastr["success"]("Product added", "Success") //success message

                                toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                                }

                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(index, value){
                        $('.errorMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    });
                }
            });
        })


        //update product show in update modal by id wise=====

        // product show in update modal by id wise
        $(document).on('click','.update_product_form',function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');

            $('#update_id').val(id);
            $('#update_name').val(name);
            $('#update_price').val(price);
        })

         //update product
        $(document).on('click','.update_product',function(e){
            e.preventDefault();
            let update_name = $('#update_name').val();
            let update_price = $('#update_price').val();
            let update_id = $('#update_id').val();


            $.ajax({
                url:"{{ route('update.product') }}",
                method:'post',
                data:{update_id:update_id,update_name:update_name,update_price:update_price},
                success:function(res){
                    // For hide modal
                    if(res.status=='success'){
                        $('#updateModal').modal('hide');   //(#addModal) from add_product_modal
                        // For refresh modal
                        $('#updateProductForm')[0].reset();   //(#addProductForm) from add_product_modal (form id)
                        //For with out reload product show
                        $('.table').load(location.href+' .table');   //(.table) from products.blade (table class)
                        Command: toastr["success"]("Product Updated", "Success") //success message

                            toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            }

                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(index, value){
                        $('.errorMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    });
                }
            });
        })

         //delete product
        $(document).on('click','.delete-product',function(e){
            e.preventDefault();

            let product_id = $(this).data('id');
            // alert(product_id); testing
            if(confirm('Are you sure??')){
                $.ajax({
                url:"{{ route('delete.product') }}",
                method:'post',
                data:{product_id:product_id},
                success:function(res){
                    // For hide modal
                    if(res.status=='success'){

                        $('.table').load(location.href+' .table');   //(.table) from products.blade (table class)
                        Command: toastr["success"]("Product deleted", "Success") //success message

                        toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }

                    }
                }
            });
            }


        })


        //pagination
        $(document).on('click','pagination a',function(e){
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            priduct(page)
        })
        function priduct(page){
            $.ajax({
                url:"/pagination/paginate-data?page="+page,
                success:function(res){
                    $('.table-data').html(res);
                }
            })
        }


        //search====
        $(document).on('keyup',function(e){
            e.preventDefault();
            let search_string = $('#search').val();
            console.log(search_string);
            $.ajax({
                url:"{{ route('search.product') }}",
                method:'GET',
                data:{search_string:search_string},
                success:function(res){
                    $('.table-data').html(res);
                    if(res.status=='nothing_found'){
                        $('.table-data').html('<span class="text-danger">'+'Nothing Found'+'</span>');
                    }

                }
            })
        })
    })

</script>


