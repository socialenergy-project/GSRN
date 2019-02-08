
<?php

   if(isset($GroupMessage) && sizeof($GroupMessage)>0){
	
	//                Materialize.toast(' Your Group Name must have at list 2 (or more ) characters, you can always try again later!<i class="material-icons left">cancel</i> ', 4000, 'red rounded');

	
	for($i=0;$i<sizeof($GroupMessage);$i++){
		
	//	echo "Materialize.toast(' $GroupMessage[$i]!<i class=\"material-icons left\">cancel</i> ', 4000, 'green rounded');";//, completeCallback: function(){alert(\"Your toast was dismissed\")}
 echo "Materialize.toast(' $GroupMessage[$i]!<i class=\"material-icons left\">cancel</i> ', 5000, 'green rounded', function toastCompleted() {
               callAJAX($GroupMessageID[$i]);
            });";
		
	}
	
}

?>


	function callAJAX(IDG){
			
		
		
	  $.ajax({
        type: "POST",
        url: "<? echo site_url('Cocialnetwork/messageQue'); ?>",
        dataType: 'json',
        cache: false,
        data: {
            type_of_action: "click",
            action: "View User",
            GrGrID: $.trim(IDG),    
            'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
        },
        beforeSend: function () {

            $(".overlay2").show();

        },
        complete: function () {

            $(".overlay2").hide();
        },
        success: function (msg) {

         

        },
        error: function (jqXHR, textStatus, errorThrown)
        {


        }
    });

		
	
	}


$('#yprod').click(function () {
///////////////////////

    $("#error2me8").css("display", "none");


    if ($("#TeamNameT").val().length < 2) {
        $("#error2me8").css("display", "block");
        return true;

    } else {
        $("#error2me8").css("display", "none");
    }

    if ($("#TeamNameT").val().length > 50) {
        $("#error2me9").css("display", "block");
        return true;

    } else {
        $("#error2me9").css("display", "none");
    }




    $.ajax({
        type: "POST",
        url: "<? echo site_url('Cocialnetwork/reqleaces'); ?>",
        dataType: 'json',
        cache: false,
        data: {
            type_of_action: "click",
            action: "View User",
            GrName: $.trim($("#TeamNameT").val()),
            proID: $(this).attr("data-id"),
            'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
        },
        beforeSend: function () {

            $(".overlay2").show();

        },
        complete: function () {

            $(".overlay2").hide();
        },
        success: function (msg) {

            $('.modal').modal('close');

            if (msg.post == 3) {

                Materialize.toast(' Your Group Name must have at list 2 (or more ) characters, you can always try again later!<i class="material-icons left">cancel</i> ', 4000, 'red rounded');

            } else if (msg.post == 2) {

                Materialize.toast(' Your Group Name must have less than 50 characters, you can always try again later!<i class="material-icons left">cancel</i> ', 4000, 'red rounded');

            } else if (msg.post == 4) {

                Materialize.toast(' Group Name already exists please choose another one!<i class="material-icons left">cancel</i> ', 4000, 'red rounded');

            } else {


                Materialize.toast(' Your leadership skills will be tested soon!<i class="material-icons left">insert_emoticon</i> ', 4000, 'green rounded');

            }


            $('#TeamNameT').val('');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {


        }
    });


});

var tableCreate = "";

$('#modalnrec2C').click(function () {

tableCreate = "<table class='highlight'><thead><tr><th>Title</th><th>Date</th></tr></thead><tbody>";
 
     $.ajax({
        type: "POST",
        url: "<? echo site_url('Cocialnetwork/pullRec'); ?>",
        dataType: 'json',
        cache: false,
        data: {
            type_of_action: "click",
            action: "View User",
           
            'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
        },
        beforeSend: function () {

            $(".overlay2").show();

        },
        complete: function () {

            $(".overlay2").hide();
        },
        success: function (msg) {

            $('.modal').modal('close');

            if (msg.result == 200) {
			
			 $('#modalnrec2').modal('open');
	
			 $.each(msg.tips, function(i, el) { 
   tableCreate +="<tr><td><i class='small material-icons'>check</i>"+el+"</td><td>"+msg.tipDate[i]+"</td></tr>";
	
	
});
			 
		tableCreate +="</tbody></table>";
		  $("#mdlRec").html(tableCreate);	 
			  }
			
			/*
			
            if (msg.post == 3) {

                Materialize.toast(' Your Group Name must have at list 2 (or more ) characters, you can always try again later!<i class="material-icons left">cancel</i> ', 4000, 'red rounded');

            } else if (msg.post == 2) {

                Materialize.toast(' Your Group Name must have less than 50 characters, you can always try again later!<i class="material-icons left">cancel</i> ', 4000, 'red rounded');

            } else if (msg.post == 4) {

                Materialize.toast(' Group Name already exists please choose another one!<i class="material-icons left">cancel</i> ', 4000, 'red rounded');

            } else {

                Materialize.toast(' Your leadership skills will be tested soon!<i class="material-icons left">insert_emoticon</i> ', 4000, 'green rounded');

            }


            $('#TeamNameT').val('');
			
			*/
			
			
			

        },
        error: function (jqXHR, textStatus, errorThrown)
        {


        }
    });
 
 
 
});

$('#tmrcik').click(function () {

 $('.modal').modal('close');

});


$('#tmrc').click(function () {

    $('.modal').modal('close');

    Materialize.toast(' You can always try later!<i class="material-icons left">insert_emoticon</i> ', 4000, 'blue rounded');

});


$('.button-collapse').sideNav({
                menuWidth: 300, // Default is 300
                edge: 'left', // Choose the horizontal origin
                closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                draggable: true // Choose whether you can drag to open on touch screens
            }
            );


