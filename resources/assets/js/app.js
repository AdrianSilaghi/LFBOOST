/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('notification', require('./components/Notification.vue'));
Vue.component('chat', require('./components/Chat.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));

const chat = new Vue({
    el: '#chat',
    data: {
      chats: ''
        
    },
    created() {
      const userId = $('meta[name="userId"]').attr('content');
      const contactId = $('meta[name="contactId"]').attr('content');         

        if(contactId != undefined){
            axios.post('/dashboard/inbox/getChat/' + contactId).then((response) =>{
                this.chats = response.data;
            });

            Echo.private('Chat.' + contactId + '.' + userId)
            .listen('BroadcastChat',(e)=>{
                this.chats.push(e.chat);
            });
        }
    },
});

const app = new Vue({
    el: '#notification',
    data: {
        notifications: '',
        
    },
    created() {
        axios.post('/notification/api/get').then(response => {
            this.notifications = response.data;
        });

        var userId = $('meta[name="userId"]').attr('content');
        Echo.private(`App.User.${userId}`)
                .notification((notification) => {
                    this.notifications.push(notification);
                });
               
    }
});


$(document).ready(function(){
    if($('#deliverModal').length > 0 ){
        var myDropzone = Dropzone.forElement('.dropzone');
        var button = document.querySelector('#deliverOrder');
        var transaction_id = $('#transaction_id').val();
        button.addEventListener('click',function(){

            myDropzone.on("sending", function (file, xhr, formData) {

                formData.append("transaction_id", transaction_id);

            });
            myDropzone.processQueue();
            axios.post('/order/api/markasdelivered',{
                transaction_id:transaction_id,
            }).then(function(response){
                if(response.status){
                    $('#deliverModal').modal('hide');
                    //location.reload(false);
                }
            })

        })
    }
})

$(document).ready(function(){
    if($('#markasComplete').length > 0 ){
    var button = document.querySelector('#markasComplete');
    button.addEventListener('click',function(){
        var comment = $('#commentArea').val();
        var raiting = $('#example').val();
        var post_id = $('#post_id').val();
        var transaction_id = $('#transaction_id').val();
        axios.post('/api/addReview',{
            comment:comment,
            raiting:raiting,
            post_id:post_id,
        }).then(function(response){
            axios.post('/order/api/markascomplete',{
                transaction_id:transaction_id,
            }).then(function(response){
                if(response.status){
                    console.log('markedascomplete');
                    $('#exampleModal').modal('hide');
                    location.reload(false);
                }
            })
           
        });


    })
    }

    if($('#accetButton').length > 0 ){
        var button = document.querySelector('#accetButton');
        button.addEventListener('click',function(){
            var transaction_id = $('#transaction_id').val();
            axios.post('/order/api/markasactive',{
                transaction_id:transaction_id,
            }).then(function(response){
                
                    location.reload(false);
                
            })
        })
    }
})


$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip(); 
    
    

    if($('#paymentsPage').length > 0 ) {
        function GetURLParameter(sParam) {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam) {
                    return sParameterName[1];
                }
            }
        }
        var x = GetURLParameter('id');
        
        var price = GetURLParameter('price')
        
       
        axios.get('/payment/api/token')
            .then(function (response) {
                
                var CLIENT_TOKEN_FROM_SERVER = response.data;
                var button = document.querySelector('#submit-button');
                
                braintree.client.create({
                    authorization: CLIENT_TOKEN_FROM_SERVER
                  }, function (clientErr, clientInstance) {
                  
                    // Stop if there was a problem creating the client.
                    // This could happen if there is a network error or if the authorization
                    // is invalid.
                    if (clientErr) {
                      console.error('Error creating client:', clientErr);
                      return;
                    }
                  
                    // Create a PayPal Checkout component.
                    braintree.paypalCheckout.create({
                      client: clientInstance
                    }, function (paypalCheckoutErr, paypalCheckoutInstance) {
                  
                      // Stop if there was a problem creating PayPal Checkout.
                      // This could happen if there was a network error or if it's incorrectly
                      // configured.
                      if (paypalCheckoutErr) {
                        console.error('Error creating PayPal Checkout:', paypalCheckoutErr);
                        return;
                      }
                  
                      // Set up PayPal with the checkout.js library
                      paypal.Button.render({
                        env: 'sandbox', // Or 'sandbox'
                        commit: true, // This will add the transaction amount to the PayPal button
                  
                        payment: function () {
                          return paypalCheckoutInstance.createPayment({
                            flow: 'checkout', // Required
                            amount: price, // Required
                            currency: 'EUR', // Required
                            
                          });
                        },
                  
                        onAuthorize: function (data, actions) {
                          return paypalCheckoutInstance.tokenizePayment(data, function (err, payload) {
                            axios.post('/payment/api/process', {
                                payload,
                                postId:x,
                            }).then(function(response){
                                var noteForBuyer = $('#notesForSeller').val();
                                
                                var data = response.data.transaction;
                                var orderinfo = response.data;
                               if(response.status == 200){
                                   axios.post('/order/api/newOrder',{
                                        data,
                                       postId:x,
                                       noteForBuyer:noteForBuyer
                                   }).then(response =>{
                                    var userone = response.data.buyer_id;
                                    var usertwo = response.data.seller_id;
                                       axios.post('/dashbaord/api/checkIfContact',{
                                        user_id: response.data.seller_id,
                                        contact_id: response.data.buyer_id
                                       }).then(function(response){
                                           if(response.data == 1 ){
                                            $.notify({
                                                // options
                                                message: 'Your payment was successful, order and a new conversation have been created!' 
                                            },{
                                                // settings
                                                type: 'success'
                                            });
                                            function RedirectToDashboard() {
                                                setTimeout(function () {
                                                    window.location.href = window.location.origin + '/dashboard'
                                                }, 3000);                                            
                                            }
                                            RedirectToDashboard();
                                            
                                           }else{
                                            axios.post('/dashboard/api/addContact',{
                                                user_id: userone,
                                                contact_id: usertwo,
                                            }).then(function(){
                                                $.notify({
                                                    // options
                                                    message: 'Your payment was successful, order and a new conversation have been created!' 
                                                },{
                                                    // settings
                                                    type: 'success'
                                                });
                                                function RedirectToDashboard() {
                                                    setTimeout(function () {
                                                        window.location.href = window.location.origin + '/dashboard'
                                                    }, 3000);                                            
                                                }
                                                RedirectToDashboard();
                                            })               
                                           }
                                    
                                       })
                                   })
                                   
 

                               }
                            }).catch(function (error){
                                console.log(error);
                            })
                          });
                        },
                  
                        onCancel: function (data) {
                          console.log('checkout.js payment cancelled', JSON.stringify(data, 0, 2));
                        },
                  
                        onError: function (err) {
                          console.error('checkout.js error', err);
                        }
                      }, '#paypal-button').then(function () {
                        // The PayPal button will be rendered in an html element with the id
                        // `paypal-button`. This function will be called when the PayPal button
                        // is set up and ready to be used.
                      });
                  
                    });
                  
                  });

                braintree.dropin.create({
                    authorization: CLIENT_TOKEN_FROM_SERVER,
                    container: '#dropin-container',
                }, function (createErr, instance) {
                    button.addEventListener('click', function () {
                        instance.requestPaymentMethod(function (err, payload) {
                            
                            axios.post('/payment/api/process', {
                                payload,
                                postId:x,
                            }).then(function(response){
                                var noteForBuyer = $('#notesForSeller').val();
                                
                                var data = response.data.transaction;
                               if(response.status == 200){
                                   axios.post('/order/api/newOrder',{
                                        data,
                                       postId:x,
                                       noteForBuyer:noteForBuyer
                                   }).then(response =>{
                                    var userone = response.data.buyer_id;
                                    var usertwo = response.data.seller_id;
                                       axios.post('/dashbaord/api/checkIfContact',{
                                        user_id: response.data.seller_id,
                                        contact_id: response.data.buyer_id
                                       }).then(function(response){
                                           if(response.data == 1 ){
                                            $.notify({
                                                // options
                                                message: 'Your payment was successful, order and a new conversation have been created!' 
                                            },{
                                                // settings
                                                type: 'success'
                                            });
                                            function RedirectToDashboard() {
                                                setTimeout(function () {
                                                    window.location.href = window.location.origin + '/dashboard'
                                                }, 3000);                                            
                                            }
                                            RedirectToDashboard();
                                            
                                           }else{
                                            axios.post('/dashboard/api/addContact',{
                                                user_id: userone,
                                                contact_id: usertwo,
                                            }).then(function(){
                                                $.notify({
                                                    // options
                                                    message: 'Your payment was successful, order and a new conversation have been created!' 
                                                },{
                                                    // settings
                                                    type: 'success'
                                                });
                                                function RedirectToDashboard() {
                                                    setTimeout(function () {
                                                        window.location.href = window.location.origin + '/dashboard'
                                                    }, 3000);                                            
                                                }
                                                RedirectToDashboard();
                                            })               
                                           }
                                    
                                       })
                                   })
                               }
                            }).catch(function (error){
                                console.log(error);
                            })
                        });
                    });
                });

            })
            .catch(function (error) {

            })
            .then(function () {
            });


        }


});

