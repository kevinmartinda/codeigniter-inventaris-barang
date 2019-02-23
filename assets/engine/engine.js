// function kTambah() {
//   var surl = "http://localhost/inventaris/index.php/home/add_category/";
//   var deta = new FormData($('#fTamKat')[0]);
//   console.log(deta);
//   console.log('asu');
//   $.ajax({
//     url: surl,
//     type: "POST",
//     data: deta,
//     dataType: "JSON",
//     success: function (response) {
//       console.log(response)
//     }
//   })
// }
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}

$('#bTaEd').click(function () {
  $('#edit').modal().show();
  let id = $(this).attr('data-id');
  $.ajax({
    url: 'http://localhost/inventaris/index.php/barang/get-tata/'+id,
    dataType: "JSON",
    success: function (response) {
      let neo = response.nama;
      $('#edNam').val(neo);
      
    }
  })
})


$("input[name='lapPilih']").click(function () {
  let a = $("input[name='lapPilih']:checked").val()
  console.log(a);
  switch(a){
    case 'week': 
      $('#sLap').children().remove();
      $('#sLap').append($("<option value='' disabled selected>Pilih Rentan Waktu</option>"))
      for (var i = 1; i < 4; i++) { 
        $('#sLap').append($("<option value='"+i+"'>"+i+" Minggu Terakhir</option>"));
      }
    break;
    case 'month': 
      $('#sLap').children().remove();
      $('#sLap').append($("<option value='' disabled selected>Pilih Rentan Waktu</option>"))
      for (var i = 1; i < 12; i++) { 
        $('#sLap').append($("<option value='"+i+"'>"+i+" Bulan Terakhir</option>"));
      }
    break;
  }  
})

$('#sLap').change(function () {
  let surl = "http://localhost/inventaris/index.php/barang/get_barang_from/";
  let type = $('#iLaphid').val();
  let interval = $("input[name='lapPilih']:checked").val();
  let times = $('#sLap  option:selected').val();
  let t = $('#tb-laporan').DataTable();
  $('#anim').show();
  $.ajax({
    url: surl + type + "/" + times + "/" + interval,
    dataType: "JSON",
    success: function (response) {
      console.table(response)
      t.clear().draw();
      let no = 1;
      for (var i = 0; i < response.length; i++) {
        let tgl = response[i].tgl_edit == null ? response[i].tgl_masuk : response[i].tgl_edit
        t.row.add([
        no,
        response[i].nama_barang,
        response[i].merk,
        response[i].nama_user,
        response[i].warna,
        response[i].tahun,
        response[i].nama_tempat,
        response[i].jumlah,
        tgl
        ]).draw(false);
        no++;
      }
      $('#anim').hide();
    } 
  });
})

$('#cxbtn').click(function () {
  $('#modal-tambah').modal().show();
})

$('#sTemKat').change(function () {
  console.log($('#sTemKat').val())
  if ($('#sTemKat').val() == 'lain') {
    $('#modal-tambah').modal().show();
  }
})

$('#bTamKat').click(function () {
  $('#modal-tambah').modal().show();
})

$('#bTamKat').click(function () {
  console.log($('#iTexCat').val())
  $.ajax({
      url: 'http://localhost/inventaris/index.php/home/add_category',
      type: "POST",
      data: $('#fTamKat').serialize(),
      dataType: "JSON",
      success: function (response) {
        console.table(response);
        $('#modal-tambah').modal('hide');
        $.ajax({
          url: 'http://localhost/inventaris/index.php/home/getKategory',
          dataType: "JSON",
          success: function (data) {
            $('#sTemKat').children().remove();
            console.log('children removed..');
            for (i = 0; i < data.length; i++) { 
              if(data[i].id == 2 || data[i].id == 3 ||data[i].id == 4){

              } else {
                $('#sTemKat').append($("<option value='"+data[i].id+"'>"+data[i].nama+"</option>"));
              }
            }
            $('#sTemKat').append($("<option value='lain'>[+] Tambah Kategori</option>"));
          }
        })
      }
  })
})

$('#slab').keyup(function () {
  var skey = $('#slab').val();
  var id = $('#hid-id').val();
  var surl = "http://localhost/inventaris/index.php/barang/search_lab/"+id+"/";
  $.ajax({
    url: surl + skey,
    dataType: "JSON",
    success: function (data) {
      $('#dSearch').children().remove();
      console.log("asu");
      if (!data.error) { 
        for (i = 0; i < data.length; i++) {
           tgl = data[i].tgl_edit === null ? data[i].tgl_masuk : data[i].tgl_edit
          $('#dSearch')
              .append($("<div class='info-box bg-yellow'><span class='info-box-icon'><i class='ion ion-ios-pricetag-outline'></i></span><div class='info-box-content'><span class='info-box-text'>"+data[i].nama_user+"</span><span class='info-box-number'>"+data[i].nama_barang+"<i class='fa fa-pull-right'>"+data[i].jumlah+" unit</i></span><div class='progress'><div class='progress-bar' style='width: 50%'></div></div><span class='progress-description'>"+data[i].merk+" | "+data[i].warna+ "| <span><i class='fa fa-pull-right'>tgl : "+tgl+"</i></span></span></div></div>"));
        }
      } else {
        $('#dSearch')
              .append($("<div>hasil tidak ditemukan.</div>"));
      }
    } 
  });
})

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

$('#sTempat').change(function () {
  var x  = $('#sTempat').val();
  if (x == 69) {
    
  }
})

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
    // $('#tvlab').style({display: block});
    // $('#fGambar').hide();
    $('#sBarang').children().remove();
    $('#sBarang').append($("<option value='' selected disabled>Pilih Barang</option>"));

    $('.sidebar-menu').tree()

    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
    //DataTable
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#tb-laporan').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'processing'  : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
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
