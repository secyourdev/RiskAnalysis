function merge_line_on_table(table,start,end){
    for(let i=start;i<end;i++){
      //assumption: the column that you wish to rowspan is sorted.

      //this is where you put in your settings
      var indexOfColumnToRowSpan = i;
      var $table = $(table);

      //this is the code to do spanning, should work for any table
      var rowSpanMap = {};
      $table.find('tr').each(function(){
        var valueOfTheSpannableCell = $($(this).children('td')[indexOfColumnToRowSpan]).text();
        $($(this).children('td')[indexOfColumnToRowSpan]).attr('data-original-value', valueOfTheSpannableCell);
        rowSpanMap[valueOfTheSpannableCell] = true;
      });

      for(var rowGroup in rowSpanMap){
        var $cellsToSpan = $('td[data-original-value="'+rowGroup+'"]');
        var numberOfRowsToSpan = $cellsToSpan.length;
        $cellsToSpan.each(function(index){
          if(index==0){
            $(this).attr('rowspan', numberOfRowsToSpan);
          }else{
            $(this).hide();
          }
        });
      }
    }
  }