function rapport_full() {
      $.ajax({
           type: "POST",
           url: 'doc_create.php',
           data:{
               action:'call_this',
          },
           success:function(html) {
               //alert(html);
           }

      });
}


function rapport_at1() {
     $.ajax({
          type: "POST",
          url: 'doc_create_at1.php',
          data:{
              action:'gene_at1',
         },
          success:function(html) {
              //alert(html);
          }

     });
}

function rapport_at2() {
     $.ajax({
          type: "POST",
          url: 'doc_create_at2.php',
          data:{
              action:'gene_at2',
         },
          success:function(html) {
              //alert(html);
          }

     });
}

function rapport_at3() {
     $.ajax({
          type: "POST",
          url: 'doc_create_at3.php',
          data:{
              action:'gene_at3',
         },
          success:function(html) {
              //alert(html);
          }

     });
}

function rapport_at4() {
     $.ajax({
          type: "POST",
          url: 'doc_create_at4.php',
          data:{
              action:'gene_at4',
         },
          success:function(html) {
              //alert(html);
          }

     });
}

function rapport_at5() {
     $.ajax({
          type: "POST",
          url: 'doc_create_at5.php',
          data:{
              action:'gene_at5',
         },
          success:function(html) {
              //alert(html);
          }

     });
}

function showDiv() {
     document.getElementById('btn_gen').style.display = "block";
   }