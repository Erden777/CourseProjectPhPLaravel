$(".update_btn").on("click", function(e){
    e.preventDefault(); // prevent de default action, which is to submit
    let submittedForm = $('#update_form');
    let formAction = submittedForm[0].action;
    let formVal = submittedForm.serialize();
    

    $.ajax({
        type: "POST",
        url: formAction,
        data: formVal,
        success: () => {
            window.location.reload();
        },
      });
  
  });