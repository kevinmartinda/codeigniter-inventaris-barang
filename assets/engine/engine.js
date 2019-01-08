$( "#sPilih" ).change(function () {    
      var id = $('#sPilih').val();
      var surl = "http://localhost/inventaris/index.php/barang/get_item/";
      console.log(id);
      $.ajax({
        url: surl + id,
        dataType: "JSON",
        success: function (data) {
          $('#sTempat').children().remove();
          for (i = 0; i < data.length; i++) {
            console.log(data[i].id);
            $('#sTempat')
                .append($("<option value='"+data[i].id+"'>"+data[i].nama+"</option>"))
          }
        } 
      });
      let a = $("#sPilih  option:selected").text();
      
      // if (a === "Laboratorium") {
      //   $('#fGambar').show()
      // } else {
      //   $('#fGambar').hide()
      // }
    });

      $( "#sTempatB" ).change(function () {    
      var id = $('#sTempatB').val();
      var surl = "http://localhost/inventaris/index.php/barang/get_selected/";
      //console.log(id);
      $.ajax({
        url: surl + id,
        dataType: "JSON",
        success: function (data) {
          $('#sBarang').children().remove();
          $('#sBarang').append($("<option value='' selected disabled>Pilih Barang</option>"));
          for (i = 0; i < data.length; i++) {
            //console.log(data[i].id);
            $('#sBarang')
                .append($("<option value='"+data[i].id+"'>"+data[i].nama_barang+"</option>"))
          }
        } 
      });
      let a = $("#sPilih  option:selected").text();
      
      // if (a === "Laboratorium") {
      //   $('#fGambar').show()
      // } else {
      //   $('#fGambar').hide()
      // }
    });

    $('#sBarang').change(function () {
      let id = 0;
      id = $('#sBarang').val();
      let surl = "http://localhost/inventaris/index.php/barang/get_selected_jumlah/";
        $.ajax({
          url: surl + id,
          dataType: "JSON",
          success: function (data) {
            $('#sStok').html(data.jumlah);
            $('#iKeluar').attr({'max': data.jumlah});
          } 
        });
      });

$(function () {

    $('#sBarang').children().remove();
    $('#sBarang').append($("<option value='' selected disabled>Pilih Barang</option>"));

    $('#fGambar').hide()

    $('.sidebar-menu').tree()

    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
