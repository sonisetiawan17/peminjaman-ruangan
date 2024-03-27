<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tiket # {{ $data->kode_booking }}</title>
    
   <style>
    body{
    font-family: "Poppins", sans-serif;
    }
        hr {
          display: block;
          height: 1px;
          background: transparent;
          width: 100%;
          border: none;
          border-top: solid 1px #aaa;
      }
      table {
        font-size: 15px;
      }
      </style>
</head>
<body>
    <table align="center">
        <tr>
            <td style="text-align: left">
                <img src="/assets/img/auth/logo-cimahi.svg" alt="logo" width="50" height="50">
            </td>
            <td style="text-align: left">
            <center>
              <font size="4" style="text-align: left">
                PEMERINTAH KOTA CIMAHI
              </font><br />
              <font size="5">
                <b>Mal Pelayanan Publik Kota Cimahi</b>
              </font> <br />
              <font size="2">
                <i>Jl. Raden Demang Hardjakusumah No.1, Cibabat, Kec. Cimahi Utara, Kota Cimahi</i>
              </font> <br />
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <hr />
          </td>
        </tr>
      </table>
      <table align="center">
        <tr>
          <td>
            <font size="5"> <b>Tanda Terima Dokumen</b> </font>
        </tr>
      </table>
      
      <table align="center">
        <tr>
          <td>
            Kode Booking : {{ $data->kode_booking }}
          </td>
        </tr>
        <tr>
          <td height="7"></td>
        </tr>
      </table>

      <table align="center">
        <tr>
          <td>
          <center>
            {{ QrCode::size(100)->generate(route('user.view-qr', $data->id_permohonan)); }}
            <br />
            <font size="2">
              Scan untuk melihat detail permohonan
            </font>
            </center>
          </td>
        </tr>
        <tr>
          <td height="10"></td>
        </tr>
      </table>

      <table align="center">
        <tr>
          <td>
            Telah terima permohonan dari :
          </td>
        </tr>
      </table>
      <table>
        <tr><td>Nama Pemohon</td><td>:</td><td>{{ $data->name }}</td></tr>
        <tr><td>SKPD</td><td>:</td><td>{{ $data->skpd }}</td></tr>
        <tr><td>Nama Instansi</td><td>:</td><td>{{ $data->nama_instansi }}</td></tr>
        <tr><td>Nama Kegiatan</td><td>:</td><td>{{ $data->nama_kegiatan }}</td></tr>
      </table>
      <hr>
      <table>
        <tr><td>Tanggal Pengajuan Permohonan</td><td>:</td><td>{{ \Carbon\Carbon::parse($data
            ->created_at)->format('d M Y - H:i') }}</td></tr>
        <tr><td>Status Pengajuan</td><td>:</td><td style="color: green"><b>{{ $data->status_permohonan }}</b></td></tr>

      </table>
      <hr>
      <center><p><i>* Gunakan Tanda Terima diatas untuk bukti bahwa Anda sudah melakukan Booking pada Aplikasi SIPIRANG dengan status <b>"DITERIMA"<b></p></i>
      </center>      
    <br><br><br><br>       
    <center>
        <p>copyright by :</p>
        <br><br>
        <img src="/assets/img/auth/logo.png" alt="logo" width="200" height="71">
        <img src="/assets/img/auth/logo-dpmptsp.png" alt="logo" width="200" height="75">
    </center>
    <script>
      window.print();
    </script>
</body>
</html>