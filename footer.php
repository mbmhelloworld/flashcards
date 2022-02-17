<script type="text/javascript">

$(".toggleForms").click(function(){

    $('#signUpForm').toggle();
    $('#logInForm').toggle();

});

$('#save').click(function() {

   $.ajax({
        method: "POST",
        url: "updateDatabase.php",
        data: { subject: $('#subject').val(), question: $('#question').val(), answer: $('#answer').val()}
   }).done(function(msg){
        alert("Gespeichert! "+msg);
   });
   
});

var random_entry;
var sHTML = '';
var qHTML = '';
var aHTML = '';
var delId = '';
$('#nextQ').click(function() {

     $.ajax({
          method: "POST",
          url: "nextQuestion.php",
          data: {},
          contentType: "application/json; charset=utf-8",
          dataType: "json",                    
          cache: false,
          success: function(response) {                        
                         random_entry = response[Math.floor(Math.random() * response.length)];
                         delId =  random_entry.id;
                         sHTML =  random_entry.subject;
                         qHTML =  random_entry.question;
                         aHTML =  random_entry.answer;
                         $('#showSubject').html(sHTML);
                         $('#showQuestion').html(qHTML);
                    },
                    error: function (e) {
                        console.log("Fehler");
                    }
     }).done(function(msg){
          console.log("Next succeeded "+msg);
     });
});

$('#openAnswer').click(function() {

     $('#showAnswer').html(aHTML);     

});

$('#delete').click(function() {

     $.ajax({
          method: "POST",
          url: "deleteData.php",
          data: {id:delId}
     }).done(function(msg){
          console.log(delId);
          console.log("DELEtED! "+msg);
   });;

});

</script>

</body>
</html>