$(document).ready(function () {
    if($('.select-multiple').length > 0 ){
        $('.select-multiple').select2();
    }
   
});

$(document).ready(function () {
    if($('#example').length > 0 ){

   
    $('#example').barrating({
        theme: 'fontawesome-stars'
    });
}
});


$('#selectCategory').ready(function () {
    $('#selectCategory').on('change', '.custom-select', function () {

        var cat_id = $(this).val();
        var div = $(this).parents();
        var op = " ";
        $.ajax({

            type: 'get',
            url: '/api/findCatName',
            data: { 'id': cat_id },
            success: function (data) {

                op += '<option value="0" selected disabled>Choose Sub Category</option>';
                for (var i = 0; i < data.length; i++) {
                    op += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                }

                div.find('.custom-select2').html(" ");
                div.find('.custom-select2').append(op);

            },
            error: function () {

            }
        });
    });
});

$(document).ready(function () {
    $('#addNewLangDiv').on('click', '.btn', function () {
        var languageId = $('#language').val();
        var level = $('#level').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/api/addNewLanguage',
            data: {
                'language': languageId,
                'level': level,
            },
            success: function (data) {
                location.reload();
            }
        });
    });
});


$(document).ready(function () {
    $('#hello').on('click', '.btn', function () {
        var langId = $('#languageId').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/api/detachLang',
            data: { 'id': langId },
            success: function (data) {
                location.reload();
            }

        });
    });
});
$(document).ready(function () {
    $('#addNewGame').on('click', '.btn', function () {
        var gameId = $('#game').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/api/addNewGame',
            data: {
                'game': gameId,
            },
            success: function (data) {
                location.reload();
            }
        });
    });
});


