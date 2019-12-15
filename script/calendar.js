function calendar(id){
    var dateFormat = "dd-mm-yy",
      from = $( `#start-${id}` )
        .datepicker({
          defaultDate: "+1d",
          dateFormat: "dd-mm-yy",
          monthNamesShort: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ],
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
          
        }),
      to = $( `#end-${id}` )
        .datepicker({
          defaultDate: "+1d",
          dateFormat: "dd-mm-yy",
          monthNamesShort: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ],
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1,
          showButtonPanel: true,
          currentText: "Present"
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate(dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  }

