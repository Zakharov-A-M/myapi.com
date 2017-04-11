






$(document).ready(function() {

    setInterval(function(){ $("#refresh").click(); }, 3000);

   // setInterval(function(){ $("#refresh1").click(); }, 3000);

    /*var window = $(window)


    window.scroll(0, localStorage.getItem('scrollPosition')|0)


    window.scroll(function () {  localStorage.setItem('scrollPosition', window.scrollTop())});*/

    var chatResult = $('.chat');
    chatResult.scrollTop(chatResult.prop('scrollHeight'));



    $('#post').on('click', function () {
        var message = $('#textArea').val();
        var button = document.getElementById('refresh');
        var id=$('#refresh').data("id1");

        $.ajax({
            url: 'newmessage',
            type: 'post',
            data:{message:message, id:id},
            dataType: 'text',
            success:function(message)
            {

            },
            error:function (message) {
                alert(message);
            }
        });
    });

    function MouseEnter() {
        var id=$('#refresh').data("id1");
       // alert(id);
        $.ajax({
            url: "newmessage",
            type: 'post',
            data:{id:id},
            dateType: 'text',
            success:function(fjdsfs)
            {
              //  alert(fjdsfs);
            },
            error:function (fjdsfs) {
              //  alert(fjdsfs);
            }
        })
    }




    function Parse(data) {
        var i;
        var container = document.getElementsByClassName('container');
        var NewDiv = document.getElementsByClassName('ibi');
        $( container[3] ).empty();
        if(data[0]== null){
            var newLi = document.createElement('h3');
            newLi.innerHTML = "Мы не нашли пользователя";
            newLi.style.color = 'red';
            container[3].appendChild(newLi);
            return false;
        }
         kol_mass =  data[1].length;
        var container = document.getElementsByClassName('container');
        for (i = 0; i < kol_mass; i++) {
            var NewDiv = document.createElement('div');
            NewDiv.className = 'ibi' ;
            container[3].appendChild(NewDiv);
            for(ii = 0; ii < data.length; ii++){
                var NewID = document.getElementById('ibi');
                var newLi = document.createElement('p');
                newLi.innerHTML = "<strong> "+data[ii][i]+"</strong>";
                container[3].appendChild(newLi);
            }
        }
    }




    function Click() {
        if (event.keyCode == 13) {
           // alert("Ура нажали Enter");
             var username = $('#username').val();
             //  alert(user);
            if(username.length == 0){
                var container = document.getElementsByClassName('container');
                $( container[3] ).empty();
                var newLi = document.createElement('p');
                newLi.innerHTML = "<h1>Вы не ввели имя пользователя</h1>";
                newLi.style.color = 'red';
                container[3].appendChild(newLi);
                return false;
            }else {
                $.ajax({
                    url: "http://myapi.by/api/web/v1/users/search",
                    type: 'GET',
                    data: {username: username},
                    dateType: 'text',
                    success: function (data) {
                           Parse(data);
                    },
                    error: function (data) {
                        $('#ibi').html(data);
                    }
                })
            }
        }
    }



    $('html').keydown(Click);





    $(".other1").mouseenter(MouseEnter);


});







