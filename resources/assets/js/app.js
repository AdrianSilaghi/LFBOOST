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

const app = new Vue({
    el: '#app',
    data: {
        notifications: ''
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
//push 
$(document).ready(function(){
    if($('#markasComplete').length > 0 ){
    var button = document.querySelector('#markasComplete');
    button.addEventListener('click',function(){
        var comment = $('#commentArea').val();
        var raiting = $('#example').val();
        var post_id = $('#post_id').val();
        var transaction_id = $('#transaction_id').val();
        console.log(comment,raiting);
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
        
        
        
       
        axios.get('/payment/api/token')
            .then(function (response) {
                
                var CLIENT_TOKEN_FROM_SERVER = response.data;
                var button = document.querySelector('#submit-button');
                
               
                
                  
                braintree.dropin.create({
                    authorization: CLIENT_TOKEN_FROM_SERVER,
                    container: '#dropin-container',
                    paypal,
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
                                   }).then(function(response){
                                    
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

///scrips
$(document).ready(function () {
    $('.select-multiple').select2()


});

$(document).ready(function () {
    $('#example').barrating({
        theme: 'fontawesome-stars'
    });
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

