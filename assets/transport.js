
    $(document).ready(function () {
        $('#form1').css('visibility','hidden');
//to add event
        $('#plus').click(function () {
            $(window).scrollTop(0);
            $('#up').hide();
            $('#form1').css('visibility','visible');
            $('.edit').off('click').mouseenter(function(){
                alert('please add events first or close to begin editing')
            });


        });
//sending event to database
        $('#add').click(function(){
            if($('#event').val()=="" || $('#time').val()==""){
                $('#error').html('Please enter both fields');
                return false;
            }
            else {
                var form = $('#form1').serialize();
                var link='CodeIgniter-3.1.6/index.php/example/insert';
                var Type='POST';
                $.ajax({
                    type: Type,
                    url: link,
                    data: form,
                    dataType: 'html',
                    success: function (result) {
                        location.reload();
                    }
                });
            }
        });


//to edit event
        $('.edit').click(function () {
            var identity = $(this).children().eq(0).val();
            var event= $(this).children().eq(1).val();
            var time= $(this).children().eq(2).val();


            // $.post('update.php',{id:identity});
            localStorage.setItem('iddd',identity);
            $(window).scrollTop(0);
            $('#form1').css('visibility','visible');
            $('#add').hide();
            $('#up').show();
            $('#plus').off('click').mouseenter(function(){
                alert('please finish editing first or close to add new events')
            });

            $('#event').val(event);
            $('#time').val(time);

        });


//deleting event
        $('[name=delete]').click(function () {
            var iden = $(this).children().eq(0).val();
            var confirmation= confirm('Are you sure?');
            if (confirmation==true) {
                $.post('delete.php', {the: iden}, function (result) {
                    if (result = "reload") {
                        location.reload();
                    }


                });
            }

        });

    });



    //update function
    function update() {
        var xml;
        var events = document.getElementById("event").value;
        var times = document.getElementById("time").value;
        var ids= localStorage.getItem('iddd');

        if(window.XMLHttpRequest){
            xml=new XMLHttpRequest();//for Chrome, mozilla etc
        }
        else if(window.ActiveXObject){
            xml=new ActiveXObject("Microsoft.XMLHTTP");//for IE only
        }

        if(events=="" || times==""){
            document.getElementById('error').innerHTML='Please enter both fields';
            return false;
        }
        else{
            xml.onreadystatechange = function () {
                if (xml.readyState ===4 ) {
                    if(xml.responseText="reload"){
                        location.reload();
                    }
                }
            }
        }
        var url="update.php?event="+events+"&time="+times+"&id="+ids;

        xml.open("GET", url, true);
        xml.send();
        localStorage.removeItem('iddd');
    }



