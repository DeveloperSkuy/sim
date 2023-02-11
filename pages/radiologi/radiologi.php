<div class="table-container">
<table id="tabeldata" class="table table-striped display tabel-data">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Pemeriksaan</th>
            <th scope="col">Harga Tindakan</th>
            <th scope="col">tgl input</th>
        </tr>
    </thead>
    <tbody>
        <?php
          include('koneksi.php');
            $no=1;
            $query=mysqli_query($conn, "SELECT * FROM data_radiologi");
            while ($result=mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td>
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <?php echo $result['nama_radiologi']; ?>
                        </td>
                        <td>
                            <?php echo $result['harga_radiologi']; ?>
                        </td>
                        <td>
                            <?php echo $result['tgl_input']; ?>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>