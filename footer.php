<footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Library Search</h5>
          <p class="grey-text text-lighten-4">All books, instructors and research papers at one place.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
 
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

<script>

  $(document).ready(function(){
    $('ul.search_tabs').tabs();


$('#search').keyup(function(){
$('#test1 .collection').html('');
$('#test2 .collection').html('');
$('#test3 .collection').html('');
var value = $('#search').val();

if(value.length > 2 ){
 $.ajax({ 
			type : 'GET',
			data : 'val='+value,
			url  : 'ajax_search.php',
			success: function(responseText){
               console.log(responseText);
		       var k = $.parseJSON(responseText);
              
               var done = 0;
                      for (var i=0; i< 3; i++){
                
                      for (j in k[i]) {
                          var array = $.map(k[i][j], function(value, index) {
    return [value];
});

                        var elem = ' <li class="collection-item avatar">';

if (array[4]=="")
elem +='<img src="demo.jpg" alt="" class="circle">';
else
elem +='<a href="pdfs/outlines/'+array[4]+'" target="_blank"><img src="files/pdf.jpg" alt="" class="circle"></a>';
elem +='<span class="title">'+array[2]+'</span><p>';

elem +='Course:'+array[3]+'<br>';


elem+='</p></li>'
                     
                     $('#test'+(array[1])+' .collection').append(elem);
                   if (done==0){
                    document.querySelectorAll('.tab a')[(parseInt(array[1])-1)].click()
                  done = 1;   
                  }                      
    }

		}	}
			});
}

});
  });


</script>


  </body>
</html>
