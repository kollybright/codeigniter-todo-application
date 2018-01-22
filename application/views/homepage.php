
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--    <meta http-equiv="refresh" content="10">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url('/assets/style.css')?>">
    <script src="<?php echo base_url('assets/jquery-3.2.1.min.js')?>"></script>
    <script src="<?php  echo base_url('assets/js/bootstrap.min.js') ?>"></script>


</head>
<body>
<header><a href="<?php echo site_url('todo/logout')?>" class="btn btn-primary btn-md" role="button" style="float: left">Logout</a>
         <span id="top" style="font-size:25px; text-align: center">Todo list</span>
        <span style="float: right;color: #0086b3"> Welcome <?php echo $this->session->userdata('username') ;?>!</span></header>

<section>
    <div id="input">
        <form id="form1">
            <input type="text" id="event" name="event" size="20em" placeholder="What Todo?"><input type="time" id="time"  name="time" style="margin-top:9px;">
            <button class="exit" style="color:red; float: right; font-size: 20px" data-toggle="tooltip" title="close this view">&times;</button><br>
            <span id="error" style="font-size: 1.3em"></span><br/>
            <button type="button"  id="add" name="add"  class="btn btn-lg btn-danger"">Add event</button>
            <button type="button"  id="up" name="up" class="btn btn-lg btn-danger" >Update event</button>
        </form>
    </div>

    <div class="container">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php
                    if($records==null){
                        ?>
                        <h4>It seems your events list is empty, you can add events.&nbsp;&nbsp;  click the blue
                            <span style="color:blue; font-size:larger">+</span> icon below</h4>
                    <?php
                    }
                    else {
                        ?>
                        <h4>You can add more events</h4>
                    <?php
                    }
                    ?>
                </div>
                <div class="panel-body panel-body">
                    <form method="post" action="">
                        <table class="table table-responsive table-striped table-bordered">
                            <tbody>
                            <?php foreach ($records as $a=>$item){?>
                                <tr>
                                    <td><button type="button" class="edit" name="update" data-toggle="tooltip"
                                                title="Update '<?php echo $item->event;?>'?">
                                            <input type="hidden" name="id" value="<?php echo $item->event_id;?>">
                                            <input type="hidden" name="db_event"  value="<?php echo $item->event;?>">
                                            <input type="hidden" name="db_time"  value="<?php echo $item->the_time;?>">
                                            <span class="glyphicon glyphicon-edit" style="color: green"></span>
                                        </button>
                                    </td>
                                    <td><?php echo $item->event."&nbsp;&nbsp;".
                                            "<span class='glyphicon glyphicon-time'> ".$item->the_time ?>
                                    </td>
                                    <td><button  type="submit"  name="delete" data-toggle="tooltip"
                                                 title="You are about to delete '<?php echo $item->event;?>' ">
                                            <input type="hidden" name="id" value="<?php echo $item->event_id?>">
                                            <span class="glyphicon glyphicon-remove-sign" style="color: red"></span>
                                        </button>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </form>
                    <span class="glyphicon glyphicon-plus" id="plus"data-toggle="tooltip" title="Add new events"></span>
                </div>
                <div class="panel-footer">
                    <?php
                    $start= 2017;
                    $year=0;
                    if (date("Y")>$start){
                        $year=$start."-".date("Y");
                    }
                    else {
                        $year=$start;
                    }
                    ?>
                    &copy; Kollybright <?php echo $year?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php // echo ($records[0]->event)?>


<script>

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
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
//sending events that would be inserted into database database
        $('#add').click(function(){
            if($('#event').val()=="" || $('#time').val()==""){
                $('#error').html('Please enter both fields');
                return false;
            }
            else {
                var form = $('#form1').serialize();
                var url = '<?php echo site_url('example/insert_event');?>';
                var Type='POST';
                $.ajax({
                    type: Type,
                    url: url,
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
        // sending events for update in the database
        $('#up').click( function (){
            var id= localStorage.getItem('iddd');
            var form = $('#form1').serialize()+'&id='+id;
            var url = '<?php echo site_url('example/update_event');?>';
            var Type='POST';
            $.ajax({
                type: Type,
                url: url,
                data: form,
                dataType: 'html',
                success: function (result) {
                    localStorage.removeItem('iddd');
                    location.reload();
                }
            });
        });


// sending  events to be deleted from the database
        $('[name=delete]').click(function () {
            var iden = $(this).children().eq(0).val();
            var confirmation= confirm('Are you sure?');
            if (confirmation==true) {
                var url = '<?php echo site_url('example/delete_event');?>';
                $.post( url, {event_id: iden}, function (result) {
                    location.reload();
                });

            }

        });
        $('.exit').click( function (){
            $('#input').css('visibility','hidden');
        });
v


    });
</script>
</body>
</html>
