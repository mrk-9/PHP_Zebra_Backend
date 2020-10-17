$('input[name="mediaType"]').on('click',function(){
       $('#showAnswer').html('');
       $('select[name="selectionType"]').attr('disabled', true);
        var createBoxType = $(this).val();
        var createHtml = '';
        if(createBoxType == 'text'){
            createHtml   = '<span id="textBoxRemove'+textBoxCount+'" ><div class="form-group">';
            createHtml  += '<label class="control-label col-sm-2" for="pwd">Question Option:</label>';
            createHtml  += '<div class="col-sm-10">';
            createHtml  += '<input type="text" class="form-control questionAnswer" id="textQuestion'+textBoxCount+'" name="options[]" placeholder="Enter your question value">';
            createHtml  += '<span style="float: right;"><a  style="padding: 0px 5px;" href="javascript:removeTextBox('+textBoxCount+')" class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i></a> | <button type="button" style="padding: 0px 5px;"  onclick="answerCheck('+textBoxCount+')" id="answerBox'+textBoxCount+'" class="btn btn-info" ><i class="fa fa-check-square-o" aria-hidden="true"></i></button></span>';
         createHtml  += '</div></div></span><span id="MoreTextBox"></span><span style="float: right;"><a style="padding: 0px 5px;" href="javascript:addTextBox()" class="btn btn-info"><i class="fa fa-plus-square" aria-hidden="true"></i></a></span>';
        }else if(createBoxType == 'media'){
         // media box create  
         createHtml   = '<span id="MediaBoxRemove'+mediaBoxCount+'" ><div class="form-group">';
         createHtml  += '<label class="control-label col-sm-2" for="pwd">Question Option:</label>';
         createHtml  += '<div class="col-sm-4">';
         createHtml  += '<input type="text" class="form-control questionAnswer" id="mediaQuestion'+mediaBoxCount+'"  name="options[]" placeholder="Enter your question value"></div>';
         createHtml  += '<label class="control-label col-sm-2" for="pwd">Media Image:</label>';
         createHtml  += '<div class="col-sm-4">';
         createHtml  += '<input type="file" class="form-control" onchange="ImageChange('+mediaBoxCount+')" id="Show'+mediaBoxCount+'" name="mediaImages[]">';
         createHtml  += '<span style="display:none;" id="displayImagesShow'+mediaBoxCount+'"><img src="" id="imageShowDisplay'+mediaBoxCount+'" style="height:50px; width:50px;" ></span>';
         createHtml  += '<span style="float: right;"><a  style="padding: 0px 5px;" href="javascript:removeMedia('+mediaBoxCount+')" class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i></a> | <button type="button" style="padding: 0px 5px;"  onclick="mediaAnswerCheck('+mediaBoxCount+')" id="MediaanswerBox'+mediaBoxCount+'" class="btn btn-info" ><i class="fa fa-check-square-o" aria-hidden="true"></i></button> </span></div></div></span><span id="MoreMediaTextBox"></span><span style="float: right;"><a style="padding: 0px 5px;" href="javascript:addMediaBox()" class="btn btn-info"><i class="fa fa-plus-square" aria-hidden="true"></i></a></span>';
         // close media box
        }
        $('#createBoxs').html(createHtml);
    });
    // create add text box 
    function addTextBox(){
        textBoxCount++;
        var createHtml = '';
         createHtml   = '<span id="textBoxRemove'+textBoxCount+'"><div class="form-group">';
         createHtml  += '<label class="control-label col-sm-2" for="pwd">Question Option:</label>';
         createHtml  += '<div class="col-sm-10">';
         createHtml  += '<input type="text" class="form-control questionAnswer" id="textQuestion'+textBoxCount+'" name="options[]" placeholder="Enter your question value">';
         createHtml  += '<span style="float: right;"><a  style="padding: 0px 5px;" href="javascript:removeTextBox('+textBoxCount+')" class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i></a> | <button type="button" style="padding: 0px 5px;"  onclick="answerCheck('+textBoxCount+')" id="answerBox'+textBoxCount+'" class="btn btn-info" ><i class="fa fa-check-square-o" aria-hidden="true"></i></button></span>';
         createHtml  += '</div></div></span>';
         $('#MoreTextBox').append(createHtml);

    }
    function removeTextBox(id){
       var optionValue = $('#textQuestion'+id).val(); 
        removeTextSelectedClassIteams(id,optionValue);
         $('#textBoxRemove'+id).remove();
      if(jQuery.isEmptyObject(textBoxAnswer) == true){
            $('#showAnswer').html('');
         }
    }
    function addMediaBox(){
      mediaBoxCount++;
      var createHtml = '';
          createHtml   = '<span id="MediaBoxRemove'+mediaBoxCount+'" ><div class="form-group">';
          createHtml  += '<label class="control-label col-sm-2" for="pwd">Question Option:</label>';
          createHtml  += '<div class="col-sm-4">';
          createHtml  += '<input type="text" class="form-control questionAnswer"  id="mediaQuestion'+mediaBoxCount+'"  name="options[]" placeholder="Enter your question value"></div>';
          createHtml  += '<label class="control-label col-sm-2" for="pwd">Media Image:</label>';
          createHtml  += '<div class="col-sm-4">';
          createHtml  += '<input type="file" class="form-control" onchange="ImageChange('+mediaBoxCount+')" id="Show'+mediaBoxCount+'" name="mediaImages[]">';
         createHtml  += '<span style="display:none;" id="displayImagesShow'+mediaBoxCount+'"><img src="" id="imageShowDisplay'+mediaBoxCount+'" style="height:50px; width:50px;" ></span>';
          createHtml  += '<span style="float: right;"><a  style="padding: 0px 5px;" href="javascript:removeMedia('+mediaBoxCount+')" class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i></a> | <button type="button" style="padding: 0px 5px;"  onclick="mediaAnswerCheck('+mediaBoxCount+')" id="MediaanswerBox'+mediaBoxCount+'" class="btn btn-info" ><i class="fa fa-check-square-o" aria-hidden="true"></i></button> </span></div></div></span>';
          $('#MoreMediaTextBox').append(createHtml);

    }
    function removeMedia(id){
       var setAnswer = $('#mediaQuestion'+id).val();
         $('#MediaBoxRemove'+id).remove();
           removeMeadiIteam(id,setAnswer);
          if(jQuery.isEmptyObject(mediaBoxAnswer) == true){
            $('#showAnswer').html('');
           }
    }
    function answerCheck(id){
      var setAnswer = $('#textQuestion'+id).val();
      if (setAnswer.length != '') {
      var answer = $('#answerBox'+id).attr('class');
        if(answer == 'btn btn-info'){ 
          $('#answerBox'+id).removeClass(); 
          $('#answerBox'+id).addClass('btn btn-success'); 
           if(selectionType == 1 && textBoxAnswer.length == 0){textBoxAnswer.push(setAnswer);}else if(selectionType == 2){textBoxAnswer.push(setAnswer);}
           if(jQuery.isEmptyObject(textBoxAnswer) == false){
               var answerHtml = '';
                   answerHtml += '<div class="form-group">';
                   answerHtml += '<label class="control-label col-sm-2" for="pwd">Correct Answer:</label>';
                   answerHtml += '<div class="col-sm-8">';
                $(textBoxAnswer).each(function(index,value){
                    answerHtml += "<span class='btn btn-info' >"+value+"</span>&nbsp;&nbsp;";
                });
                answerHtml += '</div></div>';
                var myJsonString = JSON.stringify(textBoxAnswer);
                $('input[name="answerSheet"]').val(myJsonString);
                $('#showAnswer').html(answerHtml);
            }
         }else if(answer == 'btn btn-success'){ 
            removeTextSelectedClassIteams(id,setAnswer);
         }
         if(jQuery.isEmptyObject(textBoxAnswer) == true){
            $('#showAnswer').html('');
         }
       }else{
        alert('!Oops please enter a question option');
       }
        // show answer sheet 
        // close 
    }
    function removeTextSelectedClassIteams(id,setAnswer){
      $('#answerBox'+id).removeClass().addClass('btn btn-info'); 
      _.pull(textBoxAnswer,setAnswer); 
      if(jQuery.isEmptyObject(textBoxAnswer) == false){
           var answerHtml = '';
               answerHtml += '<div class="form-group">';
               answerHtml += '<label class="control-label col-sm-2" for="pwd">Correct Answer:</label>';
               answerHtml += '<div class="col-sm-8">';
            $(textBoxAnswer).each(function(index,value){
                answerHtml += "<span class='btn btn-info' >"+value+"</span>&nbsp;&nbsp;";
            });
            answerHtml += '</div></div>';
             var myJsonString = JSON.stringify(textBoxAnswer);
            $('input[name="answerSheet"]').val(myJsonString);
            $('#showAnswer').html(answerHtml);
        }
    }
    function mediaAnswerCheck(id){
      var setAnswer = $('#mediaQuestion'+id).val();
      if (setAnswer.length != '') {
       var answer = $('#MediaanswerBox'+id).attr('class');
        if(answer == 'btn btn-info'){ 
            $('#MediaanswerBox'+id).removeClass(); 
            $('#MediaanswerBox'+id).addClass('btn btn-success'); 
              // mediaBoxAnswer.push(setAnswer);
              if(selectionType == 1 && mediaBoxAnswer.length == 0){mediaBoxAnswer.push(setAnswer);}else if(selectionType == 2){mediaBoxAnswer.push(setAnswer);}
              var answerHtml = '';
               if(jQuery.isEmptyObject(mediaBoxAnswer) == false){
                   var answerHtml = '';
                       answerHtml += '<div class="form-group">';
                       answerHtml += '<label class="control-label col-sm-2" for="pwd">Correct Answer:</label>';
                       answerHtml += '<div class="col-sm-8">';
                    $(mediaBoxAnswer).each(function(index,value){
                        answerHtml += "<span class='btn btn-info' >"+value+"</span>&nbsp;&nbsp;";
                    });
                       answerHtml += '</div></div>';
                        var myJsonString = JSON.stringify(mediaBoxAnswer);
                    $('input[name="answerSheet"]').val(myJsonString);
                    $('#showAnswer').html(answerHtml);
                }
            // close 
         }else if(answer == 'btn btn-success'){
                 removeMeadiIteam(id,setAnswer);
            if(jQuery.isEmptyObject(mediaBoxAnswer) == true){
              $('#showAnswer').html('');
             }
            // close
        }
      }else{
       alert('!Oops please enter a question option');
       }
    }
    function removeMeadiIteam(id,setAnswer){
          $('#MediaanswerBox'+id).removeClass().addClass('btn btn-info'); 
          _.pull(mediaBoxAnswer,setAnswer); 
          if(jQuery.isEmptyObject(mediaBoxAnswer) == false){
           var answerHtml = '';
               answerHtml += '<div class="form-group">';
               answerHtml += '<label class="control-label col-sm-2" for="pwd">Correct Answer:</label>';
               answerHtml += '<div class="col-sm-8">';
            $(mediaBoxAnswer).each(function(index,value){
                answerHtml += "<span class='btn btn-info' >"+value+"</span>&nbsp;&nbsp;";
            });
            answerHtml += '</div></div>';
            var myJsonString = JSON.stringify(mediaBoxAnswer);
            $('input[name="answerSheet"]').val(myJsonString);
            $('#showAnswer').html(answerHtml);
          }
    }
   // validate input box value
  function validateForm(){
    var title = $('input[name="title"]').val();
    var media = $("input[name='mediaType']:checked").val();
    var checkAnswer = $("input[name='answerSheet']").val();
    var answerQuestion = 1;
     if(title.length == 0){
        $('input[name="title"]').css('border','solid 1px red');
        return false;
     }
     if(media == undefined){
        $('input[name="mediaType"]').css('outline','solid 1px red');
       return false;
     }
      $('input.questionAnswer').each(function() {
           var data = $(this);
            if($(this).val() == ''){
               $('#'+data[0]['id']).css('border','solid 1px red');
                // return false;
                answerQuestion = 2;
            }
      });
      if (answerQuestion == 2) {
        return false;
      }
      if(checkAnswer.length == ''){
        alert('!Oops please select any correct answer.');
        return false;
      }
    // return false;
  }

  $('input[name="mediaType"]').click(function(){
    $('input[name="mediaType"]').css('outline','none');
  });
  $('input[name="title"]').keydown(function(){
     $('input[name="title"]').css('border','solid 1px #d2d6de');
  });
  $('input[name="options[]"]').keydown(function(){
     $('input[name="options"]').css('border','solid 1px #d2d6de');
  });
function ImageChange(argument){
  var input = $("#Show"+argument)[0];
   if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#displayImagesShow'+argument).css('display','block');
      $('#imageShowDisplay'+argument).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}