$(document).ready(function () {
    $('#gameList').on('click', '.btn', function () {
        var gameId = $('#uG').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/api/detachGame',
            data: { 'id': gameId },
            success: function (data) {
                location.reload();
            }

        });
    });
});

$('#achivmentSelect').ready(function () {
    $('#achivmentSelect').on('change', '.custom-select', function () {

        var game_id = $(this).val();
        var div = $(this).parents();
        var op = " ";
        $.ajax({

            type: 'get',
            url: '/api/findAchivName',
            data: { 'id': game_id },
            success: function (data) {
                op += '<option value="0" selected disabled>Select achivment</option>';
                for (var i = 0; i < data.length; i++) {
                    op += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                }

                div.find('.custom-select2').html(" ");
                div.find('.custom-select2').append(op);

            },
            error: function () {

            }
        });
    });
});

$(document).ready(function () {
    $('#achivmentSelect').on('click', '.btn', function () {
        var gameId = $('#gameName').val();
        var achivements = $('#achivements').val();
        console.log(gameId);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/api/addNewAchivement',
            data: {
                'game': gameId,
                'achivements': achivements

            },

            success: function (data) {
                location.reload();

            },
            error: function (data) {
                console.log(data);
            }

        });
    });
});


$(document).ready(function () {
    $('#achivList').on('click', '.btn', function () {
        var gameId = $('#uA').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/api/detachAchivement',
            data: { 'id': gameId },
            success: function (data) {
                location.reload();
            }

        });
    });


});

