
  function filterRequest(){

      $('.btn-filter-requests').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/birth-service",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-birth-request tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);

                  $('.table-birth-request tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/birth-certificates/new/pending/'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');

                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }
          });

      });

  }

  function filterOltToNewRequest(){

      $('.btn-filter-requests-old-to-new').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/birth-service-filterOldToNew",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-birth-request-old-to-new  tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);


                  $('.table-birth-request-old-to-new  tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/birth-certificates/replace/my-task'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');


                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }

          });


      });

  }

  function filterDuplicateRequest(){

      $('.btn-filter-requests-duplicate').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/birth-service-duplicate",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-birth-request-duplicate tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);

                  $('.table-birth-request-duplicate  tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/birth-certificates/duplicate/my-task/'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');


                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }

          });


      });

  }

  function filterCorrectionRequest(){

      $('.btn-filter-requests-correction').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/birth-service-correction",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-birth-request-correction tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);

                  $('.table-birth-request-correction  tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/birth-certificates/correction/my-task/'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');


                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }

          });


      });

  }

  function filterVerificationRequest(){

      $('.btn-filter-requests-verification').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/birth-service-verification",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-birth-request-verification tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);

                  $('.table-birth-request-verification tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/birth-certificates/verify/my-task/'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');


                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }

          });


      });

  }

  function filterSearchRequest(){

      $('.btn-filter-requests-search').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/birth-service-search",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-birth-request-search tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);

                  $('.table-birth-request-search  tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/birth-certificates/search/view/'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');


                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }

          });


      });

  }

  $(document).ready(function () {

    filterRequest();

    filterOltToNewRequest();

    filterDuplicateRequest();

    filterCorrectionRequest();
    filterVerificationRequest();
    filterSearchRequest();

    //death

      filterDeathCorrectionRequest();
      filterDeathDuplicateRequest();
      filterDeathRequest();
      filterDeathSearchRequest();
      filterDeathOltToNewRequest();
      filterDeathVerificationRequest();
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

        $('#datatable-pr').DataTable();

    //tabele data;
    $('#datatable').DataTable();

        // $('#datatable-pr').DataTable();


        // $('#myTab li:last-child a').tab('show');
});



});





  function filterDeathRequest(){

      $('.btn-filter-death-requests').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/death-service",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-death-request tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);

                  $('.table-death-request tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/death-certificates/new/pending/'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');

                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }
          });

      });

  }

  function filterDeathOltToNewRequest(){

      $('.btn-filter-death-requests-old-to-new').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/death-service-filterOldToNew",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-death-request-old-to-new  tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);


                  $('.table-death-request-old-to-new  tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/death-certificates/replace/my-task/'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');


                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }

          });


      });

  }

  function filterDeathDuplicateRequest(){

      $('.btn-filter-death-requests-duplicate').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/death-service-duplicate",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-death-request-duplicate tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);

                  $('.table-death--request-duplicate  tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/death-certificates/duplicate/my-task/'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');


                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }

          });


      });

  }

  function filterDeathCorrectionRequest(){

      $('.btn-filter-death-requests-correction').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/death-service-correction",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-death-request-correction tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);

                  $('.table-death-request-correction  tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/death-certificates/correction/my-task/'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');

                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }

          });

      });
  }

  function filterDeathVerificationRequest(){

      $('.btn-filter-death-requests-verification').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/death-service-verification",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-death-request-verification tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);

                  $('.table-death-request-verification tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/death-certificates/verify/my-task/'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');

                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }
          });

      });
  }

  function filterDeathSearchRequest(){

      $('.btn-filter-death-requests-search').click(function (event) {

          let district =  $('.district-filer').val();

          let statusId =  $('.new-birth-request-status').val();

          console.log(statusId);

          $.get( "/rita/api/death-service-search",{districtId:district,statusId:statusId}, function(data) {

              console.log(data);
              $('.table-death-request-search tbody tr').remove();
              for (var i=0; i<data.length; i++){

                  console.log( data[i].DistrictID);

                  $('.table-death-request-search  tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].SurName+'</td>' +
                      '<td>'+data[i].ProcessingOffice+'</td><td>'+data[i].NearOffice+'</td><td>'+data[i].StatusName+'</td>' +
                      '<td>'+data[i].ApplicationID+'</td><td>'+data[i].CreatedDate+'</td>' +
                      '<td><a href="/death-certificates/search/view/'+data[i].TrackerID+'" class="btn btn-info fa fa-tasks"></a></td></tr>');

                  // $(".district").append('<option value='+data[i].DistrictID+'>'+data[i].DistrictName+'</option>');
              }

          });

      });

  }
