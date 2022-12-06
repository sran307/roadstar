$.ajax({
                        type: 'post',
                        url: '{{url('/setdefault_customer_address')}}',
                        data: {id: id, "_token": "{{ csrf_token() }}", type: 'default address'},
                        dataType:"json",  
                        success: function(data){
                            if(data['error'] == 1) {
                                $.confirm({
                                    title: '',
                                    content: data['msg'],
                                    icon: 'fa fa-check',
                                    theme: 'modern',
                                    closeIcon: true,
                                    animation: 'RotateYR',
                                    type: 'green',
                                    buttons: {
                                        Close:function() {
                                        }
                                    }
                                });

                                window.setTimeout(function() {
                                    window.location.href="<?php echo route('myaccount'); ?>";
                                }, 3000);
                            } else if(data['error'] == 2) {
                                $.confirm({
                                    title: '',
                                    content: data['msg'],
                                    icon: 'fa fa-exclamation-circle',
                                    theme: 'modern',
                                    closeIcon: true,
                                    animation: 'RotateYR',
                                    type: 'red',
                                    buttons: {
                                        Close:function() {
                                            // window.location.reload();
                                        }
                                    }
                                });

                                /*$('.gj_add_addr_validation').html('');

                                $.each(data['validation'], function(key, value){
                                    $('.gj_add_addr_validation').append('<li>'+value+'</li>');
                                });*/
                            } else {
                                $.confirm({
                                    title: '',
                                    content: data['msg'],
                                    icon: 'fa fa-ban',
                                    theme: 'modern',
                                    closeIcon: true,
                                    animation: 'RotateYR',
                                    type: 'purple',
                                    buttons: {
                                        Close:function() {
                                            // window.location.reload();
                                        }
                                    }
                                });
                            }
                        }
                    });