$(document).ready(function () {
    $('#faq').on('click', '#faqButton', function () {

        var faqQ = '<input name="question" id="question" class="form-control m-b-20 m-t-20" placeholder="Add a Question:" id="exampleFormControlTextarea1" style="resize:none;"><hr><textarea name="answer" class="form-control" rows="4" style="resize:none;" id="answer" placeholder="Add an Answer:"></textarea><button type="button" class="btn btn-outline-success btn-sm float-right m-l-10 m-t-10" id="faqADD">Add</button><button type="button" class="btn btn-outline-warning btn-sm float-right m-t-10" id="faqRemove">Cancel</button>';
        $('#faqQA').append($(faqQ));
    });
    $('#faq').on('click', '#faqRemove', function () {


        $('#faqQA').html(" ");
    });

    var i = 0;
    $('#faq').on('click', '#faqADD', function () {

        i++;
        var q = $('#question').val();
        var a = $('#answer').val();
        var newFaq = '<div id="r' + i + '"class="card m-b-20"><div class="card-body"><lable class="h6 text-muted">Question:</lable><input class="form-control m-t-10" id="questionVal' + i + '" type="text" value="" readonly><lable class="h6 text-muted">Answer:</lable><input class="form-control" type="text" id="answerVal' + i + '" value=""readonly></div><button type="button" class="btn btn-outline-danger btn-sm m-l-20 m-b-20 text-center" id="faqRemoveWhole" style="width:30px;height:30px;float:center;">x</button></div>';



        $('#faqDone').prepend($(newFaq));
        $('#questionVal' + i).val(q);
        $('#answerVal' + i).val(a);

    });





    $('#faqDone').on('click', '#faqRemoveWhole', function () {
        var test = $('#faqRemoveWhole').parent();
        test.remove();
    });




    var btnFinish = $('<button></button>').text('Finish')
        .addClass('btn btn-outline-primary')
        .on('click', function () {
            var title = $('#title').val();
            var category = $('#categories').val();
            var subcat = $('#subcategories').val();
            var priceDescription = $('#price_description').val();
            var price = $('#price').val();
            var deliveryTime = $('#delivery_time').val();
            var postDescription = $('#body').val();
            //var q = $('#question').val();
            //var a = $('#answer').val();
            var requirements = $('#requirements').val();
            var tags = $("#tags").tagsinput('items');

            var q = [];
            var b = [];
            for (var a = 0; a < i + 1; a++) {

                q[a] = $('#questionVal' + a).val();
                b[a] = $('#answerVal' + a).val();

            }
            q.shift();
            b.shift();




            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },


                type: 'post',
                url: '/api/addNewBoost',
                data: {

                    'title': title,
                    'categories': category,
                    'subcategories': subcat,
                    'price_description': priceDescription,
                    'price': price,
                    'delivery_time': deliveryTime,
                    'requirements': requirements,
                    'body': postDescription,
                    'question': q,
                    'answer': b,
                    'tags': tags,

                },
                success: function () {

                }

            });
            function getPostSlug() {
                setTimeout(function () {
                    $.ajax({
                        type: 'get',
                        url: '/api/getPostSlug',
                        data: {
                            'title': title,

                        },
                        success: function (data) {


                            var myDropzone = Dropzone.forElement('.dropzone');
                            myDropzone.on("sending", function (file, xhr, formData) {

                                formData.append("id", data.id);

                            });
                            myDropzone.processQueue();


                            //window.location.href = window.location.origin + '/posts/' + data.slug
                        }
                    });
                }, 3000);
            }
            getPostSlug();


            //console.log(title,category,subcat,priceDescription,price,deliveryTime,postDescription,q,a,requirements);
        });


    $('#smartwizard').smartWizard({
        transitionEffect: 'fade',
        toolbarSettings: {
            toolbarExtraButtons: [btnFinish]
        },
    });

    $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection) {
        // Enable finish button only on last step
        if (stepNumber == 3) {
            $('.btn-outline-primary').show();
        } else {
            $('.btn-outline-primary').hide();

        }
    });



});

$(document).ready(function () {
    if (document.querySelector('#smartwizard') !== null) {

        var container = document.getElementById('price_description');
        var editor = new Quill(container, {
            theme: 'snow'
        });
        var container2 = document.getElementById('body');
        var editor2 = new Quill(container2, {
            theme: 'snow'
        });
        document.querySelector('#smartwizard').addEventListener('change', function (e) {
            function clearconsole() {
                console.log(window.console);
                if (window.console) {
                    console.clear();
                }
            }

            axios.post('/api/validatePost', {
                'title': document.querySelector('#title').value,
                'categories': document.querySelector('#categories').value,
                'subcategories': document.querySelector('#subcategories').value,
                'price_description': document.querySelector('#price_description').value,
                'price': document.querySelector('#price').value,
                'delivery_time': document.querySelector('#delivery_time').value,
                'body': document.querySelector('#body').value,
                'requirements': document.querySelector('#requirements').value,
            })
                .then((response) => {
                    clearErrors();



                })
                .catch((error) => {
                    const errors = error.response.data.errors
                    const firstItem = Object.keys(errors)[0]
                    const firstItemDOM = document.getElementById(firstItem)
                    const firstErrorMessage = errors[firstItem][0]

                    clearErrors();

                    firstItemDOM.insertAdjacentHTML('afterend', `<div class="text-danger">${firstErrorMessage}</div>`)
                    // highlight the form control with the error
                    firstItemDOM.classList.add('border', 'border-danger')
                });

            function clearErrors() {
                // remove all error messages
                const errorMessages = document.querySelectorAll('.text-danger')
                errorMessages.forEach((element) => element.textContent = '')

                const formControls = document.querySelectorAll(['.form-control', '.custom-select', '.ckeditor'])
                formControls.forEach((element) => element.classList.remove('border', 'border-danger'))
            }

        });
    }
    else {

    }


});

