<!DOCTYPE html>
<?php
  // include "login.php";
  session_start();
  if($_SESSION['status'] !="login"){
    header("location:index.php");
  }
  include "connection.php";
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SKRIPSI | Validasi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include 'sidebar.php'; ?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Data Skripsi
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Data Skripsi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Detail data skripsi</h3>

      <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <?php 
      $id = $_GET['id'];
      $query ="SELECT u.npm, u.nama, u.prodi, u.judul, u.tanggal, u.jam, u.ruang, u.status, d1.nama as nama_ketua, d2.nama as nama_sekretaris, d3.nama as nama_penguji1, d4.nama as nama_penguji2, d5.nama as nama_penguji3, u.status_data, u.foto_usulan 
      FROM tb_ujian_skripsi as u
      INNER JOIN tb_dosen as d1 ON d1.nip = u.nip_ketua
      INNER JOIN tb_dosen as d2 ON d2.nip = u.nip_sekretaris
      INNER JOIN tb_dosen as d3 ON d3.nip = u.nip_penguji1
      INNER JOIN tb_dosen as d4 ON d4.nip = u.nip_penguji2
      INNER JOIN tb_dosen as d5 ON d5.nip = u.nip_penguji3   
      
      WHERE npm='".$id."'";
       //$query ="SELECT u.npm, u.nama, u.prodi, u.judul, u.tanggal, u.jam, u.ruang, u.status, u.status_data, d1.nama as nama_ketua, d2.nama as nama_sekretaris
       // FROM tb_ujian_skripsi as u
       // INNER JOIN tb_dosen as d1 ON d1.nip = u.nip_ketua
       // INNER JOIN tb_dosen as d2 ON d2.nip = u.nip_sekretaris
       // WHERE npm='".$id."'";

      $result = mysqli_query($conn,$query);
      $nomor = 1;
      if (mysqli_num_rows($result) > 0 ) { 
        while($data = mysqli_fetch_array($result)){
    ?>
    <?php echo "<form role='form' method='post' action='validasi_process.php?id=".$id."'' autocomplete='off'>"?>
    <div class="box-body">
      <!-- <div class="row"> -->
      <div class="col-md-12">              
        <h3 class="box-title">Data Mahasiswa</h3>
        <div class="col-md-6" >
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" value="<?php echo $data['nama'];?>" readonly>
          </div>
          <div class="form-group">
            <label for="npm">NPM</label>
            <input type="text" class="form-control" name="npm" value="<?php echo $data['npm'];?>" readonly>
          </div>
        </div>
        <div class="col-md-6" >
          <div class="form-group">
            <label for="prodi">Program Studi</label>
            <input type="text" class="form-control" name="prodi" value="<?php echo $data['prodi'];?>" readonly>
          </div>
        </div>
      </div>
      <!-- </div> -->
      <div class="col-md-12">
        <h3 class="box-title">Pelaksanaan Ujian Skripsi</h3>
        <div class="col-md-6" >
          <div class="form-group">
            <label for="judul">Judul Skripsi</label>
            <input type="text" class="form-control" name="judul" value="<?php echo $data['judul'];?>" readonly>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal Ujian</label>
            <input type="text" class="form-control" name="tanggal" value="<?php echo $data['tanggal'];?>" readonly>
          </div>
          <div class="form-group">
            <label for="jam">Jam Ujian</label>
            <input type="text" class="form-control" name="jam" value="<?php echo $data['jam'];?>" readonly>
          </div>
          <div class="form-group">
            <label for="ruang">Ruang Ujian</label>
            <input type="text" class="form-control" name="ruang" value="<?php echo $data['ruang'];?>" readonly>
          </div>
          <div class="form-group">
            <label for="status">Status Ujian</label>
            <input type="text" class="form-control" name="status" value="<?php echo $data['status'];?>" readonly>
          </div>
          <div class="form-group">
            <label for="image">Foto Usulan</label><br>
            <img src="<?php echo $data['foto_usulan'];?>" name="image" alt="<?php echo str_replace('upload/'.$id.'/', '', $data['foto_usulan'])?>" height="500px" align="middle">
          </div>
        </div>
        <div class="col-md-6" >
          <div class="form-group">
            <label for="ketua">Ketua Sidang</label>
            <input type="text" class="form-control" name="ketua" value="<?php echo $data['nama_ketua'];?>" readonly>
          </div>
          <div class="form-group">
            <label for="sekretaris">Sekretaris</label>
            <input type="text" class="form-control" name="sekretaris" value="<?php echo $data['nama_sekretaris'];?>" readonly>
          </div>
          <div class="form-group">
            <label for="penguji1">Penguji 1</label>
            <input type="text" class="form-control" name="penguji1" value="<?php echo $data['nama_penguji1'];?>" readonly>
          </div>
          <div class="form-group">
            <label for="penguji2">Penguji 2</label>
            <input type="text" class="form-control" name="penguji2" value="<?php echo $data['nama_penguji2'];?>" readonly>
          </div>
          <div class="form-group">
            <label for="penguji3">Penguji 3</label>
            <input type="text" class="form-control" name="penguji3" value="<?php echo $data['nama_penguji3'];?>" readonly>
          </div>
        </div>
      <!-- /.col -->
      </div>
      <div class="col-md-12">
        <h3 class="box-title">Status Data : <?php echo $data['status_data'];?></h3>
      </div>
      <!-- /.box-body -->
    </div>
    <div class="box-footer">
      <div class="col-md-4" >
      </div>
      <div class="col-md-4" >
      <?php 
        if ($data['status_data']=="BELUM VALID") {
      ?>
        <button type="submit" class="btn btn-block btn-primary">VALIDASI</button>
      <?php
        } else if ($data['status_data']=="VALID") {
      ?>
        <button type="submit" class="btn btn-block btn-primary" disabled>DATA TELAH DIVALIDASI</button>
      <?php
        }
      ?>
      </div>
      <div class="col-md-4" >
      </div>
    </div>
    </form> 
    <?php 
        }
      } else {
        echo "<h3 class='box-title'>No Result Found</h3>";
      }
    ?>
  
    </div>
      <!-- /.box -->      

      <!-- /.box -->      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'footer.php'; ?>

  <!-- Control Sidebar -->
  <?php //include 'control_sidebar.php';?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap datepicker locale indonesian-->
<script src="bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.id.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
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
      language: "id",
      format: "DD, dd MM yyyy",
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
      showMeridian: false,
      minuteStep: 1,
      showInputs: false
    })
  })
</script>
</body>
</html>
