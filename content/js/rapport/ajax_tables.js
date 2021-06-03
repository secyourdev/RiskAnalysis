function rapport_full() {
      $.ajax({
           type: "POST",
           url: 'doc_create.php',
           data:{
               action:'call_this',
          },
           success:function(html) {
               alert(html);
           }

      });
 }
