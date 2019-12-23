

$(document).ready(function () {



    $('.nav-tabs a:first').addClass('active');


    let tab  =  $('#tab-selected').val();


    if (tab==1){

        $('#myTab a[href="#home"]').tab('show');
    }
    else if (tab==2){

        $('#myTab a[href="#profile"]').tab('show');
    }
    else if (tab==3){

        $('#myTab a[href="#processing"]').tab('show');
    }
    else if (tab==4){

        $('#myTab a[href="#processingtask"]').tab('show');
    }

    else if (tab==5){

        $('#myTab a[href="#issue"]').tab('show');
    }


    let tabv  =  $('#tab-verify-selected').val();

    if (tabv==1){

        $('#myTab a[href="#home"]').tab('show');
    }
    else if (tabv==2){

        console.log("true");
        $('#myTab a[href="#profile"]').tab('show');
    }

    $('.region').change(function () {


    console.log("here");
    $('.district').children().remove();

    var id  =  $(this).val();

    var districts  =  [];

    $.get( "/rita/districts/get-all",{id:id}, function(data) {

        console.log(data[0].name);

        for (var i=0; i<data.length; i++){

            console.log("loop: "+ data[i].DistrictName);

            $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
        }

    });


    //tabele data;
    $('#datatable').DataTable();

    // $('#myTab li:last-child a').tab('show');
});


});
